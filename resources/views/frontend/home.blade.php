<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
</head>


<body>
<div id="main-wrapper">

        @include('components.frontend.header')
	 
     
    <!--slider section start-->
    <div class="hero-section section position-relative">
        <div class="tf-element-carousel slider-nav" data-slick-options='{
            "slidesToShow": 1,
            "slidesToScroll": 1,
            "infinite": true,
            "arrows": false,
            "dots": true,
            "autoplay": true
        }' data-slick-responsive='[
            {"breakpoint":768, "settings": {"slidesToShow": 1}},
            {"breakpoint":575, "settings": {"slidesToShow": 1}}
        ]'>

        @foreach ($banners as $index => $banner)
        <!-- Hero Item start -->
        <div class="hero-item bg-image" data-bg="{{ asset('uploads/home/banner/' . $banner->banner_image) }}">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Hero Content start -->
                        @php
                            // Define which banners should be left-aligned (1, 2, 3, and 5)
                            $leftAlignedIndexes = [0, 1, 2, 4]; // Since index starts from 0
                            $position = in_array($index, $leftAlignedIndexes) ? 'left' : 'right';

                            // Formatting the title with line breaks
                            $words = explode(' ', e($banner->banner_title));
                            $formattedTitle = '';

                            foreach ($words as $i => $word) {
                                $formattedTitle .= $word . ' ';
                                if (($i + 1) % 2 == 0 || count($words) == 2) {
                                    $formattedTitle .= '<br>';
                                }
                            }
                        @endphp

                        <div class="hero-content-2 {{ $position }} pt-sm-0 pt-xs-0">
                            <h3>{{ $banner->banner_heading }}</h3>
                            <h1>{!! trim($formattedTitle) !!}</h1>
                            <a class="small-btn-style" href="#">shop now</a>
                        </div>
                        <!-- Hero Content end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Item end -->
        @endforeach

        </div>
    </div>

    <!--slider section end-->
    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-img-wrap wow fadeInLeft animated" data-wow-delay="400ms" data-wow-duration="400ms">
                    <div class="about-img-top">
                        @php
                            $images = json_decode($homeAbout->images ?? '[]');
                        @endphp
                        @if(!empty($images) && isset($images[0]))
                            <img src="{{ asset('uploads/home/about/' . $images[0]) }}" alt="About Us Image 1" width="442" height="347">
                        @endif
                    </div>

                    <div class="about-img-bottom">
                        @if(!empty($images) && isset($images[1]))
                            <img class="img-fluid" src="{{ asset('uploads/home/about/' . $images[1]) }}" alt="About Us Image 2" width="330" height="313">
                        @endif
                    </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-text wow fadeInRight animated" data-wow-delay="400ms" data-wow-duration="400ms">
                        <h2>{{ $homeAbout->heading }}</h2>
                        <p>{!! $homeAbout->description !!}</p>

                        @php
                            $values = json_decode($homeAbout->value);
                            $descriptions = json_decode($homeAbout->value_description);
                        @endphp

                        <div class="row">
                            @foreach($values as $index => $value)
                            <div class="col-sm-6">
                                <div class="about-features">
                                    <h3>{{ $value }}</h3>
                                    <p>{{ $descriptions[$index] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <a href="about-us.html" class="small-btn-style">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="foundert_sec">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="foundert_text">
                        <div class="section-title mb-30 pt-20 wow fadeInDown animated" data-wow-delay="400ms" data-wow-duration="400ms">
                        @php
                            $titleParts = explode(' ', $homeFounder->title);
                            $firstTwoWords = implode(' ', array_splice($titleParts, 0, 2));
                            $remainingWords = implode(' ', $titleParts);
                        @endphp

                        <h2>{{ $firstTwoWords }} <span>{{ $remainingWords }}</span></h2>

                        </div>

                        @if($homeFounder)
                            <p>{!! $homeFounder->description !!}</p>
                        @endif
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="foundert_img">
                        @php
                            $founderImage = $homeFounder->image ;
                        @endphp
                        <img src="{{ asset('uploads/home/founder/' . $founderImage) }}" 
                            width="266" height="464" class="img-fluid" alt="Founder Image">
                    </div>
                </div>
            </div>
        </div>
    </section>



      <!--Product section start-->
      <div class="product-section">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="section-title text-center mb-40 wow fadeInDown animated" data-wow-delay="400ms" data-wow-duration="400ms">
                <h2><span>Explore</span> Our Range</h2>
              </div>
            </div>
          </div>
          <div class="product-slider tf-element-carousel normal-nav" data-slick-options='{
            "slidesToShow": 4,
            "slidesToScroll": 1,
            "infinite": true,
            "rows": 1,
            "autoplay": true,
            "arrows": true,
            "prevArrow": {"buttonClass": "slick-btn slick-prev", "iconClass": "fa fa-angle-left" },
            "nextArrow": {"buttonClass": "slick-btn slick-next", "iconClass": "fa fa-angle-right" }
            }' data-slick-responsive='[
            {"breakpoint":1199, "settings": {
            "slidesToShow": 3
            }},
            {"breakpoint":992, "settings": {
            "slidesToShow": 2
            }},
            {"breakpoint":768, "settings": {
            "slidesToShow": 2
            }},
            {"breakpoint":576, "settings": {
            "slidesToShow": 1,
            "arrows": false,
            "autoplay": true
            }}
            ]'>
            <div class="col">
              <!--  Single Grid product Start -->
              <div class="single-grid-product mb-40">
                <div class="product-image">
                  <!-- <div class="product-label">
                    <span class="sale">-20%</span>
                    <span class="new">New</span>
                    </div> -->
                  <a href="#">
                  <img src="img/products/led-panel-light.webp" class="img-fluid" alt="LED Panel Light(Square Concealed Type)" width="266" height="355" loading="lazy">
                  <img src="img/products/led-panel-light.webp" class="img-fluid" alt="LED Panel Light(Square Concealed Type)" width="266" height="355" loading="lazy">
                  </a>
                  <div class="product-action d-flex justify-content-between">
                    <a class="product-btn" href="#">Know More</a>
                    <!-- <ul class="d-flex">
                      <li><a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                      </li>
                      <li><a href="compare.html"><i class="fa fa-shuffle"></i></a></li>
                      <li><a href="#quick-view-modal-container" data-bs-toggle="modal"
                        title="Quick View"><i class="fa fa-search"></i></a></li>
                      </ul> -->
                  </div>
                </div>
                <div class="product-content">
                  <div class="product-category-rating">
                    <!-- <span class="category"><a href="shop.html">Furniture</a></span> -->
                    <!-- <span class="rating">
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star"></i>
                      </span> -->
                  </div>
                  <h3 class="title"> <a href="#">LED Panel Light(Square Concealed Type)</a>
                  </h3>
                  <p class="product-price">Starting from <span class="discounted-price">Rs. 355/-</span></p>
                </div>
              </div>
              <!--  Single Grid product End -->
            </div>
            <div class="col">
              <!--  Single Grid product Start -->
              <div class="single-grid-product mb-40">
                <div class="product-image">
                  <!-- <div class="product-label">
                    <span class="new">New</span>
                    </div> -->
                  <a href="#">
                  <img src="img/products/led-panel-light-square-round-surface-img.webp" class="img-fluid" alt="LED Panel Light(Square Surface Type)" width="266" height="355" loading="lazy">
                  <img src="img/products/led-panel-light-square-round-surface-img.webp" class="img-fluid" alt="LED Panel Light(Square Surface Type)" width="266" height="355" loading="lazy">
                  </a>
                  <div class="product-action d-flex justify-content-between">
                    <a class="product-btn" href="#">Know More</a>
                    <!--  <ul class="d-flex">
                      <li><a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                      </li>
                      <li><a href="compare.html"><i class="ion-ios-shuffle"></i></a></li>
                      <li><a href="#quick-view-modal-container" data-bs-toggle="modal"
                        title="Quick View"><i class="ion-ios-search-strong"></i></a></li>
                      </ul> -->
                  </div>
                </div>
                <div class="product-content">
                  <div class="product-category-rating">
                    <!-- <span class="category"><a href="shop.html">Toy</a></span>
                      <span class="rating">
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star"></i>
                      </span> -->
                  </div>
                  <h3 class="title"> <a href="#">LED Panel Light(Square Surface Type)</a>
                  </h3>
                  <p class="product-price">Starting from <span class="discounted-price">Rs. 555/-</span></p>
                </div>
              </div>
              <!--  Single Grid product End -->
            </div>
            <div class="col">
              <!--  Single Grid product Start -->
              <div class="single-grid-product mb-40">
                <div class="product-image">
                  <a href="#">
                  <img src="img/products/led-panel-light-surface-type-twister-surface-light-with-holder.webp" class="img-fluid" alt="Twister Surface Light with Holder" width="266" height="355" loading="lazy">
                  <img src="img/products/led-panel-light-surface-type-twister-surface-light-with-holder.webp" class="img-fluid" alt="Twister Surface Light with Holder" width="266" height="355" loading="lazy">
                  </a>
                  <div class="product-action d-flex justify-content-between">
                    <a class="product-btn" href="#">Know More</a>
                    <!-- <ul class="d-flex">
                      <li><a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                      </li>
                      <li><a href="compare.html"><i class="ion-ios-shuffle"></i></a></li>
                      <li><a href="#quick-view-modal-container" data-bs-toggle="modal"
                        title="Quick View"><i class="ion-ios-search-strong"></i></a></li>
                      </ul> -->
                  </div>
                </div>
                <div class="product-content">
                  <div class="product-category-rating">
                    <!-- <span class="category"><a href="shop.html">Storage</a></span>
                      <span class="rating">
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star"></i>
                      </span> -->
                  </div>
                  <h3 class="title"> <a href="#">Twister Surface Light with Holder</a>
                  </h3>
                  <p class="product-price">Starting from <span class="discounted-price">Rs. 600/-</span></p>
                </div>
              </div>
              <!--  Single Grid product End -->
            </div>
            <div class="col">
              <!--  Single Grid product Start -->
              <div class="single-grid-product mb-40">
                <div class="product-image">
                  <!-- <div class="product-label">
                    <span class="sale">-20%</span>
                    <span class="new">New</span>
                    </div> -->
                  <a href="#">
                  <img src="img/products/Imperia_1.webp" class="img-fluid" alt="COB Spot Light" width="266" height="355" loading="lazy">
                  <img src="img/products/Imperia_1.webp" class="img-fluid" alt="COB Spot Light" width="266" height="355" loading="lazy">
                  </a>
                  <div class="product-action d-flex justify-content-between">
                    <a class="product-btn" href="#">Know More</a>
                    <!-- <ul class="d-flex">
                      <li><a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                      </li>
                      <li><a href="compare.html"><i class="ion-ios-shuffle"></i></a></li>
                      <li><a href="#quick-view-modal-container" data-bs-toggle="modal"
                        title="Quick View"><i class="ion-ios-search-strong"></i></a></li>
                      </ul> -->
                  </div>
                </div>
                <div class="product-content">
                  <div class="product-category-rating">
                    <!--  <span class="category"><a href="shop.html">Decor</a></span>
                      <span class="rating">
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star"></i>
                      </span> -->
                  </div>
                  <h3 class="title"> <a href="#">COB Spot Light</a>
                  </h3>
                  <p class="product-price">Starting from <span class="discounted-price">Rs. 800/-</span></p>
                </div>
              </div>
              <!--  Single Grid product End -->
            </div>
            <div class="col">
              <!--  Single Grid product Start -->
              <div class="single-grid-product mb-40">
                <div class="product-image">
                  <!-- <div class="product-label">
                    <span class="sale">-20%</span>
                    <span class="new">New</span>
                    </div> -->
                  <a href="#">
                  <img src="img/products/cob-spot-light-concealed-and-junction-box-fittings-img.webp" class="img-fluid" alt="COB Spot Light Concealed & Junction Box Fittings" width="266" height="355" loading="lazy">
                  <img src="img/products/cob-spot-light-concealed-and-junction-box-fittings-img.webp" class="img-fluid" alt="COB Spot Light Concealed & Junction Box Fittings" width="266" height="355" loading="lazy">
                  </a>
                  <div class="product-action d-flex justify-content-between">
                    <a class="product-btn" href="#">Know More</a>
                    <!-- <ul class="d-flex">
                      <li><a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                      </li>
                      <li><a href="compare.html"><i class="ion-ios-shuffle"></i></a></li>
                      <li><a href="#quick-view-modal-container" data-bs-toggle="modal"
                        title="Quick View"><i class="ion-ios-search-strong"></i></a></li>
                      </ul> -->
                  </div>
                </div>
                <div class="product-content">
                  <div class="product-category-rating">
                    <!-- <span class="category"><a href="shop.html">Decor</a></span>
                      <span class="rating">
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star"></i>
                      </span> -->
                  </div>
                  <h3 class="title"> <a href="#">COB Spot Light Concealed & Junction Box Fittings</a>
                  </h3>
                  <p class="product-price">Starting from <span class="discounted-price">Rs. 180/-</span></p>
                </div>
              </div>
              <!--  Single Grid product End -->
            </div>
            <div class="col">
              <!--  Single Grid product Start -->
              <div class="single-grid-product mb-40">
                <div class="product-image">
                  <!-- <div class="product-label">
                    <span class="sale">-20%</span>
                    </div> -->
                  <a href="#">
                  <img src="img/products/outdoor-wall-light-img-1.webp" class="img-fluid" alt="Outdoor Wall Light" width="266" height="355" loading="lazy">
                  <img src="img/products/outdoor-wall-light-img-1.webp" class="img-fluid" alt="Outdoor Wall Light" width="266" height="355" loading="lazy">
                  </a>
                  <div class="product-action d-flex justify-content-between">
                    <a class="product-btn" href="#">Know More</a>
                    <!-- <ul class="d-flex">
                      <li><a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                      </li>
                      <li><a href="compare.html"><i class="ion-ios-shuffle"></i></a></li>
                      <li><a href="#quick-view-modal-container" data-bs-toggle="modal"
                        title="Quick View"><i class="ion-ios-search-strong"></i></a></li>
                      </ul> -->
                  </div>
                </div>
                <div class="product-content">
                  <div class="product-category-rating">
                    <!-- <span class="category"><a href="shop.html">Decor</a></span>
                      <span class="rating">
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star"></i>
                      </span> -->
                  </div>
                  <h3 class="title"> <a href="#">Outdoor Wall Light</a>
                  </h3>
                  <p class="product-price">Starting from <span class="discounted-price">Rs. 780/-</span></p>
                </div>
              </div>
              <!--  Single Grid product End -->
            </div>
            <div class="col">
              <!--  Single Grid product Start -->
              <div class="single-grid-product mb-40">
                <div class="product-image">
                  <!-- <div class="product-label">
                    <span class="sale">-20%</span>
                    <span class="new">New</span>
                    </div> -->
                  <a href="#">
                  <img src="img/products/led-bulb-img.webp" class="img-fluid" alt="LED Bulb / Lamp Light" width="266" height="355" loading="lazy">
                  <img src="img/products/led-bulb-img.webp" class="img-fluid" alt="LED Bulb / Lamp Light" width="266" height="355" loading="lazy">
                  </a>
                  <div class="product-action d-flex justify-content-between">
                    <a class="product-btn" href="#">Know More</a>
                    <!-- <ul class="d-flex">
                      <li><a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                      </li>
                      <li><a href="compare.html"><i class="ion-ios-shuffle"></i></a></li>
                      <li><a href="#quick-view-modal-container" data-bs-toggle="modal"
                        title="Quick View"><i class="ion-ios-search-strong"></i></a></li>
                      </ul> -->
                  </div>
                </div>
                <div class="product-content">
                  <div class="product-category-rating">
                    <!-- <span class="category"><a href="shop.html">Sports</a></span>
                      <span class="rating">
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star"></i>
                      </span> -->
                  </div>
                  <h3 class="title"> <a href="#">LED Bulb / Lamp Light</a>
                  </h3>
                  <p class="product-price">Starting from <span class="discounted-price">Rs. 110/-</span></p>
                </div>
              </div>
              <!--  Single Grid product End -->
            </div>
            <div class="col">
              <!--  Single Grid product Start -->
              <div class="single-grid-product mb-40">
                <div class="product-image">
                  <!--  <div class="product-label">
                    <span class="sale">-20%</span>
                    <span class="new">New</span>
                    </div> -->
                  <a href="#">
                  <img src="img/products/led-track-light-img.webp" class="img-fluid" alt="LED Track Ligh (ARM Type)" width="266" height="355" loading="lazy">
                  <img src="img/products/led-track-light-img.webp" class="img-fluid" alt="LED Track Ligh (ARM Type)" width="266" height="355" loading="lazy">
                  </a>
                  <div class="product-action d-flex justify-content-between">
                    <a class="product-btn" href="#">Know More</a>
                    <!--  <ul class="d-flex">
                      <li><a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                      </li>
                      <li><a href="compare.html"><i class="ion-ios-shuffle"></i></a></li>
                      <li><a href="#quick-view-modal-container" data-bs-toggle="modal"
                        title="Quick View"><i class="ion-ios-search-strong"></i></a></li>
                      </ul> -->
                  </div>
                </div>
                <div class="product-content">
                  <div class="product-category-rating">
                    <!-- <span class="category"><a href="shop.html">Vase</a></span>
                      <span class="rating">
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star"></i>
                      </span> -->
                  </div>
                  <h3 class="title"> <a href="#">LED Track Ligh (ARM Type)</a>
                  </h3>
                  <p class="product-price">Starting from <span class="discounted-price">Rs. 1890/-</span></p>
                </div>
              </div>
              <!--  Single Grid product End -->
            </div>
            <div class="col">
              <!--  Single Grid product Start -->
              <div class="single-grid-product mb-40">
                <div class="product-image">
                  <!-- <div class="product-label">
                    <span class="sale">-20%</span>
                    <span class="new">New</span>
                    </div> -->
                  <a href="#">
                  <img src="img/products/led-linear-light-img.webp" class="img-fluid" alt="LED Linear Light" width="266" height="355" loading="lazy">
                  <img src="img/products/led-linear-light-img.webp" class="img-fluid" alt="LED Linear Light" width="266" height="355" loading="lazy">
                  </a>
                  <div class="product-action d-flex justify-content-between">
                    <a class="product-btn" href="#">Know More</a>
                    <!-- <ul class="d-flex">
                      <li><a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                      </li>
                      <li><a href="compare.html"><i class="ion-ios-shuffle"></i></a></li>
                      <li><a href="#quick-view-modal-container" data-bs-toggle="modal"
                        title="Quick View"><i class="ion-ios-search-strong"></i></a></li>
                      </ul> -->
                  </div>
                </div>
                <div class="product-content">
                  <div class="product-category-rating">
                    <!-- <span class="category"><a href="shop.html">Vase</a></span>
                      <span class="rating">
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star"></i>
                      </span> -->
                  </div>
                  <h3 class="title"> <a href="#">LED Linear Light</a>
                  </h3>
                  <p class="product-price">Starting from <span class="discounted-price">Rs. 2775/-</span></p>
                </div>
              </div>
              <!--  Single Grid product End -->
            </div>
            <div class="col">
              <!--  Single Grid product Start -->
              <div class="single-grid-product mb-40">
                <div class="product-image">
                  <!-- <div class="product-label">
                    <span class="sale">-20%</span>
                    <span class="new">New</span>
                    </div> -->
                  <a href="#">
                  <img src="img/products/flood-light-img.webp" class="img-fluid" alt="Flood Light" width="266" height="355" loading="lazy">
                  <img src="img/products/flood-light-img.webp" class="img-fluid" alt="Flood Light" width="266" height="355" loading="lazy">
                  </a>
                  <div class="product-action d-flex justify-content-between">
                    <a class="product-btn" href="#">Know More</a>
                    <!-- <ul class="d-flex">
                      <li><a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                      </li>
                      <li><a href="compare.html"><i class="ion-ios-shuffle"></i></a></li>
                      <li><a href="#quick-view-modal-container" data-bs-toggle="modal"
                        title="Quick View"><i class="ion-ios-search-strong"></i></a></li>
                      </ul -->
                  </div>
                </div>
                <div class="product-content">
                  <div class="product-category-rating">
                    <!-- <span class="category"><a href="shop.html">Vase</a></span>
                      <span class="rating">
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star active"></i>
                      <i class="fa fa-star"></i>
                      </span> -->
                  </div>
                  <h3 class="title"> <a href="#">Flood Light</a>
                  </h3>
                  <p class="product-price">Starting from <span class="discounted-price">Rs. 1665/-</span></p>
                </div>
              </div>
              <!--  Single Grid product End -->
            </div>
          </div>
        </div>
      </div>
      <div class="feature-section feature-section-2">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
              <!-- Single Feature Start -->
              <div class="single-feature">
                <div class="feature-image">
                  <img src="img/icon/pro-icon-1.webp" class="img-fluid" alt="Product Warranty" width="60" height="60" loading="lazy">
                </div>
                <div class="feature-content">
                  <h4 class="title">Product Warranty</h4>
                  <!--<p class="short-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do.</p>-->
                </div>
              </div>
              <!-- Single Feature End -->
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
              <!-- Single Feature Start -->
              <div class="single-feature">
                <div class="feature-image">
                  <img src="img/icon/pro-icon-2.webp" class="img-fluid" alt="Top Rated Products" width="60" height="60" loading="lazy">
                </div>
                <div class="feature-content">
                  <h4 class="title">Top Rated Products</h4>
                  <!--<p class="short-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do.</p>-->
                </div>
              </div>
              <!-- Single Feature End -->
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
              <!-- Single Feature Start -->
              <div class="single-feature pt-sm-30 last">
                <div class="feature-image">
                  <img src="img/icon/pro-icon-3.webp" class="img-fluid" alt="Service And Installation" width="60" height="60" loading="lazy">
                </div>
                <div class="feature-content">
                  <h4 class="title">Service And Installation</h4>
                  <!--<p class="short-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do.</p>-->
                </div>
              </div>
              <!-- Single Feature End -->
            </div>
          </div>
        </div>
      </div>
      <!-- start of cta-banner-section -->
      <section class="cta-banner-section separator-padding">
        <div class="container">
          <div class="cta-banner-wrap wow fadeInUp animated" data-wow-delay="400ms" data-wow-duration="400ms">
            <div class="row">
              <div class="col-lg-3 col-md-5">
                <div class="cta-banner-img">
                  <img src="img/quote_bg.webp" alt="LED Track Light (Linear Type) Image" width="200" height="275" loading="lazy">
                </div>
              </div>
              <div class="col-lg-9 col-md-6">
                <div class="cta-banner-text">
                  <!-- <span>New Products</span> -->
                  <h3>Need help deciding on the right products?</h3>
                  <h5>Try our product selection guide to help you in your decision making</h5>
                  <a href="contact-us.html" class="small-btn-style">Contact Us</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- end of cta-banner-section -->
      <!-- <section class="quote-banner">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="quote-text wow fadeInLeft animated" data-wow-delay="400ms" data-wow-duration="400ms">
                <h2>Need help deciding on the right products?</h2>
                <h6>Try our product selection guide to help you in your decision making</h6>
                <a class="btn" href="#" tabindex="0">Contact Us</a>
              </div>
            </div>
          </div>
        </div>
      </section> -->
      <!-- <section class="about_sec">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="about_img wow fadeInLeft animated" data-wow-delay="400ms" data-wow-duration="400ms">
                <img src="img/about-us-1.png" class="img-responsive">
              </div>
            </div>
            <div class="col-md-6">
              <div class="about_content wow fadeInRight animated" data-wow-delay="400ms" data-wow-duration="400ms">
                <h2>About <span>Jha Electricals</span></h2>
                <p>JHA ELECTRICALS is a new-age consumer electrical goods company. It's a part of the prestigious JHA GROUP, which has created a strong niche for itself in the Mumbai real estate space with its strong commitment to quality.</p>
                <p>The changing landscape of consumer behaviour in India is driven by its youth who have an uncompromising attitude towards making choices. They are highly confident about voicing their opinion and take well informed decisions. Jha Electricals has identified this space in the electrical goods category and is positioning itself as a 21" century company poised to light up the space with its quality, design and performance like no other.</p>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <div class="our-vision-text">
                    <h3>Our Vision</h3>
                    <p>To become the most-loved electrical goods company from India, serving the world.</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="our-vision-text">
                    <h3>Our Mission</h3>
                    <p>To make a difference in consumer's life with innovation, technology and passion.</p>
                  </div>
                </div>
              </div>
              <a class="btn" href="#" tabindex="0">Read more</a>
            </div>
          </div>
        </div>
      </section> -->
      <!--Product section end-->
      <!--Banner section start-->
      <!--       <div class="banner-section section">
        <div
          class="container-fluid pl-20 pr-20 pl-lg-15 pr-lg-15 pl-md-15 pr-md-15 pl-sm-15 pr-sm-15 pl-xs-15 pr-xs-15">
          <div class="row">
            <div class="col-md-6">
              <div class="single-banner-item mb-30">
                <div class="banner-image">
                  <a href="shop-left-sidebar.html">
                  <img src="./images/banner/h1-banner-4.jpg" alt="BLACK FRIDAY">
                  </a>
                </div>
                <div class="banner-content banner-content-two">
                  <h4 class="title-light">BLACK FRIDAY</h4>
                  <h3 class="title">Save Up To 50% Off</h3>
                  <a href="shop-left-sidebar.html">View Collection <i
                    class="ion-android-arrow-dropright-circle"></i></a>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="single-banner-item mb-30">
                <div class="banner-image">
                  <a href="shop-left-sidebar.html">
                  <img src="./images/banner/h1-banner-5.jpg" alt="BEST SELLING">
                  </a>
                </div>
                <div class="banner-content banner-content-two">
                  <h4 class="title-light">BEST SELLING !</h4>
                  <h3 class="title">Living Room Up To 70% Off</h3>
                  <a href="shop-left-sidebar.html">View Collection <i
                    class="ion-android-arrow-dropright-circle"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div> -->
      <!--Banner section end-->
      <!-- Testimonial Area Start -->
      <div class="testimonial-section section">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="section-title text-center mb-30 wow fadeInDown animated" data-wow-delay="400ms" data-wow-duration="400ms">
                <h2>Our <span>Clients</span> Say</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="testimonial-wrap">
                <div class="row justify-content-center">
                  <div class="col-lg-12">
                    <div class="testimonial-wrapper section-space--inner">
                      <div class="tf-element-carousel" data-slick-options='{
                        "slidesToShow": 1,
                        "slidesToScroll": 1,
                        "infinite": true,
                        "autoplay": true,
                        "arrows": false,
                        "dots": true
                        }' data-slick-responsive='[
                        {"breakpoint":768, "settings": {
                        "slidesToShow": 1
                        }},
                        {"breakpoint":575, "settings": {
                        "slidesToShow": 1
                        }}
                        ]'>
                        <div class="item">
                          <!-- single testimonial item Strat-->
                          <div class="single-testimonial-item">
                            <div class="testimonial-image">
                              <img src="img/icon/user.webp" class="img-fluid" alt="User Icon" width="70" height="70" loading="lazy">
                            </div>
                            <div class="testimonial-content">
                              <p class="testimonial-text"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                              </p>
                              <img src="img/icon/quote-icon.webp" alt="Quote Icon" width="29" height="20" loading="lazy">
                              <p class="testimonial-author">Magdalena Valencia</p>
                              <span class="post">Customer</span>
                            </div>
                          </div>
                          <!-- single testimonial item End-->
                        </div>
                        <div class="item">
                          <!-- single testimonial item Strat-->
                          <div class="single-testimonial-item">
                            <div class="testimonial-image">
                              <img src="img/icon/user.webp" class="img-fluid" alt="User Icon" width="70" height="70" loading="lazy">
                            </div>
                            <div class="testimonial-content">
                              <p class="testimonial-text"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                              </p>
                              <img src="img/icon/quote-icon.webp" alt="Quote Icon" width="29" height="20" loading="lazy">
                              <p class="testimonial-author">Magdalena Valencia</p>
                              <span class="post">Customer</span>
                            </div>
                          </div>
                          <!-- single testimonial item Strat-->
                        </div>
                        <div class="item">
                          <!-- single testimonial item Strat-->
                          <div class="single-testimonial-item">
                            <div class="testimonial-image">
                              <img src="img/icon/user.webp" class="img-fluid" alt="User Icon" width="70" height="70" loading="lazy">
                            </div>
                            <div class="testimonial-content">
                              <p class="testimonial-text"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                              </p>
                              <img src="img/icon/quote-icon.webp" alt="Quote Icon" width="29" height="20" loading="lazy">
                              <p class="testimonial-author">Magdalena Valencia</p>
                              <span class="post">Customer</span>
                            </div>
                          </div>
                          <!-- single testimonial item Strat-->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Testimonial Area End -->
      <!--Blog section start-->
      <div class="blog-section">
        <div class="container">
          <div class="row">
            <!-- Section Title Start -->
            <div class="col">
              <div class="section-title mb-40 wow fadeInDown animated" data-wow-delay="400ms" data-wow-duration="400ms">
                <h2>Latest <span>Blogs</span></h2>
              </div>
            </div>
            <!-- Section Title End -->
          </div>
          <div class="blog-slider tf-element-carousel" data-slick-options='{
            "slidesToShow": 3,
            "slidesToScroll": 1,
            "infinite": true,
            "autoplay": true,
            "autoplayTimeout": 2000,
            "arrows": true,
            "dots": false,
            "prevArrow": {"buttonClass": "slick-btn slick-prev", "iconClass": "fa fa-angle-left" },
            "nextArrow": {"buttonClass": "slick-btn slick-next", "iconClass": "fa fa-angle-right" }
            }' data-slick-responsive='[
            {"breakpoint":1199, "settings": {
            "slidesToShow": 3
            }},
            {"breakpoint":992, "settings": {
            "slidesToShow": 2
            }},
            {"breakpoint":768, "settings": {
            "slidesToShow": 2
            }},
            {"breakpoint":575, "settings": {
            "slidesToShow": 1,
            "arrows": false,
            "autoplay": true
            }}
            ]'>
            <!-- Single Blog Start -->
            <div class="blog col">
              <div class="blog-inner">
                <div class="media"><a href="#" class="image"><img
                  src="img/blog/blog1.webp" alt="Blog Image" width="364" height="265" class="img-fluid" loading="lazy"></a></div>
                <div class="content">
                  <h3 class="title"><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing</a></h3>
                  <ul class="meta">
                    <li>By <a href="#" tabindex="0">admin</a></li>
                    <li>30 October 2018</li>
                  </ul>
                  <a class="small-btn-style" href="#">Read more</a>
                </div>
              </div>
            </div>
            <!-- Single Blog End -->
            <!-- Single Blog Start -->
            <div class="blog col">
              <div class="blog-inner">
                <div class="media"><a href="#" class="image"><img
                  src="img/blog/blog2.webp" alt="Blog Image" width="364" height="265" class="img-fluid" loading="lazy"></a></div>
                <div class="content">
                  <h3 class="title"><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing</a></h3>
                  <ul class="meta">
                    <li>By <a href="#" tabindex="0">admin</a></li>
                    <li>30 October 2018</li>
                  </ul>
                  <a class="small-btn-style" href="#">Read more</a>
                </div>
              </div>
            </div>
            <!-- Single Blog End -->
            <!-- Single Blog Start -->
            <div class="blog col">
              <div class="blog-inner">
                <div class="media"><a href="#" class="image"><img
                  src="img/blog/blog3.webp" alt="Blog Image" width="364" height="265" class="img-fluid" loading="lazy"></a></div>
                <div class="content">
                  <h3 class="title"><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing</a></h3>
                  <ul class="meta">
                    <li>By <a href="#" tabindex="0">admin</a></li>
                    <li>30 October 2018</li>
                  </ul>
                  <a class="small-btn-style" href="#">Read more</a>
                </div>
              </div>
            </div>
            <!-- Single Blog End -->
            <!-- Single Blog Start -->
            <div class="blog col">
              <div class="blog-inner">
                <div class="media"><a href="#" class="image"><img
                  src="img/blog/blog4.webp" alt="Blog Image" width="364" height="265" class="img-fluid" loading="lazy"></a></div>
                <div class="content">
                  <h3 class="title"><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing</a></h3>
                  <ul class="meta">
                    <li>By <a href="#" tabindex="0">admin</a></li>
                    <li>30 October 2018</li>
                  </ul>
                  <a class="small-btn-style" href="#">Read more</a>
                </div>
              </div>
            </div>
            <!-- Single Blog End -->
          </div>
        </div>
      </div>
      <!--Blog section end-->
      <!--NewsLetter section start-->
      <div class="newsLetter-section">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="newsletter-wrapper">
                <h3 class="title">Special Offers For Subscribers</h3>
                <p class="short-desc">Subscribe to our newsletters now and stay up to date with new
                  collections, the latest lookbooks and exclusive offers.
                </p>
                <div class="newsletter-form">
                  <form id="mc-form" class="mc-form">
                    <input type="email" placeholder="Enter Your Email Address Here..." required>
                    <button type="submit" value="submit">SUBSCRIBE!</button>
                  </form>
                </div>
                <div class="mailchimp-alerts">
                  <div class="mailchimp-submitting"></div>
                  <div class="mailchimp-success"></div>
                  <div class="mailchimp-error"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div> 

      @include('components.frontend.footer')
        

       
        
        @include('components.frontend.main-js')

</body>
</html>