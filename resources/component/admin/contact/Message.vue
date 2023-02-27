<template>
    <div v-if="replyStatus == 'success'" class="alert alert-success alert-dismissible fade show row" role="alert">
      <strong>Message sent successfully.</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="">
        <div class="mt-4 d-flex justify-content-between align-items-center">
            <div class="">
                <h1 class="d-inline-block" style="margin-left: 11px">Message</h1>
                <span class="fw-bold text-muted " style="margin-left:11px;font-size: 20px">{{ messages.length }} <span>message</span>
                    found</span>
            </div>
            <div class="row form-group me-4">
                    <input type="text" class="py-1 col-10" placeholder="Search..." name="searchKey">
                    <button class="col-2 py-1 rounded-end bg-dark text-white" ><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
        <div class="row">
            <table class="table-list mt-5 col-10 offset-1">
                <thead>
                    <tr>
                        <th scope="col" class="col">#</th>
                        <th scope="col" class="col">name</th>
                        <th scope="col" class="col">email</th>
                        <th scope="col" class="col">phone</th>
                        <th scope="col" class="col">message</th>
                        <th scope="col" class="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr  v-for="(message, index) in messages" :key="index">
                        <td>{{ message.id }}</td>
                        <td >{{ message.name }}</td>
                        <td>{{ message.email }}</td>
                        <td>{{ message.phone }}</td>
                        <td v-if="message.message.length > 15">{{ message.message.slice(0, -10) + '...' }}</td>
                        <td v-else>{{ message.message }}</td>
                        <td>
                            <button class="btn btn-dark" @click="replyPage(message.id)"><i class="fa-solid fa-reply"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script src="../../../js/admin/contact/message.js"></script>

