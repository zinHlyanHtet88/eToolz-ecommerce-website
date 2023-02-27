<template>
    <div class="alert alert-primary alert-dismissible fade show" v-if="addCartStatus == true" role="alert">
        Product added to cart successfully. <a href="http://localhost:8000/user/cart/list" class="alert-link">View
            Cart</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="container">
        <div class="">
            <a class=" text-decoration-none fw-bold text-secondary" style="font-size: 14px" @click="home()">Home</a> /
            <a class=" text-decoration-none fw-bold text-secondary" style="font-size: 14px"
                @click="devices()">Devices</a> /
            <a class=" text-decoration-none fw-bold text-secondary" style="font-size: 14px"
                @click="backWithCategoryName(product.category_name)">{{
                product.category_name
                }}</a> /
            <a class=" text-decoration-none fw-bold text-secondary" style="font-size: 14px" @click="">{{
                product.name
                }}</a>
        </div>
        <div class="row mt-5">
            <div class="col-5">
                <img :src="'http://localhost:8000/storage/image/product/' + product.image" alt=""
                    style="width: 100%;height: 350px;">
            </div>
            <div class="col-6">
                <div class="">
                    <h4>{{ product.name }}</h4>
                    <h4 class="text-decoration-line-through text-muted" v-if="product.normal_price != null  ">{{
                        product.normal_price }} kyats</h4>
                    <h4 style="color: blue;" class="mt-3">{{ product.price }} kyats</h4>
                    <h6 v-if="product.sim != null" class="fw-bold text-dark mt-3">Sim: <span>{{ product.sim }}</span>
                    </h6>
                    <h6 v-if="product.storage != null" class="fw-bold text-dark mt-3">Storage: <span>{{ product.storage
                            }}</span></h6>
                    <h6 v-if="product.processor != null" class="fw-bold text-dark mt-3">Processor: <span>{{
                            product.processor }}</span></h6>
                    <h6 v-if="product.size != null" class="fw-bold text-dark mt-3">Size: <span>{{ product.size }}</span>
                    </h6>
                    <h6 v-if="product.memory != null" class="fw-bold text-dark mt-3">Memory: <span>{{ product.memory
                            }}</span></h6>
                </div>
                <div class="mt-5 gap-3 d-flex">
                    <div class="d-flex">
                        <button class="minusBtn" @click="minusBtn">-</button>
                        <input type="text" min="0" class="quantityInput" v-model="quantityInput">
                        <button class="plusBtn" @click="plusBtn">+</button>
                    </div>
                    <div class="">
                        <button class="btn text-white px-5" style="background-color: blue" @click="addCart()">Add to
                            cart</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed " style="background-color: #D3D3D3;" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                        aria-controls="collapseThree">
                        Reviews
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="mb-1" style="font-size: 30px;">Customer Reviews</div>
                                <div class="row">
                                    <div class="col-5">
                                        <div class="stars" :style="{'--rating': overAllRating}"></div>
                                        <div class="">Based on {{ ratings.length }} review</div>
                                    </div>
                                    <div class="col-7"
                                        style="border: none;border-left: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-7">
                                                <span class=" checked setFontSize">★★★★★</span>
                                                <span class="ms-1">{{  fiveStarsRated }}%</span>
                                            </div>
                                            <span class="col-1">({{ ratedDatas.fiveStarsRating }})</span>
                                        </div>
                                        <div class="row d-flex align-items-center">
                                           <div class="col-7">
                                            <span class=" checked setFontSize">★★★★</span>
                                            <span class=" setFontSize">★</span>
                                            <span class="ms-1">{{  fourStarsRated }}%</span>
                                           </div>
                                            <span class="col-1" style="">({{ ratedDatas.fourStarsRating }})</span>
                                        </div>
                                        <div class="row d-flex align-items-center">
                                           <div class="col-7">
                                            <span class="setFontSize checked">★★★</span>
                                            <span class="setFontSize">★★</span>
                                            <span class="ms-1">{{  threeStarsRated }}%</span>
                                           </div>
                                            <span class="col-1" style="">({{ ratedDatas.threeStarsRating }})</span>
                                        </div>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-7">
                                                <span class=" checked setFontSize">★★</span>
                                                <span class="setFontSize">★★★</span>
                                                <span class="ms-1">{{  twoStarsRated }}%</span>
                                            </div>
                                            <span class="col-1" style="">({{ ratedDatas.twoStarsRating }})</span>
                                        </div>
                                        <div class="row d-flex align-items-center">
                                           <div class="col-7">
                                            <span class="setFontSize checked">★</span>
                                            <span class="setFontSize">★★★★</span>
                                            <span class="ms-1">{{ oneStarRated }}%</span>
                                           </div>
                                            <span class="col-1" style="">({{ ratedDatas.oneStarsRating }})</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-2 offset-5">
                                <!-- Button trigger modal -->
                                <button type="button" class=" btn text-muted border border-1 border-secondary mt-3"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Write a review
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Write a review</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="">{{ loggedInUser.name }}</div>
                                                <div class="">{{ todayDate }}</div>
                                                <hr class="text-secondary">
                                                <div class="mt-5">
                                                    <label for="" class="form-label">Rating</label>
                                                    <div class="" id="rating">
                                                        <span @click="rateOneStar"></span>
                                                        <span @click="rateTwoStars"></span>
                                                        <span @click="rateThreeStars"></span>
                                                        <span @click="rateFourStars"></span>
                                                        <span @click="rateFiveStars"></span>
                                                    </div>
                                                </div>
                                                <div class="mt-3 form-group">
                                                    <label for="" class=" form-label">Review title</label>
                                                    <input type="text" class=" form-control"
                                                        v-model="userReview.reviewTitle">
                                                </div>
                                                <div class="mt-3 form-group">
                                                    <label for="" class=" form-label">Review</label>
                                                    <textarea name="" class=" form-control" id="" cols="30" rows="10"
                                                        v-model="userReview.reviews"></textarea>
                                                </div>
                                                <div class="mt-3 form-group">
                                                    <div class="mb-1">Picture (optional)</div>
                                                    <label for="cameraLogo" class="border border-1 float-left">
                                                        <img src="../../../../public/image/camera_logo.jpg" alt=""
                                                            style="width: 100px;">
                                                    </label>
                                                    <div class="row">
                                                        <div class="col-4 selectedImgParent"
                                                            v-for="(selectedImage, index3) in selectedImages"
                                                            :key="index3">
                                                            <input type="hidden" name="" :value="selectedImage.id"
                                                                class="imgId">
                                                            <div class=" position-relative">
                                                                <img class="d-inline"
                                                                    :src="'http://localhost:8000/storage/image/ratingImg/' + selectedImage.image"
                                                                    alt="" style="width: 100px;height: 100px;">
                                                                <button
                                                                    class=" position-absolute rounded-circle top-0 btn unselectImg"
                                                                    style="right: 100;" @click="unselectImg"><i
                                                                        class="fa-solid fa-xmark"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="file" name="" style="display: none;" id="cameraLogo"
                                                        @change="getImgInfo">
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel review</button>
                                                <button type="button" class="btn btn-primary"
                                                    @click="review">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-3 text-secondary">
                        </div>
                        <div class="">
                            <div class="card w-50 mb-4" v-for="(rating, index) in ratings" :key="index">
                                <div  class="card-header">
                                    <div class="fw-bold">{{ rating.user_name }}</div>
                                    <div class="text-muted">{{ formatDate(rating.created_at) }}</div>
                                    <div class="">
                                        <span class=" setFontSize"
                                            v-if="rating.rating == 1"><span class="checked">★</span><span>★★★★</span></span>
                                        <span class=" setFontSize"
                                            v-if="rating.rating == 2"><span class="checked">★★</span><span>★★★</span></span>
                                        <span class=" setFontSize"
                                            v-if="rating.rating == 3"><span class="checked">★★★</span><span>★★</span></span>
                                        <span class="setFontSize"
                                            v-if="rating.rating == 4"><span class="checked">★★★★</span><span>★</span></span>
                                        <span class=" checked setFontSize"
                                         v-if="rating.rating == 5">★★★★★</span>
                                    </div>
                                    <div class="d-flex">
                                        <div class="" v-for="(ratingImage, index1) in ratingImages" :key="index1">
                                            <img style="width: 150px;height: 150px;"
                                                v-if="ratingImage.rating_code == rating.rating_code"
                                                :src="'http://localhost:8000/storage/image/ratingImg/' + ratingImage.image"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="reviewTitle mt-3 mb-2 fw-bold">{{ rating.review_title }}</div>
                                    <p class="reviewDescription text-muted">{{ rating.message }}</p>
                                </div>
                                <div class="card-body" v-for="(replied, para) in adminRepliedDatas" :key="para" >
                                    <div class="fw-bold" v-if="replied.rating_code == rating.rating_code">eToolz team replied:</div>
                                    <div class="text-dark" v-if="replied.rating_code == rating.rating_code">
                                       {{ replied.reply }}
                                    </div>
                                </div>
                                <div class="card-footer" v-if="loggedInUser.role == 'admin'">
                                    <div class="row mx-1 gap-1">
                                        <input type="text" name="" id="" v-model="replies" class="form-control col">
                                        <button class="btn text-white col-2"
                                            style="background-color: blue;" @click="reply(rating.rating_code)">reply</button>
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

<script src="../../../js/user/products/detail.js"></script>

