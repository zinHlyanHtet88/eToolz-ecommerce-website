import axios from "axios";

export default {
    name: 'ProductsGrid',
    data () {
        return {
            categories: [],
            product: {
                category: ''
            },
            sameCategoryProducts: [],
            sameCategoryProduct: [],
            productIdForDelete: '',
            searchValue: '',
            searchKeyAffect: '',
            updateStatus: '',
            pagination: {},
            currentPage: 1,
            searchDatas : ''
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
        search (page = 1, search = '') {
            axios.post('http://localhost:8000/api/products/searchProductByValue?page=' + page + '&search=' + search).then((response) => {
                this.sameCategoryProducts = response.data.products.data;
                this.pagination = response.data.products;
                this.currentPage = response.data.products.current_page;
                this.searchKeyAffect = response.data.status;
                this.product.category = 'all';
            })
        },
        addProduct () {
            window.location.href = 'http://localhost:8000/admin/products/addPage';
        },
        getCategories () {
            axios.get('http://localhost:8000/api/category/list').then((response) => {
                this.categories = response.data.category;
            })
        },
        categoryCheck (page = 1) {
            this.searchKeyAffect = '';
            this.searchValue = '';
            let formData = {
                categoryName: this.product.category
            }
            axios.post('http://localhost:8000/api/products/byCategoryName?page=' + page, formData).then((response) => {
                this.sameCategoryProducts = response.data.sameCategoryProducts.data;
                this.sameCategoryProduct = response.data.sameCategoryProduct;
                this.pagination = response.data.sameCategoryProducts;
                this.currentPage = response.data.sameCategoryProducts.current_page;

            })
        },
        deleteProduct (e) {
            let parent = e.target.parentElement.closest('tr');
            let id = parent.querySelector('#productId').innerHTML;
            let formData = {
                id: id
            };

            axios.post('http://localhost:8000/api/products/delete', formData).then((response) => {
                if (response.data.status == 'success') {
                    parent.remove();
                    window.location.reload();
                }
            })

        },
        editPage (id) {
            localStorage.setItem('productId',id);
            window.location.href = 'http://localhost:8000/admin/products/editPage';
        },
        reviewPage (id) {
            localStorage.setItem('productId', id);
            window.location.href = 'http://localhost:8000/admin/products/reviewPage';
        },
        getLocalStorageDataWithExpiry () {
            const now = new Date();
            let itemStr = localStorage.getItem('productUpdateStatus');
            if (itemStr) {
                let item = JSON.parse(itemStr);
                if (now.getTime() > item.expiry) {
                    this.updateStatus = '';
                    localStorage.removeItem('productUpdateStatus');
                } else {
                    this.updateStatus = item.value;
                }
            }
        },
        searchBox () {
            document.getElementById('floatingSelect').addEventListener('change', function () {
                if (document.getElementById('searchBox').style.display === 'none') {
                    document.getElementById('searchBox').style.display = 'block';
                }
            })
        }
    },
    mounted() {
        this.getCategories();
        this.getLocalStorageDataWithExpiry();
        this.searchBox();
    },
}
