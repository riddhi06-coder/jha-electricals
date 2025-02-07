<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
</head>


<body>
<div id="main-wrapper">

        @include('components.frontend.header')
	 

    <!-- Page Banner Section Start -->
    <div class="page-banner-section section bg-image" data-bg="{{ asset('uploads/services/' . $postinstall->banner_image) }}" 
        style="background-image: url('{{ asset('uploads/services/' . $postinstall->banner_image) }}');">
        <div class="container">
            <div class="row">
            <div class="col">
                <div class="page-banner text-center">
                <h2>{{ $postinstall->banner_heading }}</h2>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home.page') }}">Home</a></li>
                    <li><a href="#">Service & Support</a></li>
                    <li>{{ $postinstall->banner_heading }}</li>
                </ul>
                </div>
            </div>
            </div>
        </div>
    </div>


    <div class="pre-wiring-consultations-sec post-install-train-one-sec">
        <div class="container">
            <div class="row">
            <div class="col-lg-6">
                <div class="post-install-train-image-sec">
                <img src="{{ asset('uploads/services/' . $postinstall->image) }}" alt="Product Image">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="post-install-tra-content-sec">
                <p>{!! $postinstall->detailed_description !!}</p>
                </div>
               
            </div>
            </div>
        </div>
    </div>

    <div class="post-install-train-second-sec">
        <div class="container">
            <div class="row">
            <div class="col-lg-12">
                <div class="pre-wiring-cons-second-title-sec">
                <h3>{{ $postinstall->section_heading }}</h3>
                </div>
            </div>
            </div>
            <div class="row">
            @php
                $calculationImages = json_decode($postinstall->calculation_images, true);
                $calculationTitles = json_decode($postinstall->calculation_titles, true);
                $calculationDescriptions = json_decode($postinstall->calculation_descriptions, true);
            @endphp

            @foreach ($calculationTitles as $index => $title)
            <div class="col-lg-6">
                <div class="post-install-two-cols-sec">
                <div class="row align-items-center">
                    <div class="col-md-2">
                    <div class="pwc-icon-sec">
                        <img src="{{ asset('uploads/services/' . ($calculationImages[$index] ?? 'default.png')) }}" alt="">
                    </div>
                    </div>
                    <div class="col-md-10">
                    <div class="pwc-content-sec">
                        <h3>{{ $title }}</h3>
                        <p>{{ $calculationDescriptions[$index] }}</p>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            @endforeach
            </div>
        </div>
    </div>





    <div class="post-inst-tra-third-sec">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="post-inst-tra-content-sec">
              <div class="post-inst-tra-listing-sec">
                <h3 class="mt-0">Energy Efficiency:</h3>
                <ul>
                  <li><b>Best Practices:</b> Educate users on energy-saving tips, such as turning off lights when not in
                    use and using timers or motion sensors.</li>
                  <li><b>Dimming:</b> Explain how to utilize dimming features to reduce energy consumption while
                    maintaining adequate lighting levels.</li>
                </ul>
              </div>
              <div class="post-inst-tra-listing-sec">
                <h3>Warranty Information:</h3>
                <ul>
                  <li><b>Coverage:</b> Clarify the terms and conditions of the warranty, including what is covered and
                    what is not.</li>
                  <li><b>Claims Process:</b> Outline the steps involved in filing a warranty claim, including required
                    documentation and contact information.</li>
                </ul>
              </div>
              <div class="post-inst-tra-listing-sec">
                <h3>Smart Home Integration (if applicable):</h3>
                <ul>
                  <li><b>App Usage:</b> Demonstrate how to use the smartphone app to control the lights, create
                    schedules, and integrate with other smart home devices.</li>
                  <li><b>Voice Control:</b> If applicable, explain how to use voice assistants to control the lights.
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="post-inst-tra-third-img-sec">
              <img src="img/side-img-2.jpg" alt="">
            </div>
          </div>

        </div>
      </div>
    </div>


    <div class="benefits-area post-install-foo-slider-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pit-foo-slider-title-sec">
                        <h2>{{ $postinstall_partB->section_heading }}</h2>
                    </div>
                </div>
                <div class="col-lg-12">
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

                        @if ($postinstall_partB)
                            @php
                                $titles = json_decode($postinstall_partB->calculation_titles ?? '[]', true);
                                $descriptions = json_decode($postinstall_partB->calculation_descriptions ?? '[]', true);
                                $images = json_decode($postinstall_partB->calculation_images ?? '[]', true);
                            @endphp

                            @foreach ($titles as $index => $title)
                                <div class="col">
                                    <div class="post-inst-train-single-pro-sec">
                                        <img src="{{ asset('uploads/services/' . ($images[$index] ?? 'default.png')) }}" alt="Image">
                                        <h3>{{ $title }}</h3>
                                        <p>{{ $descriptions[$index] ?? '' }}</p>
                                        <span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No benefits data available.</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>


    
    <div class="post-ins-tra-offer-sec">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="pit-offer-title-sec">
              <h2>When to Offer Post-Installation Training:</h2>
            </div>
          </div>

          <div class="col-lg-4 col-md-4">
            <div class="pit-offer-box">
              <div class="pit-offer-thumb-sec">
                <img src="img/new-installation-img.jpg" alt="New Installation image">
              </div>
              <div class="pit-offer-content-sec">
                <h3>New Installations:</h3>
                <p>Immediately after installing new lighting fixtures.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="pit-offer-box">
              <div class="pit-offer-thumb-sec">
                <img src="img/upgrading.jpg" alt="Upgrades image">
              </div>
              <div class="pit-offer-content-sec">
                <h3>Upgrades:</h3>
                <p>When upgrading existing lighting systems.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="pit-offer-box">
              <div class="pit-offer-thumb-sec">
                <img src="img/complex-systems.jpg" alt="complex systems image">
              </div>
              <div class="pit-offer-content-sec">
                <h3>Complex Systems:</h3>
                <p>For systems with advanced features or smart home integration.</p>
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