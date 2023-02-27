import axios from "axios";

export default {
    name: 'AllList',
    data () {
        return {
            sameCategoryProductsWithCount: [],
            products: [],
            discountProducts : [],
            sameCategoryProductsOnClickValue: '', 
            totalProducts: []
        }
    },
    methods: {
        getSameCategoryProducts () {
            axios.get('http://localhost:8000/api/products/sameCategoryProductsWithCount').then((response) => {
                this.sameCategoryProductsWithCount = response.data.sameCategoryProductsWithCount;
            })
        },
        getProducts () {
            axios.get('http://localhost:8000/api/products/list').then((response) => {
                this.products = response.data.products;
                this.totalProducts = response.data.products;
            })
        },
        sameCategoryProductsOnClick (categoryName) {
            this.sameCategoryProductsOnClickValue = categoryName;
            let formdata = {
                categoryName: categoryName
            };
            axios.post('http://localhost:8000/api/products/sameCategoryProductsOnClick', formdata).then((response) => {
                this.products = response.data.sameCategoryProductsOnClick;
            });
        },
        getAllDevices () {
            this.sameCategoryProductsOnClickValue = 'Devices';
            axios.get('http://localhost:8000/api/products/list').then((response) => {
                this.products = response.data.products;
            })
        },
        getDiscountProducts () {
            this.sameCategoryProductsOnClickValue = 'Discount Products';
            axios.get('http://localhost:8000/api/products/getDiscountProducts').then((response) => {
                this.products = response.data.discountProducts;
            })
        },
        setDiscountProducts () {
            axios.get('http://localhost:8000/api/products/getDiscountProducts').then((response) => {
                this.discountProducts = response.data.discountProducts;
            })
        },
        home () {
            window.location.href = 'http://localhost:8000/dashboard';
        },
        setProducts () {
            if (localStorage.getItem('categoryName')) {
                let categoryName = localStorage.getItem('categoryName');
                this.sameCategoryProductsOnClickValue = categoryName;
                let formData = {
                    categoryName: categoryName
                };
                axios.post('http://localhost:8000/api/products/sameCategoryProductsOnClick', formData).then((response) => {
                    this.products = response.data.sameCategoryProductsOnClick;
                })
            }
        },
        getProductsBySorting (e) {
            let value = e.target.value;
            let formData = {
                sortingValue: value,
                categoryName: this.sameCategoryProductsOnClickValue
            }
            axios.post('http://localhost:8000/api/products/getProductsBySorting', formData).then((response) => {
                this.products = response.data.products;
            })
        },
        productDetailPage (productId) {
            window.location.href = 'http://localhost:8000/user/products/detail';
            localStorage.setItem('productId', productId);
        },
    },
    mounted () {
        this.getSameCategoryProducts();
        this.getProducts();
        this.setDiscountProducts();
        this.setProducts();

    }
}
