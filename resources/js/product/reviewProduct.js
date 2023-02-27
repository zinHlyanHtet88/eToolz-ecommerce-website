import axios from "axios";

export default {
    name: 'ReviewProduct',
    data () {
        return {
            product : {}
        }
    },
    methods: {
        getProduct () {
            let id = localStorage.getItem('productId');
            let formData = {
                id: id
            };
            axios.post('http://localhost:8000/api/products/productWithId', formData).then((response) => {
                this.product = response.data.product;
            })
        },
        discountItemAddPage (id) {
            window.location.href = 'http://localhost:8000/admin/products/discountProduct';
            localStorage.setItem('productId', id);
        }
    },
    mounted () {
        this.getProduct();
    }
}
