import axios from "axios"
import moment from "moment/moment";

export default {
    name: 'Detail',
    props: ['user'],
    data () {
        return {
            product: [],
            quantityInput: 1,
            addCartStatus: false,
            userReview: {
                rate: '',
                reviewTitle: '',
                reviews: '',
                image: []
            },
            ratingCode: 'RX' + (Math.floor(Math.random() * 99999) + 10000),
            loggedInUser: [],
            todayDate: '',
            ratings: [],
            ratingImages: [],
            selectedImages: [],
            replies: '',
            adminRepliedDatas: [],
            ratedDatas: {
                fiveStarsRating: '',
                fourStarsRating: '',
                threeStarsRating: '',
                twoStarsRating: '',
                oneStarsRating: ''
            },

        }
    },
    methods: {
        formatDate (value) {
            if (value) {
                return moment(String(value)).format('MM/DD/YYYY')
            }
        },
        getUser () {
            let formData = {
                userId: this.user
            };
            axios.post('http://localhost:8000/api/users/user', formData).then((response) => {
                this.loggedInUser = response.data.user;
            })
        },
        setUpTodayDate () {
            let today = new Date();
            let dd = String(today.getDate()).padStart(2, '0');
            let mm = String(today.getMonth() + 1).padStart(2, '0');
            let yyyy = today.getFullYear();
            this.todayDate = mm+ '/'+ dd+ '/'+ yyyy;
        },
        getProduct () {
            let formData = {
                id : localStorage.getItem('productId')
            }
            axios.post('http://localhost:8000/api/products/productWithId', formData).then((response) => {
                this.product = response.data.product;
            })
        },
        minusBtn () {
            this.quantityInput--;
            if (this.quantityInput < 0) {
                this.quantityInput = 0;
            }
        },
        plusBtn () {
            this.quantityInput++;

        },
        home () {
            window.location.href = 'http://localhost:8000/dashboard';
        },
        devices () {
            window.location.href = 'http://localhost:8000/user/products/allList';
            localStorage.setItem('categoryName', 'Devices');
        },
        backWithCategoryName (categoryName) {
            window.location.href = 'http://localhost:8000/user/products/allList';
            localStorage.setItem('categoryName', categoryName);
        },
        addCart () {
            let formData = {
                userId: this.user,
                productId: this.product.id,
                quantity: this.quantityInput,
                price: this.product.price,
                subTotal: this.product.price * this.quantityInput
            };
            axios.post('http://localhost:8000/api/cart/add', formData).then((response) => {
                if (response.data.status == 'success') {
                    this.addCartStatus = true;
                }
            })
        },
        rateOneStar () {
            this.userReview.rate = 1;
        },
        rateTwoStars () {
            this.userReview.rate = 2;
        },
        rateThreeStars () {
            this.userReview.rate = 3;
        },
        rateFourStars () {
            this.userReview.rate = 4;
        },
        rateFiveStars () {
            this.userReview.rate = 5;
        },
        rateStars () {
            document.querySelector('#rating').addEventListener('click', function (e) {
                let action = 'add';
                for (const span of this.children) {
                    span.classList[action]('active');
                    if (span === e.target) {
                        action = 'remove';
                    }
                }
            })
        },
        getImgInfo (e) {
            let file = e.target.files[0];


            this.userReview.image = file;
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                }
            };
            let formData = {
                image: this.userReview.image,
                ratingCode: this.ratingCode,
            };
            axios.post('http://localhost:8000/api/rating/setImages', formData, config).then((response) => {
                this.selectedImages = response.data.ratingImages;
            })
        },
        review () {
            let formData = {
                rating: this.userReview.rate,
                reviewTitle: this.userReview.reviewTitle,
                review: this.userReview.reviews,
                userId: this.loggedInUser.id,
                productId: this.product.id,
                ratingCode: this.ratingCode
            };
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                }
            };
            axios.post('http://localhost:8000/api/rating/create', formData, config).then((response) => {
                if (response.data.status == 'success') {
                    window.location.reload();
                }
            })
        },
        getReviews () {
            axios.get('http://localhost:8000/api/rating/list').then((response) => {
                this.ratings = response.data.ratings;
                this.ratingImages = response.data.ratingImages;
            })
        },
        unselectImg (e) {
            let parent = e.target.parentElement.closest('.selectedImgParent');
            let imgId = parent.querySelector('.imgId').value;
            let formData = {
                imgId: imgId
            }
            axios.post('http://localhost:8000/api/rating/deleteSelectedImg', formData).then((response) => {
                if (response.data.status == 'success') {
                    parent.remove();
                }
            })
        },
        reply (ratingCode) {
            let formData = {
                ratingCode : ratingCode,
                reply: this.replies
            };
            axios.post('http://localhost:8000/api/rating/adminReply', formData).then((response) => {
                window.location.reload();
            });
        },
        getAdminRepliedData () {
            axios.get('http://localhost:8000/api/rating/data').then((response) => {
                this.adminRepliedDatas = response.data.adminReplies;
                this.ratedDatas.fiveStarsRating = response.data.fiveStarsRating.length;
                this.ratedDatas.fourStarsRating = response.data.fourStarsRating.length;
                this.ratedDatas.threeStarsRating = response.data.threeStarsRating.length;
                this.ratedDatas.twoStarsRating = response.data.twoStarsRating.length;
                this.ratedDatas.oneStarsRating = response.data.oneStarsRating.length;
            })
        },

    },
    computed: {
        overAllRating() {
            return (5 * this.ratedDatas.fiveStarsRating + 4 * this.ratedDatas.fourStarsRating + 3 * this.ratedDatas.threeStarsRating + 2 * this.ratedDatas.twoStarsRating + 1 * this.ratedDatas.oneStarsRating) / (this.ratedDatas.fiveStarsRating + this.ratedDatas.fourStarsRating + this.ratedDatas.threeStarsRating + this.ratedDatas.twoStarsRating + this.ratedDatas.oneStarsRating)
        },
        fiveStarsRated () {
            return Math.floor(this.ratedDatas.fiveStarsRating / this.ratings.length * 100)
        },
        fourStarsRated () {
            return  Math.floor(this.ratedDatas.fourStarsRating / this.ratings.length * 100)
        },
        threeStarsRated () {
            return  Math.floor(this.ratedDatas.threeStarsRating / this.ratings.length * 100)
        },
        twoStarsRated () {
            return  Math.floor(this.ratedDatas.twoStarsRating / this.ratings.length * 100)
        },
        oneStarRated () {
            return  Math.floor(this.ratedDatas.oneStarsRating / this.ratings.length * 100)
        }
    },
    mounted () {
        this.getProduct();
        this.rateStars();
        this.getUser();
        this.setUpTodayDate();
        this.getReviews();
        this.getAdminRepliedData();

    }
}
