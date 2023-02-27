<template>
  <div>
    <div class=" row" style="margin-top: 90px">
      <div class="col-8 offset-2 rounded shadow">
        <div class="mt-2 ms-3">
          <button class="btn" onclick="history.back()"><i class="fa-solid fa-arrow-left text-muted"
              style="font-size: 30px"></i></button>
          <h3 class="text-info text-center  fw-bold">Add Product</h3>
          <hr style="margin-top: 35px;border: 1px solid #D3D3D3">
        </div>
        <div class="row mb-5 mt-5">
          <div class="col-10 offset-1">
            <!-- <form @submit="createPost" enctype="multipart/form-data"> -->
              <div class="row">
                <div class="form-floating col">
                  <input type="text" v-model="product.name" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                  <label for="floatingInput" class="ms-1">Product Name</label>
                  <small class="text-danger" ><strong>{{ validation.productName }}</strong></small>
                </div>
                <div class="form-floating col">
                  <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                    v-model="product.categoryName">
                    <option :value="{ name: category.name }" v-for="(category, index) in categories" :key="index">{{
                        category.name
                    }}</option>
                  </select>
                  <label for="floatingSelect">Category</label>
                  <small class="text-danger" ><strong>{{ validation.category }}</strong></small>
                </div>
              </div>
              <div class="row mt-4">
                <div class="form-floating col">
                  <input type="text" v-model="product.memory" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                  <label for="floatingInput" class="ms-1">Memory</label>
                </div>
                <div class="form-floating col">
                  <input type="text" v-model="product.processor" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                  <label for="floatingInput" class="ms-1">Processor</label>
                </div>
              </div>
              <div class="row mt-4">
                <div class="form-floating col">
                  <input type="text" v-model="product.sim" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                  <label for="floatingInput" class="ms-1">Sim</label>
                </div>
                <div class="form-floating col">
                  <input type="text" v-model="product.size" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                  <label for="floatingInput" class="ms-1">Size</label>
                </div>
              </div>
              <div class="row mt-4">
                <div class="form-floating col">
                  <input type="text" v-model="product.storage" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                  <label for="floatingInput" class="ms-1">Storage</label>
                </div>
                <div class="form-floating col">
                  <input type="text" v-model="product.price" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                  <label for="floatingInput" class="ms-1">Price</label>
                  <small class="text-danger" ><strong>{{ validation.price }}</strong></small>
                </div>
              </div>
              <div class="row mt-3">
                <label for="" class="form-label">Image</label>
                <input type="file" v-on:change="fileChange" class="form-control" id="image">
                <small class="text-danger" ><strong>{{ validation.image }}</strong></small>
              </div>
              <div class="form-floating mt-4">
                <textarea class="form-control" placeholder="" id="floatingTextarea2" style="height: 100px"
                  v-model="product.description"></textarea>
                <label for="floatingTextarea2">Description</label>
                <small class="text-danger" ><strong>{{ validation.description }}</strong></small>
              </div>
              <div class="text-end mt-5">
                <button class="btn btn-dark" style="font-size: 20px" @click="createPost"><i
                    class="fa-solid fa-circle-plus me-2"></i><span>Add</span></button>
              </div>
            <!-- </form> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script src="../../js/product/addProduct.js"></script>


