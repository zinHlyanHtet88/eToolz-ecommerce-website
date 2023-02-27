<template>
     <div v-if="profileUpdateStatus == 'success'" class="alert alert-success alert-dismissible fade show row" role="alert">
      <strong>Profile updated successfully.</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="">
        <!-- carousel open  -->
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../../../public/image/macbookPro.jpg" style="height: 700px" class="d-block w-100"
                        alt="...">
                    <div class="carousel-caption text-end w-75" style="margin-bottom: 80px;">
                        <button class="fw-bold "
                            style="color: blue;padding: 5px 10px;border: none;border-radius: 10px;" @click="carouselDetailPage">shop now</button>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="../../../public/image/airpodsMarketingBoard.webp" style="height: 700px"
                        class="d-block w-100" alt="...">
                    <div class="carousel-caption text-end w-75" style="margin-bottom: 80px;">
                        <button class="fw-bold "
                            style="color: blue;padding: 5px 10px;border: none;border-radius: 10px;">shop now</button>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="../../../public/image/iphoneMarketingBoard.webp" style="height: 700px"
                        class="d-block w-100" alt="...">
                    <div class="carousel-caption text-end w-75" style="margin-bottom: 80px;">
                        <button class="fw-bold "
                            style="color: blue;padding: 5px 10px;border: none;border-radius: 10px;">shop now</button>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- carousel close  -->


        <!-- category section open -->
        <div class="container" style="margin-top: 100px">
            <h4 class="fw-bold " style="color: blue;">By Categories</h4>
            <hr class="container" style="margin-bottom: 50px;border: 1px solid #D3D3D3">
            <div class="products-grid row  m-auto ">
                <div class="col text-center" v-for="(category, index) in categories" :key="index">
                    <div class="" @click="sameCategoryProducts(category.name)">
                        <img  :src="'http://localhost:8000/storage/image/category/' + category.image" alt=""
                        style="width: 100px;height: 100px;" srcset="" >
                    </div>
                    <div @click="sameCategoryProducts(category.name)">{{ category.name }}</div>
                </div>
            </div>
        </div>
        <!-- category section close  -->



        <!-- discount section open  -->
        <div class="container" style="margin-top: 100px;">
            <div class="">Get It or Regret It</div>
            <h4 class="fw-bold " style="color: blue;margin-top: 20px;">Discount Offers</h4>
            <hr class="container" style="margin-bottom: 50px;border: 1px solid #D3D3D3">
            <div class="row text-center border border-1 rounded px-1 py-4" >
                <div class="text-end mb-5" >
                    <button style="border-radius: 15px;border: 1px solid #D3D3D3;font-size: 12px;" class="p-1">More Offers ></button>
                </div>
                <div class="col-3 p-2 mb-2" v-for="(discountProduct, index1) in discountProducts" :key="index1" @click="productDetailPage(discountProduct.id)">
                    <img :src="'http://localhost:8000/storage/image/product/' + discountProduct.image" class="mb-2" style="width: 150px;height: 150px">
                    <div class="text-start fw-bold mb-2">{{ discountProduct.name }}</div>
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <div class="text-decoration-line-through text-secondary text-start " style="font-size: 14px">{{ discountProduct.normal_price }} Kyats</div>
                            <div class="text-info text-start" style="font-size: 14px">{{ discountProduct.price }} Kyats</div>
                        </div>
                        <div class="me-3">
                            <button class="btn btn-sm buyBtn text-white" style="background-color: blue;"><i class="fa-solid fa-cart-shopping"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- discount section close  -->


    </div>
</template>

<script src="../../js/user/home.js"></script>
