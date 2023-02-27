<template>
    <div>
        <div class="row">
        </div>
        <div class="row" style="margin-top: 70px">
            <div class="w-75 m-auto">
                <div class="rounded shadow">
                    <div class="mt-3 ms-3">
                        <button class="btn" onclick="history.back()"><i class="fa-solid fa-arrow-left text-muted"
                                style="font-size: 30px"></i></button>
                    </div>
                    <div class="row py-5">
                        <div class="col-3 pt-2 ps-5">
                            <h6 class="fw-bold text-uppercase " style="font-style: italic;color: #050A30;">Change password
                            </h6>
                        </div>
                        <div class="col-8">

                                <div class="form-floating mb-4">
                                    <input type="password" name="oldPassword"
                                        class="form-control" id="floatingInput"
                                        placeholder="Enter Old Password..." v-model="oldPassword">
                                    <label for="floatingInput">Old Password</label>
                                    <small class=" fw-bold text-danger" v-if="passwordStatus.oldPassword == true">{{ passwordValidation.oldPassword }}</small>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" name="newPassword"
                                        class="form-control"
                                        placeholder="Enter New Password..." v-model="newPassword">
                                    <label for="floatingPassword">New Password</label>
                                </div>
                                <div class="form-floating ">
                                    <input type="password" name="confirmPassword"
                                        class="form-control"
                                         placeholder="Retype New Password..." v-model="confirmPassword">
                                    <label for="floatingPassword">Retype New Password</label>
                                </div>
                                <div class="text-end mt-5">
                                    <button @click="changePassword" class="btn btn-dark" style="font-size: 20px"><i
                                            class="fa-solid fa-key   me-2"></i><span>Change Password</span></button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="../../../js/user/password/change.js"></script>
