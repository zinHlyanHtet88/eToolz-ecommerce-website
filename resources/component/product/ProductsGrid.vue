<template>
    <div v-if="updateStatus == 'success'" class="alert alert-success alert-dismissible fade show row" role="alert">
      <strong>Update Success.</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="">
        <div class="mt-4 d-flex justify-content-between align-items-center">
            <div class="">
                <h1 class="d-inline-block" style="margin-left: 11px">Products</h1>
                <span class="fw-bold text-muted " style="margin-left:11px;font-size: 20px"><span id="container">{{ sameCategoryProducts.length }}</span> product<span v-if="sameCategoryProducts.length > 1">s</span>
                    found</span>
            </div>
            <div class="" style="margin-right: 20px">

                    <button class="btn btn-success py-2" style="font-size: 20px" @click="addProduct()">Add Product</button>
            </div>
        </div>
    </div>
    <div class="row mt-4 py-auto">
        <div class="col-3">
            <div class="form-floating">
              <select v-model="product.category" class="form-select" id="floatingSelect" aria-label="Floating label select example" @change="categoryCheck(1, searchValue)">
                <option value="" disabled>Select Category</option>
                <option value="all"  >All</option>
                <option v-for="(category, index) in categories" :key="index" :value="category.name">
                    {{ category.name }}
                </option>
                <option value="discountProducts">Discount products</option>
              </select>
              <label for="floatingSelect">Select Cateogory</label>
            </div>
        </div>
        <div class="col-3 offset-5 my-auto">
            <div class="row form-group " id="searchBox" style="display: none;">
                    <input type="text" class="py-1 col-10" placeholder="Search..." name="searchKey" v-model="searchValue" v-on:keyup.enter="search(1, searchValue)">
                    <button class="col-2 py-1 rounded-end bg-dark text-white" @click="search(1, searchValue)"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
    </div>
    <div class="row" id="noData">
        <table class="products-table mt-5 ">
            <thead>
                <tr v-if="product.category == 'all'">
                    <th scope="col" class="col text-muted" >#</th>
                    <th scope="col" class="col text-muted" id="test">Image</th>
                    <th scope="col" class="col text-muted">Name</th>
                    <th scope="col" class="col text-muted">Price</th>
                    <th scope="col" class="col text-muted">Sim</th>
                    <th scope="col" class="col text-muted">Storage</th>
                    <th scope="col" class="col text-muted">Processor</th>
                    <th scope="col" class="col text-muted">Size</th>
                    <th scope="col" class="col text-muted">Memory</th>
                    <th scope="col" class="col text-muted"></th>
                </tr>
                <tr v-else-if="searchKeyAffect == 'success'">
                    <th scope="col" class="col text-muted" >#</th>
                    <th scope="col" class="col text-muted" id="test">Image</th>
                    <th scope="col" class="col text-muted">Name</th>
                    <th scope="col" class="col text-muted">Price</th>
                    <th scope="col" class="col text-muted">Sim</th>
                    <th scope="col" class="col text-muted">Storage</th>
                    <th scope="col" class="col text-muted">Processor</th>
                    <th scope="col" class="col text-muted">Size</th>
                    <th scope="col" class="col text-muted">Memory</th>
                    <th scope="col" class="col text-muted"></th>
                </tr>
                <tr v-else-if="product.category == 'discountProducts'">
                    <th scope="col" class="col text-muted" >#</th>
                    <th scope="col" class="col text-muted" id="test">Image</th>
                    <th scope="col" class="col text-muted">Name</th>
                    <th scope="col" class="col text-muted">Price</th>
                    <th scope="col" class="col text-muted">normal price</th>
                    <th scope="col" class="col text-muted">Sim</th>
                    <th scope="col" class="col text-muted">Storage</th>
                    <th scope="col" class="col text-muted">Processor</th>
                    <th scope="col" class="col text-muted">Size</th>
                    <th scope="col" class="col text-muted">Memory</th>
                    <th scope="col" class="col text-muted"></th>
                </tr>
                <div v-else-if="product.category && sameCategoryProduct == null" style="font-size: 2rem;" class="text-dark  fw-bold text-center bg-danger mt-4">There is no data in this category list.</div>
                <tr v-else>
                    <th scope="col" class="col text-muted" >#</th>
                    <th scope="col" class="col text-muted" id="test">Image</th>
                    <th scope="col" class="col text-muted">Name</th>
                    <th scope="col" class="col text-muted">Price</th>
                    <th scope="col" class="col text-muted" v-if="sameCategoryProduct.sim != null">Sim</th>
                    <th scope="col" class="col text-muted" v-if="sameCategoryProduct.storage != null">Storage</th>
                    <th scope="col" class="col text-muted" v-if="sameCategoryProduct.processor != null">Processor</th>
                    <th scope="col" class="col text-muted" v-if="sameCategoryProduct.size != null">Size</th>
                    <th scope="col" class="col text-muted" v-if="sameCategoryProduct.memory != null">Memory</th>
                    <th scope="col" class="col text-muted"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product, index) in sameCategoryProducts" :key="index" id="productsRow" v-if="product.category == 'all'">
                    <th scope="row" id="productId">{{ product.id }}</th>
                    <td class="col-1"><img class="" v-bind:src="'http://localhost:8000/storage/image/product/' + product.image" style="width: 100%" alt="" srcset=""></td>
                    <td class="" style="">{{ product.name }}</td>
                    <td>{{ product.price }}</td>
                    <td v-if="product.sim != null">{{ product.sim }}</td>
                    <td v-else class="text-muted">null</td>
                    <td v-if="product.storage != null">{{ product.storage }}</td>
                    <td v-else class="text-muted">null</td>
                    <td v-if="product.processor != null">{{ product.processor }}</td>
                    <td v-else class="text-muted">null</td>
                    <td v-if="product.size != null">{{ product.size }}</td>
                    <td v-else class="text-muted">null</td>
                    <td v-if="product.memory != null">{{ product.memory }}</td>
                    <td v-else class="text-muted">null</td>
                    <td>
                            <button style="" class="btn btn-dark fw-bold me-2" @click="reviewPage(product.id)"><i class="fa-solid fa-eye"></i></button>
                            <button style="" class="btn btn-info fw-bold me-2" @click="editPage(product.id)"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button style="" class="btn btn-danger fw-bold" @click="deleteProduct" ><i class="fa-solid fa-trash" id="icon"></i></button>
                    </td>
                </tr>
                <tr v-for="(product, index3) in sameCategoryProducts" :key="index3" id="productsRow" v-else-if="product.category == 'discountProducts'">
                    <th scope="row" id="productId">{{ product.id }}</th>
                    <td class="col-1"><img class="" v-bind:src="'http://localhost:8000/storage/image/product/' + product.image" style="width: 100%" alt="" srcset=""></td>
                    <td class="" style="">{{ product.name }}</td>
                    <td>{{ product.price }}</td>
                    <td>{{ product.normal_price }}</td>
                    <td v-if="product.sim != null">{{ product.sim }}</td>
                    <td v-else class="text-muted">null</td>
                    <td v-if="product.storage != null">{{ product.storage }}</td>
                    <td v-else class="text-muted">null</td>
                    <td v-if="product.processor != null">{{ product.processor }}</td>
                    <td v-else class="text-muted">null</td>
                    <td v-if="product.size != null">{{ product.size }}</td>
                    <td v-else class="text-muted">null</td>
                    <td v-if="product.memory != null">{{ product.memory }}</td>
                    <td v-else class="text-muted">null</td>
                    <td>
                            <button  class="btn btn-dark fw-bold me-2" @click="reviewPage(product.id)"><i class="fa-solid fa-eye"></i></button>
                            <button class="btn btn-info fw-bold me-2" @click="editPage(product.id)"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="btn btn-danger fw-bold" @click="deleteProduct" ><i class="fa-solid fa-trash" id="icon"></i></button>
                    </td>
                </tr>
                <tr v-for="(product, index1) in sameCategoryProducts" :key="index1" id="productsRow" v-else-if="searchKeyAffect == 'success'">
                    <th scope="row" id="productId">{{ product.id }}</th>
                    <td class="col-1"><img class="" v-bind:src="'http://localhost:8000/storage/image/product/' + product.image" style="width: 100%" alt="" srcset=""></td>
                    <td class="" style="">{{ product.name }}</td>
                    <td>{{ product.price }}</td>
                    <td v-if="product.sim != null">{{ product.sim }}</td>
                    <td v-else class="text-muted">null</td>
                    <td v-if="product.storage != null">{{ product.storage }}</td>
                    <td v-else class="text-muted">null</td>
                    <td v-if="product.processor != null">{{ product.processor }}</td>
                    <td v-else class="text-muted">null</td>
                    <td v-if="product.size != null">{{ product.size }}</td>
                    <td v-else class="text-muted">null</td>
                    <td v-if="product.memory != null">{{ product.memory }}</td>
                    <td v-else class="text-muted">null</td>
                    <td>
                        <button class="btn btn-dark fw-bold me-2" @click="reviewPage(product.id)"><i class="fa-solid fa-eye"></i></button>
                            <button class="btn btn-info fw-bold me-2" @click="editPage(product.id)"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="btn btn-danger fw-bold" @click="deleteProduct" ><i class="fa-solid fa-trash" id="icon"></i></button>
                    </td>
                </tr>
                <div v-else-if="product.category && sameCategoryProduct == null"></div>
                <tr v-for="(product, lara) in sameCategoryProducts" :key="lara" id="productsRow" v-else>
                    <th scope="row" id="productId">{{ product.id }}</th>
                    <td class="col-2"><img class="" v-bind:src="'http://localhost:8000/storage/image/product/' + product.image" style="width: 50%" alt="" srcset=""></td>
                    <td class="" style="">{{ product.name }}</td>
                    <td>{{ product.price }}</td>
                    <td v-if="product.sim != null">{{ product.sim }}</td>
                    <td v-if="product.storage != null">{{ product.storage }}</td>
                    <td v-if="product.processor != null">{{ product.processor }}</td>
                    <td v-if="product.size != null">{{ product.size }}</td>
                    <td v-if="product.memory != null">{{ product.memory }}</td>
                    <td>
                        <button class="btn btn-dark fw-bold me-2" @click="reviewPage(product.id)"><i class="fa-solid fa-eye"></i></button>
                            <button class="btn btn-info fw-bold me-2" @click="editPage(product.id)"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="btn btn-danger fw-bold" @click="deleteProduct" ><i class="fa-solid fa-trash" id="icon"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-if="pagination.last_page > 1" class="pagination" >
          <button :disabled="pagination.current_page === 1" @click="categoryCheck(pagination.current_page - 1, searchValue)">Prev</button>
          <button v-for="page in pages" :key="page" :class="{ active: pagination.current_page === page }" @click="categoryCheck(page, searchValue)">{{ page }}</button>
          <button :disabled="pagination.current_page === pagination.last_page" @click="categoryCheck(pagination.current_page + 1, searchValue)">Next</button>
        </div>
    </div>

</template>

<script src="../../js/product/productsGrid.js"></script>


