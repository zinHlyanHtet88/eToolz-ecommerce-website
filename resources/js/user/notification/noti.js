import axios from "axios";

export default {
    name: 'Noti',
    props: ['user'],
    data () {
        return {
            orders: [],
            orderLists: []
        }
    },
    methods: {
        getnoti () {
            let formData = {
                userId: this.user
            };
            axios.post('http://localhost:8000/api/noti/get', formData).then((response) => {
                this.orders = response.data.orders;
                this.orderLists = response.data.orderLists;
            })
        },
        deleteOrder (e) {
            let parent = e.target.parentElement.closest('.order');
            let orderCode = parent.querySelector('.orderCode').value;
            let formData = {
                orderCode: orderCode
            }
            axios.post('http://localhost:8000/api/order/delete', formData).then((response) => {
                if (response.data.status == 'success') {
                    parent.remove();
                } 
            })
        }
    },
    mounted () {
        this.getnoti();
    }
}