import axios from "axios"

export default {
    name: 'Home',
    data () {
        return {
            categories: [],
            discountProducts: [],
            profileUpdateStatus: ''
        }
    },
    methods: {
        getCategories () {
            axios.get('http://localhost:8000/api/category/list').then((response) => {
                this.categories = response.data.category;
            })
        },
        getDiscountProducts () {
            axios.get('http://localhost:8000/api/products/getDiscountProducts').then((response) => {
                this.discountProducts = response.data.discountProducts;
            })
        },
        sameCategoryProducts (categoryName) {
            window.location.href = 'http://localhost:8000/user/products/allList';
            localStorage.setItem('categoryName', categoryName);
        },
        productDetailPage (productId) {
            window.location.href = 'http://localhost:8000/user/products/detail';
            localStorage.setItem('productId', productId);
        },
        carouselDetailPage () {
            window.location.href = 'http://localhost:8000/user/products/detail';
            localStorage.setItem('productId', 9);
        },
        getProfileUpdateStatus () {
            const now = new Date();
            let itemStr = localStorage.getItem('profileUpdateStatus');
            if (itemStr) {
                let item = JSON.parse(itemStr);
                if (now.getTime() > item.expiry) {
                    this.profileUpdateStatus = '';
                    localStorage.removeItem('profileUpdateStatus');
                } else {
                    this.profileUpdateStatus = item.status;
                }
            }
        }
    },
    mounted () {
        this.getCategories();
        this.getDiscountProducts();
        this.getProfileUpdateStatus();
    }
}
