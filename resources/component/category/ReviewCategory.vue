<template>
    <div class="row mt-5">
        <div class="col-8 offset-2 shadow">
            <button class="btn" onclick="history.back()"><i class="fa-solid fa-arrow-left text-muted" style="font-size: 30px"></i></button>
            <div class="text-center">
                <legend class="fw-bold text-info">Category Details</legend>
            </div>
            <hr style="border: 1px solid #D3D3D3">
            <div class="offset-2 mb-5">
                <h4>{{ category.name }}</h4>
            </div>
            <div class="row mb-4">
                <div class="col-3 offset-1">
                    <img :src="'http://localhost:8000/storage/image/category/' + category.image" style="width:100%">
                </div>
                <div class="col-6 offset-1">
                   <div class="mt-4 mb-4">
                    <p class="fw-bold text-muted">{{ category.description }}</p>
                   </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="../../js/category/reviewCategory.js"></script>
