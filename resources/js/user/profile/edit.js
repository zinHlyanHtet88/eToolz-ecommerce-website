import axios from "axios";

export default {
    name: 'Edit',
    props: ['user'],
    data() {
        return {
            mainUser: {
                name: '',
                email: '',
                phone: '',
                address: '',
                gender: '',
                image: ''
            },
            updateStatus: {
                name: true,
                email: true,
                phone: true,
                address: true,
                gender: true,
                image: true
            },
            updateValidation: {
                name: '',
                email: '',
                phone: '',
                address: '',
                gender: '',
                image: ''
            },
            url: '',
            emails: [],
            phones: []
        }
    },
    methods: {
        getLoggedInUser() {
            let formData = {
                userId: this.user
            };
            axios.post('http://localhost:8000/api/users/user', formData).then((response) => {
                this.setUpUserData(response);
            })
        },
        setUpUserData (response) {
            this.mainUser.name = response.data.user.name;
            this.mainUser.email = response.data.user.email;
            this.mainUser.phone = response.data.user.phone;
            this.mainUser.address = response.data.user.address;
            this.mainUser.gender = response.data.user.gender;
            this.mainUser.image = response.data.user.image;
        },
        pickFile (e) {
            let files = e.target.files[0];
            this.url = URL.createObjectURL(files);
            this.mainUser.image = files;
        },
        nameValidationCheck () {
            if (!this.mainUser.name.length) {
                this.updateValidation.name = "This field is required.";
                this.updateStatus.name = true;
            } else if (this.mainUser.name.length < 5) {
                this.updateValidation.name = "Name's length is too short.";
                this.updateStatus.name = true;
            } else {
                this.updateValidation.name = "";
                this.updateStatus.name = false;
            }
        },
        getEmails () {
            let arr = [];
            let formData = {
                id: this.user
            }
            axios
            .post("http://localhost:8000/api/admin/getUsersEmails", formData)
            .then((response) => {
                for (let i = 0; i < response.data.emails.length; i++) {
                    let emails = response.data.emails[i];
                    let email = emails.email;
                    arr.push(email);
                    this.emails = arr;
                }
            });
        },
        emailValidationCheck () {
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    if (!this.mainUser.email.length) {
                        this.updateValidation.email = 'This field is required.';
                        this.updateStatus.email = true;
                    } else if (this.emails.includes(this.mainUser.email)) {
                        this.updateValidation.email = 'This email has already taken.';
                        this.updateStatus.email = true;
                    } else if (!this.mainUser.email.match(re)) {
                        this.updateValidation.email = 'This email is invalid.';
                        this.updateStatus.email = true;
                    } else {
                        this.updateValidation.email = '';
                        this.updateStatus.email = false;
                    }
        },
        getPhones () {
            let arr = [];
            let formData = {
                id: this.user
            };
            axios.post('http://localhost:8000/api/user/phoneValidation', formData).then((response) => {
            for (let i = 0;i < response.data.users.length;i++) {
                    let user = response.data.users[i];
                    let phone = user.phone;
                    arr.push(phone);
                    this.phones = arr;
                }
            });
        },
        phoneValidationCheck () {
                if (!this.mainUser.phone.length) {
                    this.updateStatus.phone = true;
                    this.updateValidation.phone = 'This field is required.';
                }else if (this.mainUser.phone.length < 8) {
                    this.updateValidation.phone = 'This phone number is invalid';
                    this.updateStatus.phone = true;
                } else if (this.phones.includes(this.mainUser.phone)) {
                    this.updateValidation.phone = 'This phone number is already taken.';
                    this.updateStatus.phone = true;
                }   else {
                    this.updateValidation.phone = '';
                    this.updateStatus.phone = false;
                }

        },
        addressValidationCheck () {
            if (!this.mainUser.address.length) {
                this.updateStatus.address = true;
                this.updateValidation.address = 'This field is required.'
            } else if (this.mainUser.address.length < 5) {
                this.updateStatus.address = true;
                this.updateValidation.address = "Address 's length is too short"
            } else {
                this.updateStatus.address = false;
                this.updateValidation.address = ''
            }
        },
        updateProfile () {
            this.nameValidationCheck();
            this.emailValidationCheck();
            this.phoneValidationCheck();
            this.addressValidationCheck();
            if (!this.updateStatus.name && !this.updateStatus.email && !this.updateStatus.phone && !this.updateStatus.address) {
                let formData = {
                    id: this.user,
                    name: this.mainUser.name,
                    email: this.mainUser.email,
                    phone: this.mainUser.phone,
                    address: this.mainUser.address,
                    gender: this.mainUser.gender,
                    image: this.mainUser.image
                };
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                };
                axios.post('http://localhost:8000/api/user/updateProfile', formData, config).then((response) => {
                    if (response.data.status == 'success') {
                        window.location.href = 'http://localhost:8000/user/home';
                        const now = new Date();
                        let item = {
                            status : 'success',
                            expiry : now.getTime() + 3000
                        };
                        localStorage.setItem('profileUpdateStatus', JSON.stringify(item));
                    }
                })
            }
        }
    },
    mounted () {
        this.getLoggedInUser();
        this.getEmails();
        this.getPhones();
    },
}
