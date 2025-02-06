<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
</head>


<body>
<div id="main-wrapper">

        @include('components.frontend.header')
	 

    <!-- Page Banner Section Start -->
    <div class="page-banner-section section" 
      style="background-image: url('{{ asset('/uploads/about/' . $whoWeAre->banner_image) }}');">
      <div class="container">
        <div class="row">
          <div class="col">

            <div class="page-banner text-center">
              <h2>{{ $whoWeAre->banner_title }}</h2>
              <ul class="page-breadcrumb">
                <li><a href="./">Home</a></li>
                <li>{{ $whoWeAre->banner_title }}</li>
              </ul>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- Page Banner Section End -->

    <!-- About-us-one-sec -->
    <section class="about-section about-us-main-sec">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-us-one-img-sec">
                        <!-- Display Banner Image dynamically -->
                        <img src="{{ asset('uploads/about/' . $whoWeAre->image) }}" alt="About Us Banner image">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="aboutus-page-text-sec wow fadeInRight animated" data-wow-delay="400ms" data-wow-duration="400ms">
                        <p>{!! $whoWeAre->short_description !!}</p> <!-- Display description dynamically -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="aboutus-page-features-sec">
                                    <img src="{{ asset('uploads/about/' . $whoWeAre->icon) }}" alt="Who We Are Icon">
                                   
                                    <p>{!! $whoWeAre->description !!}</p> <!-- Display short description dynamically -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About-us-one-sec -->

    <!-- Our Product range section -->
    <section class="services halfbg our-pro-ran-sec">
    <div class="background bg-img pro-ran-valign-sec parallaxie" data-background="img/bg/06.webp" data-overlay-dark="7"
        style="background-image: url({{ asset('frontend/assets/img/bg/06.webp') }}); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: top;">
    </div>
    <div class="container ontop">
        <div class="pro-range-title-sec">
        <h2>{{ $productVisionRange->product_title }}</h2>
        <p>{{ $productVisionRange->product_description }}</p>
        </div>
        <div class="row">
        @foreach(json_decode($productVisionRange->product_titles) as $key => $title)
            <div class="col-lg-3 col-md-6 item-bx">
            @php
                $productImage = json_decode($productVisionRange->product_images)[$key] ?? 'default-image.jpg'; // Default image in case of missing data
            @endphp
            <img src="{{ asset('uploads/about/product-range/' . $productImage) }}" alt="{{ $title }}">
            <h3>{{ $title }}</h3>
            <p>{{ json_decode($productVisionRange->product_descriptions)[$key] }}</p>
            </div>
        @endforeach
        </div>
    </div>
    </section>
    <!-- Our Product range section -->

    <section class="why-choose-us-sec">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-4 col-md-6">
            <div class="why-choose-us-title-sec">
              <h2>Why Choose Us?</h2>
              <p>At JHA Electricals, we don't just sell products - we deliver trust. Every item undergoes rigorous
                quality checks, ensuring that it meets global safety and performance standards. Our customer-first
                approach is rooted in three core values:</p>
            </div>
          </div>

          <div class="col-lg-8 col-md-6">
            <div class="blog-slider tf-element-carousel" data-slick-options='{
              "slidesToShow": 2,
              "slidesToScroll": 1,
              "infinite": true,
              "autoplay": true,
              "autoplayTimeout": 2000,
              "arrows": false,
              "dots": false,
              "prevArrow": {"buttonClass": "slick-btn slick-prev", "iconClass": "fa fa-angle-left" },
              "nextArrow": {"buttonClass": "slick-btn slick-next", "iconClass": "fa fa-angle-right" }
              }' data-slick-responsive='[
              {"breakpoint":1199, "settings": {
              "slidesToShow": 1
              }},
              {"breakpoint":992, "settings": {
              "slidesToShow": 1
              }},
              {"breakpoint":768, "settings": {
              "slidesToShow": 1
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
                    src="img/banner/quality-img-3.webp" alt="Quality You Can Rely On"></a></div>
                  <div class="content">
                    <h3 class="title">Quality You Can Rely On:</h3>
                    <p>Each product is engineered to deliver exceptional performance and longevity.</p>
                  </div>
                </div>
              </div>
              <!-- Single Blog End -->
              <!-- Single Blog Start -->
              <div class="blog col">
                <div class="blog-inner">
                  <div class="media"><a href="#" class="image"><img
                    src="img/banner/safety-first-img.webp" alt="Safety First"></a></div>
                  <div class="content">
                    <h3 class="title">Safety First:</h3>
                    <p>We prioritize safety, using only the highest-grade materials to safeguard your spaces.</p>
                  </div>
                </div>
              </div>
              <!-- Single Blog End -->
              <!-- Single Blog Start -->
              <div class="blog col">
                <div class="blog-inner">
                  <div class="media"><a href="#" class="image"><img
                    src="img/banner/innovation-at-every-step.webp" alt="Innovation at Every Step"></a></div>
                  <div class="content">
                    <h3 class="title">Innovation at Every Step:</h3>
                    <p>By integrating modern technology, we ensure our solutions keep evolving.</p>
                  </div>
                </div>
              </div>
              <!-- Single Blog End -->
            </div>
          </div>

        </div>
      </div>
    </section>

    <div class="our-vision-sec" style="background-image: url('{{ asset('uploads/about/product-vision/' . $productVisionRange->vision_image) }}');">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="call-action">
              <div class="sec-title">
                <h2 class="title title2">
                {{ $productVisionRange->vision_title }}
                </h2>
                <p>{!! $productVisionRange->vision_description !!}</p>
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