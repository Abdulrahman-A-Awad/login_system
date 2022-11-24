<?php
$title = "Home";
include_once "layouts/header.php";
include_once "middlewares/auth.php";
include_once "layouts/navbar.php";
?>

<div class="container">
    <div class="row">
        <div class="col-12 h1 text-center text-primary font-weight-bold mt-5">
            Shop Now
        </div>
        <div class="col-4 w-100">
            <div class="card">
                <img class="card-img-top" src="images/products/laptop.jpg" alt="">
                <div class="card-body">
                    <h4 class="card-title">Laptop</h4>
                    <p class="card-text">15000 EGP</p>
                </div>
            </div>
        </div>
        <div class="col-4 w-100">
            <div class="card">
                <img class="card-img-top" src="images/products/mobile.jpg" alt="">
                <div class="card-body">
                    <h4 class="card-title">Mobile</h4>
                    <p class="card-text">12000 EGP</p>
                </div>
            </div>
        </div>
        <div class="col-4 w-100">
            <div class="card">
                <img class="card-img-top" src="images/products/tv.jpg" alt="">
                <div class="card-body">
                    <h4 class="card-title">TV</h4>
                    <p class="card-text">10000 EGP</p>
                </div>
            </div>
        </div>
    </div>
</div>





<?php 
include_once "layouts/footer.php";?>
