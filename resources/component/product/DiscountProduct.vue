<template>
    <div>
        <div class=" row" style="margin-top: 110px">
            <div class="col-6 offset-3 rounded shadow">
                <div class="mt-2 ms-3">
                        <button class="btn" onclick="history.back()"><i class="fa-solid fa-arrow-left text-muted" style="font-size: 30px"></i></button>

                    <h3 class="text-info text-center  fw-bold">Discount item detail</h3>
                    <hr style="margin-top: 35px;border: 1px solid #D3D3D3">
                </div>
                <div class="text-center">
                    <img  :src="'http://localhost:8000/storage/image/product/' + product.image" style="height: 15%;width:15%;">
                    <div class="mt-3">{{ product.name }}</div>
                </div>
                <div class="row mb-5 mt-5">
                    <div class="col-8 offset-2">
                            <div class="form-group mt-4">
                                <label for="formFileLg" class="form-label text-muted fw-bold" style="font-size: 23px">Normal Price</label>
                                <input type="number" name="" class="form-control" id="" v-model="product.normalPrice">
                            </div>
                            <div class="form-group mt-4">
                                <label for="formFileLg" class="form-label text-muted fw-bold" style="font-size: 23px">Discount Price</label>
                               <input type="number" name="" class="form-control" id="" v-model="discountPrice">
                            </div>
                            <div class="text-end mt-5 mb-3">
                                <button type="button" class="btn btn-dark"  style="font-size: 20px" @click="setDiscount()"><span>Save</span></button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="../../js/product/discountProduct.js"></script>
