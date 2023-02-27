import axios from "axios"

export default {
    name: 'List',
    props: ['user'],
    data () {
        return {
            users: [],
            listOption: '',
            noData : false,
            userId: '',
            changeRoleStatus: '',
            userSearchValue: ''
        }
    },
    methods: {
        getUsersByOptionSelect (e) {
            let value = e.target.value;
            let formData = {
                value: value
            }
            axios.post('http://localhost:8000/api/admin/users/list', formData).then((response) => {
                if (!response.data.users.length) {
                    this.noData = true
                } else {
                    this.users = response.data.users;
                    this.noData = false;
                }

            });
        },
        deleteUser (e) {
            let parent = e.target.parentElement.closest('tr');
            let userId = parent.querySelector('#userId').innerHTML;
            let formData = {
                userId : userId
            }
            axios.post('http://localhost:8000/api/admin/user/delete', formData).then((response) => {
                if (response.data.status == 'success') {
                    parent.remove();
                }
            })
        },
        changeRole (e) {
            let parent = e.target.parentElement.closest('tr');
            let clickedUserId = parent.querySelector('#userId').innerHTML;
            let clickedUserRole = parent.querySelector('#userRole').value;
            let formData = {
                id: clickedUserId,
                role: clickedUserRole
            }
            if (clickedUserRole == 'user') {
                if (confirm('Are you sure you want to change this user to admin?')) {
                    axios.post('http://localhost:8000/api/admin/changeRole', formData).then((response) => {
                        if (response.data.status == 'success') {
                            window.location.reload();
                        }
                    })
                  }
            } else if (clickedUserRole == 'admin') {
                if (confirm('Are you sure you want to change this admin to user?')) {
                    axios.post('http://localhost:8000/api/admin/changeRole', formData).then((response) => {
                        if (response.data.status == 'success') {
                            window.location.reload();
                        }
                    })
                }
            }

        },
        userSearch () {
            let formData = {
                value: this.userSearchValue
            }
            axios.post('http://localhost:8000/api/admin/userSearch', formData).then((response) => {
                this.users = response.data.users;
            })
        }
    },
    mounted () {

    }
}
