import './bootstrap';




import ProductsGrid from '../component/product/ProductsGrid.vue'
import AddProduct from '../component/product/AddProduct.vue'
import EditProduct from '../component/product/EditProduct.vue'
import CategoriesGrid from '../component/category/CategoriesGrid.vue'
import CreateCategory from '../component/category/CreateCategory.vue'
import EditCategory from '../component/category/EditCategory.vue';
import ReviewProduct from '../component/product/ReviewProduct.vue';
import ReviewCategory from '../component/category/ReviewCategory.vue';
import UsersList from '../component/admin/List.vue';
import EditProfile from '../component/admin/profile/Edit.vue';
import ProfilePage from '../component/admin/profile/ProfilePage.vue';
import UserHome from '../component/user/Home.vue';
import DiscountProduct from '../component/product/DiscountProduct.vue';
import AllList from '../component/user/products/AllList.vue';
import ProductDetail from '../component/user/products/Detail.vue';
import CartList from '../component/user/cart/CartList.vue'
import OrderList from '../component/admin/orderList/OrderList.vue'
import Order from '../component/admin/order/Order.vue'
import NotiOrder from '../component/user/notification/NotiOrder.vue'
import Message from '../component/user/contact/Message.vue'
import AdminMessage from '../component/admin/contact/Message.vue'
import AdminMessageReply from '../component/admin/contact/Reply.vue'
import NotiMessage from '../component/user/notification/NotiMessage.vue';
import EditUserProfile from '../component/user/profile/Edit.vue';



import { createApp } from 'vue/dist/vue.esm-bundler';
const app = createApp({});
app.component('ion-products-grid', ProductsGrid)
app.component('ion-add-product', AddProduct)
app.component('ion-edit-product', EditProduct)
app.component('ion-categories-grid', CategoriesGrid)
app.component('ion-create-category', CreateCategory)
app.component('ion-edit-category', EditCategory)
app.component('ion-review-product', ReviewProduct)
app.component('ion-review-category', ReviewCategory)
app.component('ion-users-list', UsersList)
app.component('ion-edit-profile', EditProfile)
app.component('ion-profile-page', ProfilePage)
app.component('ion-user-home', UserHome)
app.component('ion-discount-product', DiscountProduct)
app.component('ion-all-list', AllList)
app.component('ion-product-detail', ProductDetail)
app.component('ion-cart', CartList)
app.component('ion-order-list', OrderList)
app.component('ion-order', Order)
app.component('ion-noti-order', NotiOrder)
app.component('ion-message', Message)
app.component('ion-admin-message', AdminMessage)
app.component('ion-admin-message-reply', AdminMessageReply)
app.component('ion-noti-message', NotiMessage)
app.component('ion-edit-user-profile', EditUserProfile)


app.mount('#app');




