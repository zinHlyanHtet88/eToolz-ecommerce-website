import axios from "axios";

export default {
    name: "Edit",
    props: ["user"],
    data() {
        return {
            mainUser: {},
            url: "",
            updatedProfile: {
                name: "",
                email: "",
                phone: "",
                gender: "",
                address: "",
                image: "",
            },
            updateValidation: {
                name: "",
                email: "",
                phone: "",
                gender: "",
                address: "",
                image: "",
            },
            updateValidationStatus: {
                name: true,
                email: true,
                phone: true,
                gender: true,
                address: true,
                image: true,
            },
            emails: "",
            phones: ''
        };
    },
    methods: {
        getLoggedInUserData() {
            let formData = {
                id: this.user,
            };
            axios
                .post(
                    "http://localhost:8000/api/admin/getLoggedInUserData",
                    formData
                )
                .then((response) => {
                    this.setUpData(response);
                });
        },
        setUpData(response) {
            this.mainUser = response.data.mainUser;
            this.updatedProfile.name = response.data.mainUser.name;
            this.updatedProfile.email = response.data.mainUser.email;
            this.updatedProfile.phone = response.data.mainUser.phone;
            this.updatedProfile.gender = response.data.mainUser.gender;
            this.updatedProfile.address = response.data.mainUser.address;
        },
        pickFile(e) {
            let files = e.target.files[0];
            this.url = URL.createObjectURL(files);
            this.updatedProfile.image = files;
        },
        nameValitdationCheck() {
            if (!this.updatedProfile.name.length) {
                this.updateValidation.name = "This field is required.";
                this.updateValidationStatus.name = true;
            } else if (this.updatedProfile.name.length < 5) {
                this.updateValidation.name = "Name's length is too short.";
                this.updateValidationStatus.name = true;
            } else {
                this.updateValidation.name = "";
                this.updateValidationStatus.name = false;
            }
        },
        emailValidationCheck() {
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    if (!this.updatedProfile.email.length) {
                        this.updateValidation.email = 'This field is required.';
                        this.updateValidationStatus.email = true;
                    } else if (this.emails.includes(this.updatedProfile.email)) {
                        this.updateValidation.email = 'This email has already taken.';
                        this.updateValidationStatus.email = true;
                    } else if (!this.updatedProfile.email.match(re)) {
                        this.updateValidation.email = 'This email is invalid.';
                        this.updateValidationStatus.email = true;
                    } else {
                        this.updateValidation.email = '';
                        this.updateValidationStatus.email = false;
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
            })
        },
        phoneValidationCheck () {
            if (!this.updatedProfile.phone.length) {
                this.updateValidationStatus.phone = true;
                this.updateValidation.phone = 'This field is required.';
            }else if (this.updatedProfile.phone.length < 8) {
                this.updateValidation.phone = 'This phone number is invalid';
                this.updateValidationStatus.phone = true;
            } else if (this.phones.includes(this.updatedProfile.phone)) {
                this.updateValidation.phone = 'This phone number is already taken.';
                this.updateValidationStatus.phone = true;
            }   else {
                this.updateValidation.phone = '';
                this.updateValidationStatus.phone = false;
            }
        },
        addressValidationCheck () {
            if (!this.updatedProfile.address.length) {
                this.updateValidationStatus.address = true;
                this.updateValidation.address = 'This field is required.';
            } else if (this.updatedProfile.address.length < 5) {
                this.updateValidationStatus.address = true;
                this.updateValidation.address = "Address 's length is too short."
            } else {
                this.updateValidationStatus.address = false;
                this.updateValidation.address = '';
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
        imageValidationCheck () {
            let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.webp)$/i;
            let image = document.getElementById('custom-file').value;
            if (!allowedExtensions.exec(image)) {
                this.updateValidationStatus.image = true;
                this.updateValidation.image = 'Uploaded file must be image';
            } else {
                this.updateValidationStatus.image = false;
                this.updateValidation.image = '';
            }
        },
        updateProfile() {
            this.nameValitdationCheck();
            this.emailValidationCheck();
            this.phoneValidationCheck();
            this.addressValidationCheck();
            this.imageValidationCheck();
            if (!this.updateValidationStatus.name && !this.updateValidationStatus.email && !this.updateValidationStatus.phone && !this.updateValidationStatus.address && !this.updateValidationStatus.image) {
                let formData = {
                    name: this.updatedProfile.name,
                    email: this.updatedProfile.email,
                    phone: this.updatedProfile.phone,
                    gender: this.updatedProfile.gender,
                    address: this.updatedProfile.address,
                    image: this.updatedProfile.image,
                    id: this.user
                };
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                };
                axios.post('http://localhost:8000/api/admin/updateProfile', formData, config).then((response) => {
                    if (response.data.status == 'success') {
                        window.location.href = 'http://localhost:8000/admin/profile/page';
                        const now = new Date();
                        let item = {
                            value: 'success',
                            expiry: now.getTime() + 3000
                        };
                        localStorage.setItem('updateStatus', JSON.stringify(item));
                    }
                })
            }
        },
    },
    mounted() {
        this.getLoggedInUserData();
        this.getEmails();
        this.getPhones();
    },
};
