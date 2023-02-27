<template>
    <div class=" row" style="margin-top: 110px">
        <div class="col-6 offset-3 rounded shadow">
            <div class="mt-2 ms-3">
                    <button class="btn" onclick="history.back()"><i class="fa-solid fa-arrow-left text-muted" style="font-size: 30px"></i></button>

                <h3 class="text-info text-center  fw-bold">Edit Category</h3>
                <hr style="margin-top: 35px;border: 1px solid #D3D3D3">
            </div>
            <div class="text-center">
                <img v-bind:src="url" v-if="url" alt="" style="height: 15%;width:15%;">
                <img v-else v-bind:src="'http://localhost:8000/storage/image/category/' + category.image" alt="" style="height: 15%;width:15%;">
            </div>
            <div class="row mb-5 mt-5">
                <div class="col-8 offset-2">
                        <div class="form-group">
                            <label for="" class="form-label text-muted fw-bold" style="font-size: 23px">Edit Category Name</label>
                            <input type="text" name="name" class="form-control" style="height: 48px" v-model="updatedCategory.name" id="name">
                            <small class="text-danger fw-bold">{{ validationMessage.name }}</small>
                        </div>
                        <input type="hidden" id="categoryId" name="id" :value="category.id">
                        <div class="form-group mt-4">
                            <label for="formFileLg" class="form-label text-muted fw-bold" style="font-size: 23px">Category Description</label>
                            <textarea name="" id="" cols="30" rows="10" class="form-control" v-model="updatedCategory.description"></textarea>
                            <small class="text-danger fw-bold">{{ validationMessage.description }}</small>
                        </div>
                        <div class="form-group mt-4">
                            <label for="formFileLg" class="form-label text-muted fw-bold" style="font-size: 23px">Edit Category Image</label>
                            <input class="form-control form-control-lg" id="image" @change="pickFile" type="file" name="image" value="">
                            <small class="fw-bold text-danger">{{ validationMessage.image }}</small>
                        </div>
                        <div class="text-end mt-5 mb-3">
                            <button type="button" class="btn btn-dark" @click="updateCategory" style="font-size: 20px" ><i class="fa-solid fa-circle-right me-2"></i><span>Update</span></button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="../../js/category/editCategory.js"></script>

