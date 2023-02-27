import axios from "axios";

export default {
    name: 'ReviewCategory',
    data () {
        return {
            category: {}
        }
    },
    methods: {
        getCategory () {
            let id = localStorage.getItem('categoryId');
            let formData = {
                id: id
            };
            axios.post('http://localhost:8000/api/category/edit/id', formData).then((response) => {
                this.category = response.data.category;
            });
        }
    },
    mounted () {
        this.getCategory();
    }
}
