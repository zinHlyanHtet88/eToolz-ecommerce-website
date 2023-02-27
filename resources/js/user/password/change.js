import axios from "axios";


export default {
    name: 'Change',
    props: ['user'],
    data() {
        return {
            oldPassword: '',
            newPassword: '',
            confirmPassword: '',
            passwordChangeStatus: '',
            passwordValidation: {
                oldPassword: ''
            },
            passwordStatus: {
                oldPassword: true
            },
            loggedInUserPassword: ''
        }
    },
    methods: {
        oldPasswordValidationCheck () {
            const bcrypt = require('bcrypt');
            bcrypt.compare(oldPassword, loggedInUserPassword, function (err, result) {
                if (!result) {
                    this.passwordValidation.oldPassword = 'Old password does not match.';
                    this.passwordStatus.oldPassword = true;
                } else {
                    this.passwordValidation.oldPassword = '';
                    this.passwordStatus.oldPassword = false;
                }
            })
        },
        changePassword () {
            this.oldPasswordValidationCheck();
            let formData = {
                oldPassword: this.oldPassword,
                newPassword: this.newPassword,
                userId: this.user
            };
            if (!this.passwordStatus.oldPassword) {
                axios.post('http://localhost:8000/api/user/password/change', formData).then((response) => {

                });
            }
        },
        getLoggedInUserPassword () {
            let formData = {
                userId: this.user
            };
            axios.post('http://localhost:8000/api/user/password/get', formData).then((response) => {
                this.loggedInUserPassword = response.data.password;
            })
        }
    },
    mounted () {
        this.getLoggedInUserPassword();
    },
}
