<template>
    <div class="">
        <legend class="cartHeader" >Shopping Cart</legend>
        <div style="margin-bottom: 70px;" class="text-white bg-danger">{{ addOrderValidation }}</div>
        <div class="fs-1 fw-bold text-secondary text-center" v-if="carts == ''">
            There is no item in your cart.
        </div>
        <div class="row" style="margin: 0px 20px" v-else>
            <div class="col-9">
                <table class="">
                    <thead>
                        <tr class="text-uppercase cartListHeader ">
                            <td class="col"></td>
                            <td class="col"></td>
                            <td class="col">product</td>
                            <td class="col">price</td>
                            <td class="col">quantity</td>
                            <td class="col">subtotal</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(cart, index) in carts" :key="index" class="mt-4">
                            <input type="hidden" class="hiddenId" name="" :value="cart.id">
                            <td class="col"><button class="btn deleteBtn" @click="deleteCart" id="deleteBtn"><i class="fa-solid fa-xmark"></i></button></td>
                            <td class="col-2"><img style="width: 50%;" class=""
                                    :src="'http://localhost:8000/storage/image/product/' + cart.product_image"></td>
                            <td class="col">{{ cart.product_name }}</td>
                            <td style="color: blue" class=" fw-bold col"><span class="price">{{ cart.price }}</span> ks<span></span></td>
                            <td class="col">
                                <div class="quantity d-flex ">
                                    <button class="minusBtn" id="minusBtn" @click="minusBtn">-</button>
                                    <input type="text"  class="quantityInput"  v-model="cart.quantity">
                                    <button class="plusBtn" id="plusBtn" @click="plusBtn">+</button>
                                </div>
                            </td>
                            <td style="color: blue" class=" fw-bold col"><span class="total">{{ cart.sub_total }}</span><span> ks</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col">
                <div class="border border-1 p-3 rounded">
                    <h3 class="mb-4">Cart totals</h3>
                    <div class="mt-4 mb-2 d-flex justify-content-between align-items-center">
                        <div class="text-uppercase">subtotal</div>
                        <div class=""><span id="semiTotal">{{ semiTotal }}</span> ks</div>
                    </div>
                    <hr>
                    <div class="mb-2 d-flex justify-content-between align-items-center">
                        <div class="text-uppercase">delivery</div>
                        <div class=""><span id="deliveryFee">3000</span> ks</div>
                    </div>
                    <hr class="mt-5">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="text-uppercase">total</div>
                        <div class=""><span id="finalTotal">{{ semiTotal + deliveryFee }}</span> ks</div>
                    </div>
                    <div class="mb-3">
                        <button class="btn text-white w-100" style="background-color: blue;" @click="addToOrderList">Proceed to checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="../../../js/user/cart/list.js"></script>
