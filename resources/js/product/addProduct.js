import axios from "axios"
import { toHandlers } from "vue";

export default {
    name: 'AddProduct',
    data () {
        return {
            product: {
                name: '',
                categoryName: {
                    name: ''
                },
                description: '',
                storage: '',
                memory: '',
                processor: '',
                sim: '',
                size: '',
                price: '',
                image: ''
            },
            validation: {
                productName: '',
                productNameStatus: true,
                category: '',
                categoryStatus: true,
                description: '',
                descriptionStatus: true,
                price: '',
                priceStatus: true,
                image: '',
                imageStatus: true
            },
            categories : []
        }
    },
    methods: {
        getCategories () {
            axios.get('http://localhost:8000/api/category/list').then((response) => {
                this.categories = response.data.category;
            })
        },
        productNameValidationCheck () {
            if (!this.product.name.length) {
                this.validation.productName = 'This field is required.'
            } else if (this.product.name.length < 5) {
                this.validation.productName ='Product Name is too stort.'
            } else {
                this.validation.productName = ''
                this.validation.productNameStatus = false
            }
        },
        categoryValidationCheck () {
            if (!this.product.categoryName.name.length) {
                this.validation.category = 'This field is required.'
            } else {
                this.validation.category = '';
                this.validation.categoryStatus = false
            }
        },
        priceValidationCheck () {
            if (isNaN(this.product.price)) {
                this.validation.price = 'Please enter a numeric number.'
            } else if (!this.product.price.length) {
                this.validation.price = 'This field is required.'
            } else {
                this.validation.price = '';
                this.validation.priceStatus = false
            }
        },
        imageValidationCheck () {
            let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.webp)$/i;
            let image = document.getElementById('image')
            if (image.files.length == 0) {
                this.validation.image = 'This field is required.'
            } else if (!allowedExtensions.exec(image.value)) {
                this.validation.image = 'Uploaded file must be image.'
            } else {
                this.validation.image = ''
                this.validation.imageStatus = false
            }
        },
        descriptionValidationCheck () {
            if (!this.product.description.length) {
                this.validation.description = 'This field is required.'
            } else if (this.product.description.length < 7) {
                this.validation.description = "Description's length is too short."
            } else {
                this.validation.description = '';
                this.validation.descriptionStatus = false;
            }
        },
        createPost () {
            this.productNameValidationCheck();
            this.categoryValidationCheck();
            this.priceValidationCheck();
            this.imageValidationCheck();
            this.descriptionValidationCheck();
                if (this.validation.productNameStatus == false && this.validation.categoryStatus == false && this.validation.descriptionStatus == false && this.validation.priceStatus == false && this.validation.imageStatus == false) {
                    const config = {
                        headers: {
                            'content-type': 'multipart/form-data'
                        }
                    };
                    let formData = {
                        name: this.product.name,
                        categoryName: this.product.categoryName.name,
                        description: this.product.description,
                        storage: this.product.storage,
                        sim: this.product.sim,
                        memory: this.product.memory,
                        processor: this.product.processor,
                        size: this.product.size,
                        price: this.product.price,
                        image: this.product.image
                    };
                    axios.post('http://localhost:8000/api/products/create', formData, config).then((response) => {
                        if (response.data.status == 'success') {
                            window.location.href = 'http://localhost:8000/admin/products/page'
                        }
                    })
                }

        },
        fileChange (e) {
            this.product.image = e.target.files[0];
        }
    },
    mounted () {
        this.getCategories();
    }
}
