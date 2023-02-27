<template>
    <div class="row">
        <div class="col-10 offset-1 shadow" style="margin-top: 5rem;" >
            <div class="mt-2">
                <button class="btn" onclick="history.back()"><i class="fa-solid fa-arrow-left text-muted" style="font-size: 30px"></i></button>
                <h4 class="text-center text-info">Edit Product</h4>
                <hr style="border: 1px solid #D3D3D3">
            </div>
            <div class="row">
                <div class=" col-2 offset-1 " style="margin-top: 3rem;">
                    <img v-bind:src="url" v-if="url" style="width: 100%;height: 120px;">
                    <img v-bind:src="'http://localhost:8000/storage/image/product/' + updatedProduct.image" v-else style="width: 100%;height: 120px;">
                    <div class="mt-2">
                        <label for="custom-file" class="btn btn-dark w-100">Edit Image</label>
                        <input type="file" id="custom-file" class="d-none" name="image" @change="pickFile">
                    </div>
                    <small class="fw-bold text-danger">{{ validationMessage.image }}</small>
                </div>
                <div class=" col-7 offset-1 mt-3">
                    <div class="form-floating mb-4">
                      <input type="text" class="form-control" id="floatingInput" v-model="updatedProduct.name" placeholder="name@example.com">
                      <label for="floatingInput">Edit Product Name</label>
                      <small class="fw-bold text-danger">{{ validationMessage.name }}</small>
                    </div>
                    <div class="form-floating mb-4">
                      <select class="form-select" id="floatingSelect" v-model="updatedProduct.category" aria-label="Floating label select example">
                        <option selected>Change Category</option>
                        <option :value="category.name" v-for="(category, index) in categories" :key="index">{{ category.name }}</option>
                      </select>
                      <label for="floatingSelect">Select Category</label>
                      <small class="fw-bold text-danger">{{ validationMessage.categoryName }}</small>
                    </div>
                    <div class="form-floating mb-4">
                      <input type="text" class="form-control" v-model="updatedProduct.price"  placeholder="">
                      <label for="floatingPassword">Edit Product Price</label>
                      <small class="fw-bold text-danger">{{ validationMessage.price }}</small>
                    </div>
                    <div class="form-floating mb-4" v-if="product.sim != null">
                      <input type="text" class="form-control" id="floatingPassword" v-model="updatedProduct.sim" placeholder="Password">
                      <label for="floatingPassword">Edit Product Sim</label>
                    </div>
                    <div class="form-floating mb-4" v-if="product.storage != null">
                      <input type="text" class="form-control" id="floatingInput" v-model="updatedProduct.storage" placeholder="name@example.com">
                      <label for="floatingInput">Edit Product Storage</label>
                    </div>
                    <div class="form-floating mb-4" v-if="product.processor != null">
                      <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" v-model="updatedProduct.processor">
                      <label for="floatingInput">Edit Product Processor</label>
                    </div>
                    <div class="form-floating mb-4" v-if="product.size != null">
                      <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" v-model="updatedProduct.size">
                      <label for="floatingInput">Edit Product Size</label>
                    </div>
                    <div class="form-floating mb-4" v-if="product.memory != null">
                      <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" v-model="updatedProduct.memory">
                      <label for="floatingInput">Edit Product Memory</label>
                    </div>
                    <div class="form-floating">
                      <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" v-model="updatedProduct.description"></textarea>
                      <label for="floatingTextarea2">Edit Product Description</label>
                      <small class="fw-bold text-danger"> {{ validationMessage.description }}</small>
                    </div>
                </div>
            </div>
            <div class="text-end mb-3 mt-4">
                <button class="btn btn-dark" style="margin-right: 4.5rem;" @click="updateProduct">Update</button>
            </div>
        </div>
    </div>
</template>

<script src="../../js/product/editProduct.js"></script>
