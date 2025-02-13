<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
</head>


<body>
<div id="main-wrapper">

        @include('components.frontend.header')
	 

    <!-- Page Banner Section Start -->
    <div class="page-banner-section section bg-image" data-bg="{{ asset('frontend/assets/img/bg/breadcrumb-img.webp') }}"
        style="background-image: url('{{ asset('frontend/assets/img/bg/breadcrumb-img.webp') }}');">
      <div class="container">
        <div class="row">
          <div class="col">

            <div class="page-banner text-center">
              <h2>{{ $heading->heading }}</h2>
              <ul class="page-breadcrumb">
                <li><a href="./">Home</a></li>
                <li>{{ $heading->heading }}</li>
              </ul>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- Page Banner Section End -->

    <!-- About-us-one-sec -->
    <section class="product-listing-sec">
      <div class="container">
        <div class="row align-items-center">

          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-list-single-grid-sec mb-30">
              <div class="product-image">
                <a href="led-panel-lights.html">
                  <img src="img/products/led-panel-light.png" class="img-fluid" alt="">
                </a>
                <div class="product-action d-flex justify-content-between">
                  <a class="product-btn" href="led-panel-lights.html">Know More</a>
                </div>
              </div>
              <div class="product-list-content-sec">
                <!--<div class="product-category-rating">-->
                <!--  <span class="category"><a href="#">LED Panel Light</a></span>-->
                <!--</div>-->
                <h3 class="title"> <a href="led-panel-lights.html">LED Panel Light</a></h3>
              </div>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-list-single-grid-sec mb-30">
              <div class="product-image">
                <a href="#">
                  <img src="img/products/Imperia_1.png" class="img-fluid" alt="">
                </a>
                <div class="product-action d-flex justify-content-between">
                  <a class="product-btn" href="#">Know More</a>
                </div>
              </div>
              <div class="product-list-content-sec">
                <!--<div class="product-category-rating">-->
                <!--  <span class="category"><a href="#">COB Spot Light</a></span>-->
                <!--</div>-->
                <h3 class="title"> <a href="#">COB Spot Light</a></h3>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-list-single-grid-sec mb-30">
              <div class="product-image">
                <a href="#">
                  <img src="img/products/outdoor-wall-light-img-1.png" class="img-fluid" alt="">
                </a>
                <div class="product-action d-flex justify-content-between">
                  <a class="product-btn" href="#">Know More</a>
                </div>
              </div>
              <div class="product-list-content-sec">
                <!--<div class="product-category-rating">-->
                <!--  <span class="category"><a href="#">LED Panel Light</a></span>-->
                <!--</div>-->
                <h3 class="title"> <a href="#">Outdoor Wall Light</a></h3>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-list-single-grid-sec mb-30">
              <div class="product-image">
                <a href="#">
                  <img src="img/products/led-bulb-img.png" class="img-fluid" alt="">
                </a>
                <div class="product-action d-flex justify-content-between">
                  <a class="product-btn" href="#">Know More</a>
                </div>
              </div>
              <div class="product-list-content-sec">
                <!--<div class="product-category-rating">-->
                <!--  <span class="category"><a href="#">LED Panel Light</a></span>-->
                <!--</div>-->
                <h3 class="title"> <a href="#">LED Bulb / Lamp Light</a></h3>
              </div>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-list-single-grid-sec mb-30">
              <div class="product-image">
                <a href="#">
                  <img src="img/products/led-tube-l-img.png" class="img-fluid" alt="">
                </a>
                <div class="product-action d-flex justify-content-between">
                  <a class="product-btn" href="#">Know More</a>
                </div>
              </div>
              <div class="product-list-content-sec">
                <!--<div class="product-category-rating">-->
                <!--  <span class="category"><a href="#">LED Panel Light</a></span>-->
                <!--</div>-->
                <h3 class="title"> <a href="#">LED Tube / T</a></h3>
              </div>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-list-single-grid-sec mb-30">
              <div class="product-image">
                <a href="#">
                  <img src="img/products/led-track-light-img.png" class="img-fluid" alt="">
                </a>
                <div class="product-action d-flex justify-content-between">
                  <a class="product-btn" href="#">Know More</a>
                </div>
              </div>
              <div class="product-list-content-sec">
                <!--<div class="product-category-rating">-->
                <!--  <span class="category"><a href="#">LED Panel Light</a></span>-->
                <!--</div>-->
                <h3 class="title"> <a href="#">LED Track Light(ARM Type)</a></h3>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-list-single-grid-sec mb-30">
              <div class="product-image">
                <a href="#">
                  <img src="img/products/led-cylinder-type-img.png" class="img-fluid" alt="">
                </a>
                <div class="product-action d-flex justify-content-between">
                  <a class="product-btn" href="#">Know More</a>
                </div>
              </div>
              <div class="product-list-content-sec">
                <!--<div class="product-category-rating">-->
                <!--  <span class="category"><a href="#">LED Panel Light</a></span>-->
                <!--</div>-->
                <h3 class="title"> <a href="#">LED Track Light(Cylinder Type)</a></h3>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-list-single-grid-sec mb-30">
              <div class="product-image">
                <a href="#">
                  <img src="img/products/led-linear-light-img.png" class="img-fluid" alt="">
                </a>
                <div class="product-action d-flex justify-content-between">
                  <a class="product-btn" href="#">Know More</a>
                </div>
              </div>
              <div class="product-list-content-sec">
                <!--<div class="product-category-rating">-->
                <!--  <span class="category"><a href="#">LED Flood Light</a></span>-->
                <!--</div>-->
                <h3 class="title"> <a href="#">LED Track Light(Linear Type)</a></h3>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-list-single-grid-sec mb-30">
              <div class="product-image">
                <a href="#">
                  <img src="img/products/led-alfa-img.png" class="img-fluid" alt="">
                </a>
                <div class="product-action d-flex justify-content-between">
                  <a class="product-btn" href="#">Know More</a>
                </div>
              </div>
              <div class="product-list-content-sec">
                <!--<div class="product-category-rating">-->
                <!--  <span class="category"><a href="#">LED Track Light</a></span>-->
                <!--</div>-->
                <h3 class="title"> <a href="#">LED Bulk Head Alfa</a></h3>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-list-single-grid-sec mb-30">
              <div class="product-image">
                <a href="#">
                  <img src="img/products/led-street-light-img.png" class="img-fluid" alt="">
                </a>
                <div class="product-action d-flex justify-content-between">
                  <a class="product-btn" href="#">Know More</a>
                </div>
              </div>
              <div class="product-list-content-sec">
                <!--<div class="product-category-rating">-->
                <!--  <span class="category"><a href="#">Outdoor Wall Light</a></span>-->
                <!--</div>-->
                <h3 class="title"> <a href="#">LED Street Light</a></h3>
              </div>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-list-single-grid-sec mb-30">
              <div class="product-image">
                <a href="#">
                  <img src="img/products/flood-light-img.png" class="img-fluid" alt="">
                </a>
                <div class="product-action d-flex justify-content-between">
                  <a class="product-btn" href="#">Know More</a>
                </div>
              </div>
              <div class="product-list-content-sec">
                <!--<div class="product-category-rating">-->
                <!--  <span class="category"><a href="#">Outdoor Wall Light</a></span>-->
                <!--</div>-->
                <h3 class="title"> <a href="#">LED Flood Light</a></h3>
              </div>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-list-single-grid-sec mb-30">
              <div class="product-image">
                <a href="#">
                  <img src="img/products/high-bay-light-img.png" class="img-fluid" alt="">
                </a>
                <div class="product-action d-flex justify-content-between">
                  <a class="product-btn" href="#">Know More</a>
                </div>
              </div>
              <div class="product-list-content-sec">
                <!--<div class="product-category-rating">-->
                <!--  <span class="category"><a href="#">Outdoor Wall Light</a></span>-->
                <!--</div>-->
                <h3 class="title"> <a href="#">High Bay Light</a></h3>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>


        @include('components.frontend.footer')
        
        @include('components.frontend.main-js')




</body>
</html>