import axios from "axios";

export default {
    name: 'ProfilePage',
    props: ['user'],
    data () {
        return {
            mainUser: {},
            updateStatus : ''
        }
    },
    methods: {
        getMainUserData () {
            let formData = {
                id: this.user
            };
            axios.post('http://localhost:8000/api/admin/getLoggedInUserData', formData).then((response) => {
                this.mainUser = response.data.mainUser;
            })
        },
        editPage () {
            window.location.href = 'http://localhost:8000/admin/profile/editPage'
        },
        getLocalStorageDataWithExpiry () {
            let itemStr = localStorage.getItem('updateStatus');
            let item = JSON.parse(itemStr);
            let now = new Date();
            if (now.getTime() > item.expiry ) {
                localStorage.removeItem('updateStatus')
                this.updateStatus = ''
            } else {
                this.updateStatus = item.value
            }
        },
        setUpdateStatus () {

        }
    },

    mounted () {
        this.getMainUserData();
        this.getLocalStorageDataWithExpiry();
    }
}
