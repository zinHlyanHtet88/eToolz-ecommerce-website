<template>
        <div class="">
    <div class="">
        <div class="mt-4">
            <div class="">
                <h1 class="d-inline-block" style="margin-left: 11px">Orders</h1>
                <span class="fw-bold text-muted " style="margin-left:11px;font-size: 20px"><span id="container">{{ orders.length }}</span> orders<span></span>
                    found</span>
            </div>
        </div>
    </div>
    <div class="row mt-4 py-auto">
        <div class="col-3 offset-8 my-auto">
            <div class="row form-group">
                    <input type="text" class="py-1 col-10" placeholder="Search by order code" name="searchKey" v-model="searchValue" v-on:keyup.enter="getOrders(1, searchValue)">
                    <button class="col-2 py-1 rounded-end bg-dark text-white"  @click="getOrders(1, searchValue)"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
    </div>
    <div class="row" id="noData">
        <table class="products-table mt-5 ">
            <thead>
                <tr >
                    <th scope="col" class="col text-muted" >#</th>
                    <th scope="col" class="col text-muted" id="test">user name</th>
                    <th scope="col" class="col text-muted">order code</th>
                    <th scope="col" class="col text-muted">total price</th>
                    <th scope="col" class="col text-muted">status</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(order, index1) in orders" :key="index1">
                    <th scope="row" class="orderId">{{ order.id }}</th>
                    <td class="" >{{ order.user_name }}</td>
                    <td class="" style="">{{ order.order_code }}</td>
                    <td>{{ order.total_price }} ks</td>
                    <td class="">
                        <select name="" class="status" id="" style="padding: 3px 5px;border: 1px solid #D3D3D3;border-radius: 4px;font-size: 14px;" @change="changeStatus">
                            <option value="0" v-if="order.status == 0" selected>pending</option>
                            <option value="0" v-else>pending</option>
                            <option value="1" v-if="order.status == 1" selected>complete</option>
                            <option value="1" v-else>complete</option>
                            <option value="2" v-if="order.status == 2" selected>reject</option>
                            <option value="2" v-else>reject</option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-if="pagination.last_page > 1" class="pagination" >
          <button :disabled="pagination.current_page === 1" @click="getOrders(pagination.current_page - 1, searchValue)">Prev</button>
          <button v-for="page in pages" :key="page" :class="{ active: pagination.current_page === page }" @click="getOrders(page, searchValue)">{{ page }}</button>
          <button :disabled="pagination.current_page === pagination.last_page" @click="getOrders(pagination.current_page + 1, searchValue)">Next</button>
        </div>
    </div>
    </div>
</template>

<script src="../../../js/admin/Order/order.js"></script>
