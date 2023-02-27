import axios from "axios"

export default {
    name: 'Message',
    data() {
        return {
            messages : [],
            replyStatus: ''
        }
    },
    methods: {
        getMessages () {
            axios.get('http://localhost:8000/api/message/list').then((response) => {
                this.messages = response.data.messages;
            })
        },
        replyPage (messageId) {
            window.location.href = "http://localhost:8000/admin/message/reply";
            localStorage.setItem('messageId', messageId)
        },
        getLocalStorageDataWithExpiry () {
            const now = new Date();
            let itemStr = localStorage.getItem('adminReplyStatus');
            if (itemStr) {
                let item = JSON.parse(itemStr);
                if (now.getTime() > item.expiry) {
                    this.replyStatus = '';
                    localStorage.removeItem('productUpdateStatus');
                } else {
                    this.replyStatus = item.value;
                }
            }
        },
    },
    mounted () {
        this.getMessages();
        this.getLocalStorageDataWithExpiry();
    },
}
