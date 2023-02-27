import axios from "axios";

export default {
    name: 'Order',
    data () {
        return {
            users : [],
            userId: '',
            searchValue: '',
            orders: [],
            status: '',
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
        getOrders (page = 1, search = '') {
            axios.post('http://localhost:8000/api/order/list?page=' + page + '&search=' + search).then((response) => {
                this.orders = response.data.orders.data;
                this.pagination = response.data.orders;
                this.currentPage = response.data.orders.current_page;
            })
        },
        changeStatus (e) {
            let button = e.target;
            let parent = button.parentElement.closest(  'tr');
            let value = parent.querySelector('.status').value;
            let orderId = parent.querySelector('.orderId').innerHTML;
            let formData = {
                orderId: orderId,
                status: value
            };
            axios.post('http://localhost:8000/api/order/updateStatus', formData).then((response) => {
                console.log(response.data.status);
            });
        }
    },
    mounted () {
        this.getOrders();
    }
}
