import axios from "axios"
import { times } from "lodash";

export default {
    name: 'EditCategory',
    data () {
        return {
            category: {},
            url: '',
            updatedCategory: {
                name: '',
                image: '',
                description: ''
            },
            validitionStatus: {
                name: true,
                image: true,
                description: true
            },
            validationMessage: {
                name: '',
                image: '',
                description: ''
            }
        }
    },
    methods: {
        getCategory () {
            let id = localStorage.getItem('categoryId');
            let formData = {
                id: id
            }
            axios.post('http://localhost:8000/api/category/edit/id', formData).then((response) => {
                this.category = response.data.category;
                this.updatedCategory.name = response.data.category.name;
                this.updatedCategory.description = response.data.category.description;
            })
        },
        pickFile (e) {
            let files = e.target.files[0];
            this.url = URL.createObjectURL(files);
            this.updatedCategory.image = files;
        },
        nameValidationCheck () {
            if (!this.updatedCategory.name.length) {
                this.validationMessage.name = 'This field is required.';
                this.validitionStatus.name = true;
            } else if (this.updatedCategory.name.length < 3) {
                this.validationMessage.name = "Category's name is too short."
                this.validitionStatus.name = true;
            } else {
                this.validitionStatus.name = false;
                this.validationMessage.name = '';
            }
        },
        imageValidationCheck () {
            let image = document.getElementById('image');
            let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.webp)$/i;
            if (!image.value) {
                this.validationMessage.image = '';
                this.validitionStatus.image = false;
            } else if (!allowedExtensions.exec(image.value)) {
                this.validationMessage.image = 'Uploaded file must be image.';
                this.validitionStatus.image = true;
            } else {
                this.validitionStatus.image = false;
                this.validationMessage.image = '';
            }
        },
        descriptionValidationCheck () {
            if (!this.updatedCategory.description.length) {
                this.validationMessage.description = 'This field is required';
            } else if (this.updatedCategory.description.length < 8) {
                this.validationMessage.description = "Description's length is too short.";
            } else {
                this.validationMessage.description = '';
                this.validitionStatus.description = false;
            }
        },
        updateCategory () {
            let id = document.getElementById('categoryId');
            this.nameValidationCheck();
            this.imageValidationCheck();
            this.descriptionValidationCheck();
            if (this.validitionStatus.name == false && this.validitionStatus.image == false && this.validitionStatus.description == false) {
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                };
                let formData = {
                    id: id.value,
                    name: this.updatedCategory.name,
                    image: this.updatedCategory.image,
                    description: this.updatedCategory.description
                }
                axios.post('http://localhost:8000/api/category/update', formData, config).then((response) => {
                    if (response.data.status == 'success') {
                        window.location.href = 'http://localhost:8000/admin/categoryPage';
                        const now = new Date();
                        let item = {
                            value: 'success',
                            expiry: now.getTime() + 3000
                        }
                        localStorage.setItem('categoryUpdateSuccess', JSON.stringify(item));
                    }
                })
            }
        }
    },
    mounted () {
        this.getCategory();
    }
}
