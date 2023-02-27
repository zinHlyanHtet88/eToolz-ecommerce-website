import axios from "axios";



export default {
    name: 'CategoriesGrid',
    data () {
        return {
            categories: [],
            searchValue: '',
            updateStatus: '',
            pagination: {},
            currentPage: 1,
        }
    },
    computed: {
        pages() {
          if (!this.pagination.to) {
            return [];
          }
          let from = this.pagination.current_page - 2;
          if (from < 1) {
            from = 1;
          }
          let to = from + (2 * 2);
          if (to >= this.pagination.last_page) {
            to = this.pagination.last_page;
          }
          let pagesArray = [];
          while (from <= to) {
            pagesArray.push(from);
            from++;
          }
          return pagesArray;
        }
      },
    methods: {
        getCategories (page = 1, search = '') {
            axios.post('http://localhost:8000/api/category/paginate?page=' + page + '&search=' + search).then((response) => {
                this.categories = response.data.category.data;
                this.pagination = response.data.category;
                this.currentPage = response.data.category.current_page;
            })
        },
        createCategory () {
            window.location.href = 'http://localhost:8000/admin/category/createPage';
        },
        deleteCategory (e) {
            let button = e.target;
            let parent = button.parentElement.closest('tr');
            let id = parent.querySelector('th').innerHTML;
            let imgName = parent.querySelector('input').value;
            let formData = {
                id: id,
                imgName: imgName

            }
            axios.post('http://localhost:8000/api/category/delete', formData).then((response) => {
                if (response.data.status == 'success') {
                    parent.remove();
                    window.location.reload();
                }
            });
        },
        editCategory (e) {
            let parent = e.target.parentElement.closest('tr');
            let id = parent.querySelector('th').innerHTML;
            localStorage.setItem('categoryId', id);
            window.location.href = 'http://localhost:8000/admin/category/editPage';
        },
        reviewCategory (id) {
            localStorage.setItem('categoryId', id);
            window.location.href = 'http://localhost:8000/admin/category/reviewPage';
        },
        getLocalStorageDataWithExpiry () {
            const now = new Date();
            let itemStr = localStorage.getItem('categoryUpdateSuccess');
            if (itemStr) {
                let item = JSON.parse(itemStr);
                if (now.getTime() > item.expiry) {
                    localStorage.removeItem('categoryUpdateSuccess');
                    this.updateStatus = ''
                } else {
                    this.updateStatus = item.value;
                }
            }

        },
        userDashboard () {
            window.location.href = 'http://localhost:8000/user/home';
        }
    },
    mounted () {
        this.getCategories();
        this.getLocalStorageDataWithExpiry();
    },

}
