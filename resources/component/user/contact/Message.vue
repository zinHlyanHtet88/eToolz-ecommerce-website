<template>
    <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="sendStatus == true">
      <strong>Your message has sent successfully!!</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="closeNoti"></button>
    </div>
    <div class="">
        <div class="container mt-5">
            <div class="row">
                <div class="col-7">
                    <h1 class="fw-bold" style="font-size: 3rem;">Contact Us</h1>
                    <p class="mt-4 text-muted">Feel free to contact us any time.We will get back to you as soon as we <br> can.</p>
                    <div class="" style="margin-top: 60px">
                        <input type="text" class="messageInput mb-4" placeholder="Name" v-model="user1.name">
                        <input type="text" class="messageInput mb-4" placeholder="Email" v-model="user1.email">
                        <input type="text" class="messageInput mb-4" placeholder="Phone" v-model="user1.phone">
                        <input type="text" class="messageInput mb-4" placeholder="Message" v-model="user1.message">
                        <button class="btn btn-dark w-75 mt-3 text-uppercase" @click="sendMessage">s e n d</button>
                    </div>
                </div>
                <div class="col ">
                    <div class="bg-dark text-white h-75 p-3">
                        <h1 style="font-weight: lighter;">Info</h1>
                        <div class="ms-5 mt-4">
                            <div class=" d-flex align-items-center gap-4">
                                <span><i class="fa-regular fa-envelope" style="font-size: 25px;"></i></span>
                                <span>eToolzteam@gmail.com</span>
                            </div>
                            <div class="d-flex align-items-center gap-4 mt-5">
                                <span><i class="fa-solid fa-phone" style="font-size: 25px;"></i></span>
                                <span>09252296946</span>
                            </div>
                            <div class="d-flex align-items-center gap-4 mt-5">
                                <i class="fa-solid fa-building" style="font-size: 25px;"></i>
                                <span>14 Greenroad St.</span>
                            </div>
                            <div class="d-flex align-items-center gap-4 mt-5">
                                <i class="fa-solid fa-clock" style="font-size: 25px;"></i>
                                <span>09:00 - 18:00</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="../../../js/user/contact/message.js"></script>
