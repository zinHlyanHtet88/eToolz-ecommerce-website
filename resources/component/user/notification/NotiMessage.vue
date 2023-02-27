<template>
    <div>
        <legend class="cartHeader" style="margin-bottom: 70px;">Notifications</legend>
        <div class="row">
            <div class="col-8 offset-2 content">
                <div class="text-center fs-1 fw-bold text-secondary" v-if="privateMessages == ''">There is no message.</div>
                <div class=" border border-1 rounded p-3" v-for="(message, index) in privateMessages" :key="index" v-else>
                    <div class="text-end ">
                        <button class="btn" @click="deleteMessage"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                    <div class="">eToolz team replied your message.</div>
                    <hr class=" mt-4">
                    <div class="text-muted mt-2 mb-3">{{ message.reply }}</div>
                    <input type="hidden" :value="message.id" class="messageId">
                </div>
            </div>
        </div>
    </div>
</template>

<script src="../../../js/user/notification/notiMessage.js"></script>
