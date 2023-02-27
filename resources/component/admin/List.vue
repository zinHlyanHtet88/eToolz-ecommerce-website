<template>
    <div class="">
        <div class="mt-4 row">
            <div class="col-4">
                <h1 class="d-inline-block" style="margin-left: 11px">Users List</h1>
                <span class="fw-bold text-muted " style="margin-left:11px;font-size: 20px"><span>{{ users.length }}</span> user<span v-if="users.length > 1">s</span>
                    found</span>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-3">
                <div class="form-floating">
                  <select class="form-select" id="floatingSelect" aria-label="Floating label select example" @change="getUsersByOptionSelect" v-model="listOption">
                    <option value="all" :selected="'all'">All</option>
                    <option value="admins">Admins</option>
                    <option value="users">Users</option>
                  </select>
                  <label for="floatingSelect">Select Users</label>
                </div>
            </div>
            <div class="col-3 offset-4 my-auto">
                <div class="row form-group">
                    <input type="text" class="py-1 col-10" placeholder="Search..." name="searchKey" v-model="userSearchValue" v-on:keyup.enter="userSearch">
                    <button class="col-2 py-1 rounded-end bg-dark text-white" @click="userSearch"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <table class=" mt-5 table1">
            <thead>
                <div v-if="noData == true"></div>
                <tr v-else>
                    <th scope="col" class="col">#</th>
                    <th scope="col" class="col text-center text-uppercase">image</th>
                    <th scope="col" class="col text-uppercase">name</th>
                    <th scope="col" class="col text-uppercase">email</th>
                    <th scope="col" class="col text-uppercase">phone</th>
                    <th scope="col" class="col text-uppercase">address</th>
                    <th scope="col" class="col text-uppercase">gender</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="listBody">
                <div class="text-center mt-3" v-if="noData == true">
                    <h3 class="text-danger text-center fw-bold bg-dark d-inline-block px-3 py-2 border rounded m-auto">There is no users in this option.</h3>
                </div>
                <tr v-for="(user1, index) in users" :key="index" v-else>
                    <th scope="row" id="userId">{{ user1.id }}</th>
                    <td class="col-2 text-center">
                        <img src="../../../public/image/default_male.webp" v-if="user1.image == null && user1.gender == 'male'" style="width: 60px;height: 70px;" alt="" srcset="">
                        <img src="../../../public/image/default_female.jpg" v-else-if="user1.image == null && user1.gender == 'female'" style="width: 60px;height: 70px;" alt="" srcset="">
                        <img :src="'http://localhost:8000/storage/image/profileImages/' + user1.image" v-else-if="user1.image != null" style="width: 60px;height: 70px;" alt="" srcset="">
                    </td>
                    <td class="" style="font-size: 1rem">{{ user1.name }}</td>
                    <td class="" style="font-size: 1rem">{{ user1.email }}</td>
                    <td class="" style="font-size: 1rem">{{ user1.phone }}</td>
                    <td class="" style="font-size: 1rem">{{ user1.address }}</td>
                    <td class="" style="font-size: 1rem">{{ user1.gender }}</td>
                    <td>
                                <button class="btn btn-info me-1" v-if="user1.id != user" @click="changeRole"><i class="fa-solid fa-arrows-rotate"></i></button>
                                <button class="btn btn-danger" @click="deleteUser" v-if="user1.id != user"><i class="fa-solid fa-trash"></i></button>
                    </td>
                    <input type="hidden" name="" id="userRole" :value="user1.role">
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script src="../../js/admin/list.js"></script>
