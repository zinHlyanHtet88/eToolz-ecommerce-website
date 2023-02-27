<template>
    <div>
        <div v-if="updateStatus == 'success'" class="alert alert-success alert-dismissible fade show row" role="alert">
          <strong>Update Success.</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="">
            <div class="mt-4 d-flex justify-content-between align-items-center">
                <div class="">
                    <h1 class="d-inline-block" style="margin-left: 11px">Category</h1>
                    <span class="fw-bold text-muted " style="margin-left:11px;font-size: 20px"><span>{{ categories.length }}</span> categor<span v-if="categories.length > 1">ies</span><span v-else>y</span>
                        found</span>
                </div>
                <div class="" style="margin-right: 20px">
                        <button class="btn btn-info py-2 me-2 fw-bold" style="font-size: 20px" @click="userDashboard">User's dashboard</button>
                        <button class="btn btn-success py-2" style="font-size: 20px" @click="createCategory">Create Category</button>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-3 offset-8">
                <div class="row form-group">
                        <input type="text" class="py-1 col-10" placeholder="Search..." name="searchKey" v-model="searchValue" v-on:keyup.enter="getCategories(1, searchValue)">
                        <button class="col-2 py-1 rounded-end bg-dark text-white" @click="getCategories(1, searchValue)"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
        </div>
        <div class="row">
            <table class="table-list mt-5 col-10 offset-1">
                <thead>
                    <tr>
                        <th scope="col" class="col-2">#</th>
                        <th scope="col" class="col-3">Image</th>
                        <th scope="col" class="col-3">Category_name</th>
                        <th scope="col" class="col-3"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(category, index) in categories" :key="index">
                        <th scope="row" id="categoryId">{{ category.id }}</th>
                        <td class=""><img v-bind:src="'http://localhost:8000/storage/image/category/' + category.image" style="width: 30%"
                                alt="" srcset=""></td>
                        <td class="" style="font-size: 1.5rem">{{ category.name }}</td>
                        <td>
                            <button class="btn btn-dark fw-bold me-2" @click="reviewCategory(category.id)"><i class="fa-solid fa-eye"></i></button>
                                <button class="btn btn-info me-2" @click="editCategory"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn btn-danger" @click="deleteCategory"><i class="fa-solid fa-trash" id="icon"></i></button>
                        </td>
                        <input type="hidden" name="" id="imgName" :value="category.image">
                    </tr>
                </tbody>
            </table>
            <div v-if="pagination.last_page > 1" class="pagination">
              <button :disabled="pagination.current_page === 1" @click="getCategories(pagination.current_page - 1, searchValue)">Prev</button>
              <button v-for="page in pages" :key="page" :class="{ active: pagination.current_page === page }" @click="getCategories(page, searchValue)">{{ page }}</button>
              <button :disabled="pagination.current_page === pagination.last_page" @click="getCategories(pagination.current_page + 1, searchValue)">Next</button>
            </div>
        </div>
    </div>
</template>

<script src="../../js/category/categoriesGrid.js"></script>
