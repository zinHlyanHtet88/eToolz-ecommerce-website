import axios from "axios";

export default {
    name: "EditProduct",
    data() {
        return {
            product: {},
            categories: [],
            updatedProduct: {
                id: localStorage.getItem('productId'),
                name: "",
                price: "",
                sim: '',
                storage: '',
                memory: '',
                size: '',
                processor: '',
                description: '',
                image : '',
                category: ''
            },
            url: '',
            validationMessage: {
                name: '',
                categoryName: '',
                image: '',
                price: '',
                description: ''
            },
            validationStatus: {
                name: true,
                categoryName: true,
                image: true,
                price: true,
                description: true
            }
        };
    },
    methods: {
        getProduct() {
            let formData = {
                id: localStorage.getItem("productId"),
            };
            axios
                .post(
                    "http://localhost:8000/api/products/productWithId",
                    formData
                )
                .then((response) => {
                    this.setMatchingItem(response);
                });
        },
        setMatchingItem (response) {
            this.product = response.data.product;
            this.updatedProduct.name = response.data.product.name;
            this.updatedProduct.price = response.data.product.price;
            this.updatedProduct.category = response.data.product.category_name;
            this.updatedProduct.sim = response.data.product.sim;
            this.updatedProduct.storage = response.data.product.storage;
            this.updatedProduct.size = response.data.product.size;
            this.updatedProduct.processor = response.data.product.processor;
            this.updatedProduct.memory = response.data.product.memory;
            this.updatedProduct.description = response.data.product.description;
            this.updatedProduct.image = response.data.product.image;
        },
        getCategories() {
            axios
                .get("http://localhost:8000/api/category/list")
                .then((response) => {
                    this.categories = response.data.category;
                });
        },
        pickFile (e) {
            let files = e.target.files[0];
            this.url = URL.createObjectURL(files);
            this.updatedProduct.image = files;
            console.log(files);
        },
        nameValidationCheck () {
            if (!this.updatedProduct.name.length) {
                this.validationMessage.name = 'This field is required.';
            } else if (this.updatedProduct.name.length < 4) {
                this.validationMessage.name = "Product's name length is too short."
            } else {
                this.validationMessage.name = '';
                this.validationStatus.name = false;
            }
        },
        priceValidationCheck () {
            if (this.updatedProduct.price == '') {
                this.validationMessage.price = 'This field is required.';
            } else if (isNaN(this.updatedProduct.price)) {
                this.validationMessage.price = 'Please enter a numeric number.';
            } else {
                this.validationMessage.price = '';
                this.validationStatus.price = false;
            }
        },
        categoryValidationCheck () {
            if (this.updatedProduct.category == 'Change Category') {
                this.validationMessage.categoryName = 'This field is required.'
            } else {
                this.validationMessage.categoryName = '';
                this.validationStatus.categoryName = false;
            }
        },
        imageValidationCheck () {
            let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.webp)$/i;
            let image = document.getElementById('custom-file');
            if (image.value == '') {
                this.validationMessage.image = '';
                this.validationStatus.image = false;
            } else if (!allowedExtensions.exec(image.value)) {
                this.validationMessage.image = 'Uploaded file must be image.'
            } else {
                this.validationMessage.image = '';
                this.validationStatus.image = false;
            }
        },
        descriptionValidationCheck() {
            if (this.updatedProduct.description == '') {
                this.validationMessage.description = 'This field is required.';
            } else if (this.updatedProduct.description.length < 5) {
                this.validationMessage.description = "Description's length is too short.";
            } else {
                this.validationMessage.description = '';
                this.validationStatus.description = false;
            }
        },
        updateProduct () {
            this.nameValidationCheck();
            this.priceValidationCheck();
            this.categoryValidationCheck();
            this.imageValidationCheck();
            this.descriptionValidationCheck();
            if (!this.validationStatus.name && !this.validationStatus.price && !this.validationStatus.categoryName && !this.validationStatus.image && !this.validationStatus.description) {
                let formData = {
                    name: this.updatedProduct.name,
                    categoryName: this.updatedProduct.category,
                    price: this.updatedProduct.price,
                    image: this.updatedProduct.image,
                    sim: this.updatedProduct.sim,
                    storage: this.updatedProduct.storage,
                    size: this.updatedProduct.size,
                    memory: this.updatedProduct.memory,
                    processor: this.updatedProduct.processor,
                    description: this.updatedProduct.description,
                    id: this.updatedProduct.id
                };
                const config = {
                    headers : {
                        'content-type' : 'multipart/form-data'
                    }
                };
                axios.post('http://localhost:8000/api/products/updateProduct', formData, config).then((response) => {
                    if (response.data.status == 'success') {
                        window.location.href = 'http://localhost:8000/admin/products/page';
                        const now = new Date();
                        let item = {
                            value: 'success',
                            expiry: now.getTime() + 3000
                        }
                        localStorage.setItem('productUpdateStatus', JSON.stringify(item));
                    }
                })
            }
        }
    },
    mounted() {
        this.getProduct();
        this.getCategories();
    },
};
