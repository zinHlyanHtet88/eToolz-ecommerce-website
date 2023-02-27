<template>
    <div class="">
        <legend class="cartHeader" style="margin-bottom: 70px;">Orders</legend>
        <div class="container">
            <div class="text-center fs-1 fw-bold text-secondary" v-if="orders == ''" >
                There is no order.
            </div>
            <div class="" v-for="(order, index) in orders" :key="index" v-else>
                <div class="mb-5 border border-1 pt-3 pb-4 ps-4 pe-4 order" >
                    <div class="">
                        <div class="d-flex justify-content-between mb-3" v-if="order.status == 0">
                            <div class="">
                                Your orders are pending.
                            </div>
                            <div class="btn btn-secondary">pending</div>
                        </div>
                        <div  v-if="order.status == 1">
                            <div class="mb-2">
                                <button class="btn" @click="deleteOrder"><i class="fa-solid fa-xmark"></i></button>
                            </div>
                         <div class="d-flex justify-content-between mb-3">
                            <div class="">
                                Your orders have been delivered successfully.
                            </div>
                            <div class="btn btn-success">complete</div>
                         </div>
                        </div>
                        <div  v-if="order.status == 2">
                            <div class="mb-2">
                                <button class="btn" @click="deleteOrder"><i class="fa-solid fa-xmark"></i></button>
                            </div>
                         <div class="d-flex justify-content-between mb-3">
                            <div class="">
                                Your orders have been declined.
                            </div>
                            <div class="btn btn-danger">rejected</div>
                         </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="row">
                            <div class="col-9">
                                <table>
                                    <thead>
                                        <tr class="text-uppercase cartListHeader ">
                                            <td class="col"></td>
                                            <td class="col">product</td>
                                            <td class="col">price</td>
                                            <td class="col">quantity</td>
                                            <td class="col">subtotal</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(orderList, index1) in orderLists" :key="index1">
                                            <input type="hidden" name="" class="orderCode" :value="order.order_code" id="" v-if="orderList.order_code == order.order_code">
                                            <td v-if="orderList.order_code == order.order_code" class="col-2"><img
                                                    style="width: 50%"
                                                    :src="'http://localhost:8000/storage/image/product/' + orderList.product_image">
                                            </td>
                                            <td v-if="orderList.order_code == order.order_code">{{
                                                orderList.product_name
                                            }}</td>
                                            <td v-if="orderList.order_code == order.order_code">{{
                                                orderList.product_price
                                            }}</td>
                                            <td v-if="orderList.order_code == order.order_code">{{
                                                orderList.quantity
                                            }}</td>
                                            <td v-if="orderList.order_code == order.order_code">{{
                                                orderList.total_price
                                            }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col">
                                <div class="border border-1 p-3 rounded">
                                    <h3 class="mb-4">Cart totals</h3>
                                    <div class="mt-4 mb-2 d-flex justify-content-between align-items-center">
                                        <div class="text-uppercase">subtotal</div>
                                        <div class=""><span id="semiTotal">{{ order.total_price -3000 }}</span> ks</div>
                                    </div>
                                    <hr>
                                    <div class="mb-2 d-flex justify-content-between align-items-center">
                                        <div class="text-uppercase">delivery</div>
                                        <div class=""><span id="deliveryFee">3000</span> ks</div>
                                    </div>
                                    <hr class="mt-5">
                                    <div class="mb-4 d-flex justify-content-between align-items-center">
                                        <div class="text-uppercase">total</div>
                                        <div class=""><span id="finalTotal">{{ order.total_price }}</span> ks</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="../../../js/user/notification/noti.js"></script>
