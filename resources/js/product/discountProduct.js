import axios from "axios";

export default {
    name: 'DiscountProduct',
    data () {
        return {
            productId: localStorage.getItem('productId'),
            product: {
                name: '',
                normalPrice: '',
                image : ''
            },
            discountPrice: ''
        }
    },
    methods: {
        getProduct () {
            let formData = {
                id: this.productId
            };
            axios.post('http://localhost:8000/api/products/productWithId', formData).then((response) => {
                this.setData(response);
            })
        },
        setData (response) {
            this.product.normalPrice = response.data.product.price;
            this.product.name = response.data.product.name;
            this.product.image = response.data.product.image;
        },
        setDiscount() {
            let formData = {
                id: this.productId,
                discountPrice: this.discountPrice,
                normalPrice: this.product.normalPrice
            };
            axios.post('http://localhost:8000/api/products/updateWithDiscountPrice', formData).then((response) => {
                if (response.data.status == 'success') {
                    window.location.href = 'http://localhost:8000/admin/products/page';
                }
            })
        }
    },
    mounted () {
        this.getProduct();
    }
}
