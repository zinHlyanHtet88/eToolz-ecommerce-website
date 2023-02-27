import axios from "axios";

export default {
    name: 'CartList',
    props: ['user'],
    data () {
        return {
            carts: [],
            quantityInput: '',
            subTotal: '',
            updatedCarts: [],
            semiTotal: '',
            deliveryFee: 3000,
            addOrderValidation: ''
        }
    },
    methods: {
        getCarts () {
            let arr = [];
            let formData = {
                userId: this.user
            };
            axios.post('http://localhost:8000/api/cart/list', formData).then((response) => {
                this.carts = response.data.carts;
                let carts = response.data.carts;
                for (let i = 0;i < carts.length;i++) {
                    arr.push(carts[i].sub_total);
                    this.semiTotal = arr.reduce((partialSum, a) => partialSum + a, 0);
                }
            })
        },

        plusBtn (e) {
            let parent = e.target.parentElement.closest('tr');
            let oldVal = parent.querySelector('.quantityInput').value;
            let newVal = parseFloat(oldVal) + 1;
            parent.querySelector('.quantityInput').value = newVal;

            let price = parent.querySelector('.price').innerHTML;
            parent.querySelector('.total').innerHTML = price * newVal;

            this.updateCart(e);

            this.setSemiTotal();


        },
        minusBtn (e) {
            let parent = e.target.parentElement.closest('tr');
            let oldVal = parent.querySelector('.quantityInput').value;
            let newVal = parseFloat(oldVal) - 1;
            parent.querySelector('.quantityInput').value = newVal;

            let price = parent.querySelector('.price').innerHTML;
            parent.querySelector('.total').innerHTML = price * newVal;

            this.setQuantityTotalMin(e);
            this.updateCart(e);
            this.setSemiTotal();
        },
        deleteCart (e) {
            let parent = e.target.parentElement.closest('tr');
            let id = parent.querySelector('.hiddenId').value;
            let formData = {
                id: id
            };
            axios.post('http://localhost:8000/api/cart/delete', formData).then((response) => {
                if (response.data.status == 'success') {
                    parent.remove();
                    this.getCarts();
                }
            })
        },
        updateCart (e) {
            let parent = e.target.parentElement.closest('tr');
            let formData = {
                id : parent.querySelector('.hiddenId').value,
                quantity: parent.querySelector('.quantityInput').value,
                subTotal:  parent.querySelector('.total').innerHTML,
                userId: this.user
            };
            axios.post('http://localhost:8000/api/cart/update', formData).then((response) => {
                this.carts = response.data.updatedCarts;
            })
        },
        setQuantityTotalMin (e) {
            let parent = e.target.parentElement.closest('tr');
            if (parent.querySelector('.total').innerHTML < 0) {
                parent.querySelector('.total').innerHTML = 0;
            }
            if (parent.querySelector('.quantityInput').value < 0) {
                parent.querySelector('.quantityInput').value = 0;
            }
        },
        setSemiTotal () {
            let arr = []
            let formData = {
                userId: this.user
            };
            axios.post('http://localhost:8000/api/cart/list', formData).then((response) => {
                let carts = response.data.carts;
                for (let i = 0;i < carts.length;i++) {
                    arr.push(carts[i].sub_total);
                    let sum = arr.reduce((partialSum, a) => partialSum + a, 0);
                    document.getElementById('semiTotal').innerHTML = sum;
                    let deliveryFee = document.getElementById('deliveryFee').innerHTML;
                    document.getElementById('finalTotal').innerHTML = sum + parseInt(deliveryFee);
                }
            })

        },
        addToOrderList () {
            if (parseInt(document.getElementById('finalTotal').innerHTML) == 3000) {
                this.addOrderValidation = 'Please add products to cart first.';
            } else {
                let formData = {
                    orders: this.carts,
                    userId: this.user,
                    orderCode: Math.floor(Math.random() * 99999) + 10000,
                    totalPrice: parseInt(document.getElementById('finalTotal').innerHTML)
                };
                axios.post('http://localhost:8000/api/orderList/add', formData).then((response) => {
                    if (response.data.status == 'success') {
                        window.location.href = 'http://localhost:8000/dashboard';
                    }
                })
            }
        },
    },
    computed: {

    },
    mounted () {
    this.getCarts();

    }
}

