import axios, { all } from "axios";

export default {
    name: "CreateCategory",
    data() {
        return {
            category: {
                name: "",
                image: "",
                description: ''
            },
            validationMessage : {
                name: '',
                image: '',
                description: ''
            },
            validationStatus: {
                name: true,
                image: true,
                description: true
            }
        };
    },
    methods: {
        nameValidationCheck () {
            if (!this.category.name.length) {
                this.validationMessage.name = 'This field is required.'
            } else if (this.category.name.length < 4) {
                this.validationMessage.name = "Name's length is too short."
            } else {
                this.validationMessage.name = '';
                this.validationStatus.name = false;
            }
        },
        imageValidationCheck () {
            let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.webp)$/i;
            let image = document.getElementById('image');
            if (!image.files.length) {
                this.validationMessage.image = 'This field is required.';
            } else if (!allowedExtensions.exec(image.value)) {
                this.validationMessage.image = 'Uploaded file must be image.';
            } else {
                this.validationMessage.image = '';
                this.validationStatus.image = false;
            }
        },
        descriptionValidationCheck () {
            if (!this.category.description.length) {
                this.validationMessage.description = 'This field is required';
            } else if (this.category.description.length < 7) {
                this.validationMessage.description = "Description's length is too short.";
            } else {
                this.validationMessage.description = '';
                this.validationStatus.description = false;
            }
        },
        createCategory() {
            this.nameValidationCheck();
            this.imageValidationCheck();
            this.descriptionValidationCheck();
            if (this.validationStatus.name == false && this.validationStatus.image == false && this.validationStatus.description == false) {
                const config = {
                    headers: {
                        "content-type": "multipart/form-data",
                    }
                };
                let formData = {
                    name: this.category.name,
                    image: this.category.image,
                    description: this.category.description
                };
                axios.post('http://localhost:8000/api/category/create', formData, config).then((response) => {
                    if (response.data.status == 'success') {
                        window.location.href = 'http://localhost:8000/admin/categoryPage';
                    }
                })
            }
         },
        getImageInfo(e) {
            let info = e.target.files[0];
            this.category.image = info;
        },
    },
};
