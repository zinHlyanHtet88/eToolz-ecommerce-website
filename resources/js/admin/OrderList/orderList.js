import axios from "axios"

export default {
    name: 'OrderList',
    data () {
        return {
            users : [],
            orderLists: [],
            searchValue: '',
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
        getOrderLists (page = 1, search = '') {
            axios.post('http://localhost:8000/api/orderList/list?page=' + page + '&search=' + search).then((response) => {
                this.orderLists = response.data.orderLists.data;
                this.pagination = response.data.orderLists;
                this.currentPage = response.data.orderLists.current_page;
            });
        }
    },
    mounted () {
        this.getOrderLists();

    }
}
