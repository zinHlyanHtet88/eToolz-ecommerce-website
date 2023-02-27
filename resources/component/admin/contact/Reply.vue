<template>
    <div>
        <div class=" row" style="margin-top: 110px">
            <div class="col-8 offset-2 rounded shadow">
                <div class="mt-2 ms-3">
                        <button class="btn" onclick="history.back()"><i class="fa-solid fa-arrow-left text-muted" style="font-size: 30px"></i></button>
                    <h3 class="text-info text-center fw-bold">Reply Message</h3>
                    <hr style="margin-top: 35px;border: 1px solid #D3D3D3">
                </div>
                <div class="row mb-5 mt-5">
                    <div class="col-10 offset-1">
                            <div class="row mb-1">
                                <span class="col-3">From: </span>
                                <span class="fw-bold col" >{{ message.name }}</span>
                            </div>
                            <div class="row mb-4">
                                <span class="col-3">Message: </span>
                                <span class="col">{{ message.message }}</span>
                            </div>
                            <div class=" form-group row">
                                <label for="" class="form-label col-3">Reply: </label>
                                <textarea name="" class="form-control col" id="" cols="30" rows="10" v-model="adminReply"></textarea>
                            </div>
                            <div class="text-end mt-5">
                                <button type="submit" class="btn btn-dark" style="" @click="reply(message.user_id)"><span>S E N D</span></button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="../../../js/admin/contact/reply.js"></script>
