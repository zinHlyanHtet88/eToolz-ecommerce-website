import axios from "axios";

export default {
    name: 'NotiMessage',
    props: ['user'],
    data() {
        return {
            privateMessages : []
        }
    },
    methods: {
        getPrivateMessages() {
            let formData = {
                userId: this.user
            };
            axios.post('http://localhost:8000/api/message/getPrivateMessage', formData).then((response) => {
                this.privateMessages = response.data.privateMessages;
            })
        },
        deleteMessage (e) {
            let parent = e.target.parentElement.closest('.content');
            let id = parent.querySelector('.messageId').value;
            let formData = {
                id: id
            };
            axios.post('http://localhost:8000/api/message/deletePrivateMessage', formData).then((response) => {
                parent.remove();
            })
        }
    },
    mounted () {
        this.getPrivateMessages();
    },
}
