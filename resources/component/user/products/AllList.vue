<template>
    <div>
        <div class="container">
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <div class="">
                    <a  class=" text-decoration-none fw-bold text-secondary pointer" style="font-size: 14px" @click="home()">Home</a> /
                    <a  class=" text-decoration-none fw-bold text-secondary pointer" style="font-size: 14px" @click="getAllDevices()">Devices</a>
                    <a  class=" text-decoration-none fw-bold text-secondary pointer" style="font-size: 14px" v-if="sameCategoryProductsOnClickValue != 'Devices'"> / {{ sameCategoryProductsOnClickValue }}</a>

                </div>
                <div class="text-muted" style="font-size: 12px">Showing all <span>{{ products.length }}</span> results</div>
            </div>
            <hr class="" style="color: grey;">
            <div class="row mt-4">
                <div class="col-3">
                    <div class="text-dark" style="font-size: 13px">Product categories</div>
                    <hr style="color: grey">
                    <a class="text-decoration-none text-muted pointer" @click="getAllDevices()" ><li class="d-flex justify-content-between align-items-center" style="font-size: 13px"><span>Devices</span><span>({{ totalProducts.length }})</span></li></a>
                    <ul style="font-size: 13px" class="list-unstyled mt-3 text-secondary" v-for="(sameCategoryProduct, index) in sameCategoryProductsWithCount" :key="index" >
                        <a class="text-decoration-none text-muted pointer" @click="sameCategoryProductsOnClick(sameCategoryProduct.category_name)"><li class="d-flex justify-content-between align-items-center"><span>{{ sameCategoryProduct.category_name }}</span><span>({{ sameCategoryProduct.total }})</span></li></a>

                    </ul>
                    <a class="text-decoration-none text-muted pointer" @click="getDiscountProducts()"><li class="d-flex justify-content-between align-items-center" style="font-size: 13px"><span>Discount Products</span><span>({{ discountProducts.length }})</span></li></a>
                </div>
                <div class="col-9">
                    <div class="row mb-3">
                        <div class="col-3">{{ sameCategoryProductsOnClickValue }}</div>
                        <select name="" style="font-size: 12px" @change="getProductsBySorting" class="col-2 offset-7 border border-1 border-secondary" id="">
                            <option value="" disabled>Sort</option>
                            <option value="latest">Sort by latest</option>
                            <option value="lowToHigh">Sort by price: low to high</option>
                            <option value="highToLow">Sort by price: high to low</option>
                        </select>
                    </div>
                    <div class="row pt-3" style="background-color: rgb(248, 248, 248);">
                        <div class=" text-center fw-bold fs-1" v-if="products == ''">There is no products in this category.</div>
                        <div class="col-3 mb-3 product" style="" v-for="(product, index) in products" :key="index" v-else @click="productDetailPage(product.id)">
                            <div class="text-center">
                                <img :src="'http://localhost:8000/storage/image/product/' + product.image" style="width: 130px;height: 130px;" alt="">
                            </div>
                            <div class="mt-2 fw-bold" style="font-size: 12px;">{{ product.name }}</div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <div class="mt-2 text-decoration-line-through" v-if="product.normal_price != null" style="font-size: 15px;">{{ product.normal_price }} kyats</div>
                                    <div class="mt-2 fw-bold"  style="color: blue;font-size: 15px;" >{{ product.price }} kyats</div>
                                </div>
                                <div class="">
                                    <button class="btn btn-sm buyBtn text-white" style="background-color: blue;"><i class="fa-solid fa-cart-shopping"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="../../../js/user/products/allList.js"></script>
