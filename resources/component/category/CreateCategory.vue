<template>
    <div class=" row" style="margin-top: 110px">
        <div class="col-6 offset-3 rounded shadow">
            <div class="mt-2 ms-3">
                    <button class="btn" onclick="history.back()"><i class="fa-solid fa-arrow-left text-muted" style="font-size: 30px"></i></button>
                <h3 class="text-info text-center  fw-bold">Create Category</h3>
                <hr style="margin-top: 35px;border: 1px solid #D3D3D3">
            </div>
            <div class="row mb-5 mt-5">
                <div class="col-8 offset-2">
                        <div class="form-group">
                            <label for="" class="form-label text-muted fw-bold" style="font-size: 23px">Category Name</label>
                            <input type="text" name="name" class="form-control" style="height: 48px"  v-model="category.name">
                            <small class="text-danger fw-bold">{{ validationMessage.name }}</small>
                        </div>
                        <div class="form-group mt-4">
                            <label for="formFileLg" class="form-label text-muted fw-bold" style="font-size: 23px">Category Description</label>
                            <textarea name="" id="" cols="30" rows="10" class="form-control" v-model="category.description"></textarea>
                            <small class="text-danger fw-bold">{{ validationMessage.description }}</small>
                        </div>
                        <div class="form-group mt-4">
                            <label for="formFileLg" class="form-label text-muted fw-bold" style="font-size: 23px">Category Image</label>
                            <input class="form-control form-control-lg" id="image" type="file" name="image" v-on:change="getImageInfo">
                            <small class="text-danger fw-bold">{{ validationMessage.image }}</small>
                        </div>
                        <div class="text-end mt-5">
                            <button type="submit" class="btn btn-dark" style="font-size: 20px" @click="createCategory"><i class="fa-solid fa-circle-plus me-2"></i><span>Create</span></button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="../../js/category/createCategory.js"></script>
