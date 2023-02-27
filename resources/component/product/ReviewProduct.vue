<template>
    <div class="row mt-5">
        <div class="col-8 offset-2 shadow">
            <button class="btn" onclick="history.back()"><i class="fa-solid fa-arrow-left text-muted" style="font-size: 30px"></i></button>
            <div class="text-center">
                <legend class="fw-bold text-info">Product Details</legend>
            </div>
            <hr style="border: 1px solid #D3D3D3">
            <div class="offset-1 mb-5">
                <h4>{{ product.name }}</h4>
            </div>
            <div class="row">
                <div class="col-3 offset-1">
                    <img :src="'http://localhost:8000/storage/image/product/' + product.image" style="width:100%">
                </div>
                <div class="col-6 offset-1">
                   <div class="">
                    <div class="d-inline-block bg-danger text-white fw-bold px-1 py-1 border rounded" v-if="product.price != null">{{ product.price }} Kyats</div>
                    <div class="d-inline-block bg-danger text-white fw-bold px-1 py-1 border rounded" v-if="product.sim != null">{{ product.sim }}</div>
                    <div class="d-inline-block bg-danger text-white fw-bold px-1 py-1 border rounded" v-if="product.storage != null">{{ product.storage }}</div>
                    <div class="d-inline-block bg-danger text-white fw-bold px-1 py-1 border rounded" v-if="product.processor != null">{{ product.processor }}</div>
                    <div class="d-inline-block bg-danger text-white fw-bold px-1 py-1 border rounded" v-if="product.size != null">{{ product.size }}</div>
                    <div class="d-inline-block bg-danger text-white fw-bold px-1 py-1 border rounded" v-if="product.memory != null">{{ product.memory }}</div>
                   </div>
                   <div class="mt-4 mb-4">
                    <p class="fw-bold text-muted">{{ product.description }}</p>
                   </div>
                </div>
            </div>
            <div class="mb-4 text-end">
                <button class="btn text-white bg-danger" @click="discountItemAddPage(product.id)">Add to discount items</button>
            </div>
        </div>
    </div>
</template>

<script src="../../js/product/reviewProduct.js"></script>


