import axios from "axios";
export default {
    name: 'Message',
    props: ['user'],
    data() {
        return {
            user1: {
                name: '',
                email: '',
                phone: '',
                message: '',
            },
            sendStatus: false
        }
    },
    methods: {
        sendMessage() {
            let formData = {
                name: this.user1.name,
                email: this.user1.email,
                phone: this.user1.phone,
                message: this.user1.message,
                userId: this.user
            };
            axios.post('http://localhost:8000/api/message/send', formData).then((response) => {
                if (response.data.status == 'success') {
                    this.sendStatus = true;
                    this.user1.name = '';
                    this.user1.email= '';
                    this.user1.phone = '';
                    this.user1.message= '';
                }
            })
        },
        closeNoti () {
            this.sendStatus = false;
        }
    },
}
