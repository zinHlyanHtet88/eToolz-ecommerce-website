import axios from "axios";

export default {
    name: 'Reply',
    data() {
        return {
            message: [],
            adminReply: ''
        }
    },
    methods: {
        getMessage() {
            let formData = {
                messageId: localStorage.getItem('messageId')
            };
            axios.post('http://localhost:8000/api/message/getMessageWithId', formData).then((response) => {
                this.message = response.data.message;
            })
        },
        reply (userId) {
            let formData = {
                userId: userId,
                adminReply: this.adminReply
            }
            axios.post('http://localhost:8000/api/message/adminReply', formData).then((response) => {
                if (response.data.status == 'success') {
                    window.location.href = "http://localhost:8000/admin/message/list";
                    const now = new Date();
                    let item = {
                        value: 'success',
                        expiry: now.getTime() + 3000
                    };
                    localStorage.setItem('adminReplyStatus', JSON.stringify(item));
                }
            })
        }
    },
    mounted () {
        this.getMessage();
    },
}
