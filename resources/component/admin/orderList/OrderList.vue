<template>
    <div class="">
    <div class="">
        <div class="mt-4">
            <div class="">
                <h1 class="d-inline-block" style="margin-left: 11px">Order Lists</h1>
                <span class="fw-bold text-muted " style="margin-left:11px;font-size: 20px"><span id="container">{{ orderLists.length }}</span> order lists<span></span>
                    found</span>
            </div>
        </div>
    </div>
    <div class="row mt-4 py-auto">
        <div class="col-3 offset-8 my-auto">
            <div class="row form-group">
                    <input type="text" class="py-1 col-10" placeholder="Search by order code" name="searchKey" v-model="searchValue" v-on:keyup.enter="getOrderLists(1, searchValue)">
                    <button class="col-2 py-1 rounded-end bg-dark text-white" @click="getOrderLists(1, searchValue)"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
    </div>
    <div class="row" id="noData">
        <table class="products-table mt-5 ">
            <thead>
                <tr >
                    <th scope="col" class="col text-muted" >#</th>
                    <th scope="col" class="col text-muted" id="test">user name</th>
                    <th scope="col" class="col text-muted">product name</th>
                    <th scope="col" class="col text-muted">quantity</th>
                    <th scope="col" class="col text-muted">total price</th>
                    <th scope="col" class="col text-muted">order code</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(orderList, index1) in orderLists" :key="index1">
                    <th scope="row" >{{ orderList.id }}</th>
                    <td class="">{{ orderList.user_name }}</td>
                    <td class="" style="">{{ orderList.product_name }}</td>
                    <td>{{ orderList.quantity }}</td>
                    <td>{{ orderList.total_price }} ks</td>
                    <td>{{ orderList.order_code }}</td>
                </tr>
            </tbody>
        </table>
        <div v-if="pagination.last_page > 1" class="pagination" >
          <button :disabled="pagination.current_page === 1" @click="getOrderLists(pagination.current_page - 1, searchValue)">Prev</button>
          <button v-for="page in pages" :key="page" :class="{ active: pagination.current_page === page }" @click="getOrderLists(page, searchValue)">{{ page }}</button>
          <button :disabled="pagination.current_page === pagination.last_page" @click="getOrderLists(pagination.current_page + 1, searchValue)">Next</button>
        </div>
    </div>
    </div>
</template>

<script src="../../../js/admin/OrderList/orderList.js"></script>
