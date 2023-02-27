<template>
    <div class="">
        <div v-if="updateStatus == 'success'" class="alert alert-success alert-dismissible fade show row" role="alert">
          <strong>Update Success.</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="text-end">
            <button class="btn btn-dark me-4 mt-4" @click="editPage">Edit Profile</button>
        </div>
        <div class="row" style="margin-top: 100px">
            <div class="col-6 offset-3 rounded pt-1" style="position: relative;">
                <img src="../../../../public/image/profile_background.jpg" style="width: 100%;position: absolute;height: 100%;z-index: -1;" alt="" class="rounded">
                <div class="row py-5">
                    <div class="col-3 offset-1">
                        <img :src="'http://localhost:8000/storage/image/profileImages/' + mainUser.image" v-if="mainUser.image != null" style="width: 145px;height: 145px" alt="" srcset="" class="rounded-circle">
                        <img src="../../../../public/image/default_male.webp" v-else-if="mainUser.image == null && mainUser.gender == 'male'" style="width: 145px;height: 145px" alt="" srcset="" class="rounded-circle">
                        <img src="../../../../public/image/default_female.jpg" v-else-if="mainUser.image == null && mainUser.gender == 'female'" alt=""  style="width: 145px;height: 145px" srcset="" class="rounded-circle">
                    </div>
                    <div class="col-7 mt-1">
                        <div class="col-10 offset-4" style="">
                            <div class="fw-bold" style="color: #330000"><i class="fa-solid fa-user me-3 mb-1" style="font-size: 1.1rem;"></i><span style="font-size: 1.1rem;">{{ mainUser.name }}</span></div>
                            <div class="fw-bold" style="color: #330000"><i class="fa-solid fa-at me-3 mb-1" style="font-size: 1.1rem;"></i><span style="font-size: 1.1rem;">{{ mainUser.email }}</span></div>
                            <div class="fw-bold" style="color: #330000"><i class="fa-solid fa-phone me-3 mb-1" style="font-size: 1.1rem;"></i><span style="font-size: 1.1rem;">{{ mainUser.phone }}</span></div>
                            <div class="fw-bold" style="color: #330000"><i class="fa-solid fa-location-dot me-3 mb-1" style="font-size: 1.1rem;"></i><span style="font-size: 1.1rem;">{{ mainUser.address }}</span></div>
                            <div class="fw-bold" style="color: #330000"><i class="fa-solid fa-venus-mars me-3 mb-1" style="font-size: 1.1rem;"></i><span style="font-size: 1.1rem;">{{ mainUser.gender }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="../../../js/admin/profilePage.js"></script>
