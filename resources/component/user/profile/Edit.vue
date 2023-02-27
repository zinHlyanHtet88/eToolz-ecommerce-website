<template>
    <div>
        <div class="row" style="margin-top: 70px">
            <div class="">
                <div class="w-75 m-auto">
                    <div class=" rounded shadow">
                        <div class="mt-3 ms-3">
                            <button class="btn" onclick="history.back()"><i class="fa-solid fa-arrow-left text-muted"
                                    style="font-size: 30px"></i></button>
                        </div>
                        <div class="row py-5">
                            <div class="col-3 pt-2 ps-5">
                                <h6 class="fw-bold text-uppercase " style="font-style: italic;color: #050A30;">Edit
                                    Profile
                                </h6>
                            </div>
                            <div class="col-9">
                                <div class="col-9">
                                    <div class=" d-inline-block">
                                        <img v-if="url"
                                        :src="url"
                                        style="width: 130px;height: 130px" alt="" srcset=""
                                        class="rounded-circle border border-info">
                                        <img v-else-if="mainUser.image != null"
                                            :src="'http://localhost:8000/storage/image/profileImages/' + mainUser.image"
                                            style="width: 130px;height: 130px" alt="" srcset=""
                                            class="rounded-circle border border-info">
                                        <img v-else-if="mainUser.image == null && mainUser.gender == 'male'"
                                            src="../../../../public/image/default_male.webp"
                                            style="width: 130px;height: 130px" alt="" srcset=""
                                            class="rounded-circle border border-info">
                                        <img v-else-if="mainUser.image == null && mainUser.gender == 'female'"
                                            src="../../../../public/image/default_female.jpg"
                                            style="width: 130px;height: 130px" alt="" srcset=""
                                            class="rounded-circle border border-info">
                                    </div>
                                    <div class="d-inline-block ms-5">
                                        <label for="custom-file" class="fw-bold text-muted text-uppercase">Change
                                            profile
                                            photo</label>
                                        <input type="file" id="custom-file" class="d-none" name="image" @change="pickFile">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <hr style=" width: 90%;margin: auto;border: 1px solid #D3D3D3">
                        </div>
                        <div class="row py-5">
                            <div class="col-3 pt-2 ps-5">
                                <div class="fw-bold text-uppercase text-muted" style="font-size: 15px">basic info</div>
                            </div>
                            <div class="col-9">
                                <div class="col-11">
                                    <div class="row">
                                        <div class="form-floating col">
                                            <input type="text" class="form-control" id="floatingInput"
                                                placeholder="Edit Your Name..." name="name" v-model="mainUser.name">
                                            <label for="floatingInput" class="ms-1 fw-bold">Name</label>
                                            <small class="fw-bold text-danger" v-if="updateStatus.name == true">{{ updateValidation.name }}</small>
                                        </div>
                                        <div class="form-floating col">
                                            <input type="email" class="form-control" id="floatingPassword"
                                                placeholder="Update Your Email..." name="email" v-model="mainUser.email">
                                            <label for="floatingPassword" class="ms-1 fw-bold">Email</label>
                                            <small class="fw-bold text-danger" v-if="updateStatus.email == true">{{ updateValidation.email }}</small>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="form-floating col">
                                            <input type="text" class="form-control " id="floatingInput"
                                                placeholder="Edit Your Phone Number..." name="phone" v-model="mainUser.phone">
                                            <label for="floatingInput" class="ms-1 fw-bold">Phone</label>
                                            <small class="fw-bold text-danger" v-if="updateStatus.phone == true">{{ updateValidation.phone }}</small>
                                        </div>
                                        <div class="form-floating col">
                                            <select class="form-select " id="floatingSelect"
                                                aria-label="Floating label select example" name="gender" v-model="mainUser.gender">
                                                <option value="male">
                                                    Male</option>
                                                <option value="female">
                                                    Female</option>
                                            </select>
                                            <label for="floatingSelect" class="ms-1">Gender</label>
                                        </div>
                                    </div>
                                    <div class="form-floating mt-3">
                                        <textarea class="form-control " placeholder="Edit Your Address..."
                                            id="floatingTextarea2" style="height: 100px" name="address" v-model="mainUser.address"></textarea>
                                        <label for="floatingTextarea2" class="fw-bold">Address</label>
                                        <small class="fw-bold text-danger" v-if="updateStatus.address == true">{{ updateValidation.address }}</small>
                                    </div>
                                    <div class="text-end mt-5">
                                        <button type="submit" class="btn btn-dark" style="font-size: 20px" @click="updateProfile"><i
                                                class="fa-solid fa-circle-right me-2" ></i><span>Update</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="../../../js/user/profile/edit.js"></script>
