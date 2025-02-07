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
        style="background-image: url('{{ asset('/uploads/services/' . $prewiring->banner_image) }}'); 
                background-size: cover; height: 350px;">
        <div class="container">
            <div class="row">
            <div class="col">
                <div class="page-banner text-center">
                <h2>{{ $prewiring->banner_heading }}</h2>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home.page') }}">Home</a></li>
                    <li><a href="#">Service & Support</a></li>
                    <li>{{ $prewiring->banner_heading }}</li>
                </ul>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="pre-wiring-consultations-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="pre-wiring-consu-image-sec wow fadeInLeft animated" data-wow-delay="800ms" data-wow-duration="800ms" 
                        style="visibility: visible; animation-duration: 4800ms; animation-delay: 800ms; animation-name: fadeInLeft;">
                        <img src="{{ asset('/uploads/services/' . $prewiring->image) }}" alt="Pre-wiring Consultation">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="pre-wiring-consu-content-sec wow fadeInRight animated" data-wow-delay="400ms" data-wow-duration="400ms" 
                        style="visibility: visible; animation-duration: 400ms; animation-delay: 400ms; animation-name: fadeInRight;">
                        <p>{!! $prewiring->detailed_description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="pre-wiring-cons-second-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pre-wiring-cons-second-title-sec">
                        <h3>{{ $prewiring->section_heading ?? 'Electrical Load Calculation' }}</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                @php
                    $calculationImages = json_decode($prewiring->calculation_images, true);
                    $calculationTitles = json_decode($prewiring->calculation_titles, true);
                    $calculationDescriptions = json_decode($prewiring->calculation_descriptions, true);
                @endphp

                @if(!empty($calculationTitles))
                    @foreach($calculationTitles as $index => $title)
                        <div class="col-lg-4">
                            <div class="pre-wiring-cons-three-cols-sec wow fadeInUp animated" 
                                data-wow-delay="{{ 400 + ($index * 400) }}ms" data-wow-duration="400ms" 
                                style="visibility: visible; animation-duration: 400ms; animation-delay: {{ 400 + ($index * 400) }}ms; animation-name: fadeInUp;">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <div class="pwc-icon-sec">
                                            @if(isset($calculationImages[$index]) && !empty($calculationImages[$index]))
                                                <img src="{{ asset('/uploads/services/' . $calculationImages[$index]) }}" 
                                                    alt="Calculation Image">
                                            @else
                                                <img src="{{ asset('img/icon/default-icon.png') }}" alt="Default Icon">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="pwc-content-sec">
                                            <h3>{{ $title }}</h3>
                                            <p>{{ $calculationDescriptions[$index] ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p>No Electrical Load Calculation data available.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="pwc-third-sec">
      <div class="container">
          <div class="row">
              <div class="col-lg-6">
                  <div class="pwc-third-content-sec wow fadeInLeft animated" data-wow-delay="800ms" data-wow-duration="800ms">
                      
                      <div class="pre-wiring-listing-sec">
                          {!! $prewiring_partB->detailed_description !!}
                      </div>

                  </div>
              </div>

              <div class="col-lg-6">
                  <div class="pwc-third-img-sec wow fadeInRight animated" data-wow-delay="400ms" data-wow-duration="400ms">
                      <img src="{{ asset('uploads/services/' . ($prewiring_partB->image )) }}" alt="Pre-Wiring Image">
                      </div>
                  </div>
              </div>
          </div>
    </div>

      <section class="benefits-area">
          <div class="container">
              <div class="row">

                  <div class="col-lg-12">
                      <div class="pwc-third-procss-title-sec">
                          <h2>{{ $prewiring_partB->section_heading }}</h2>
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
                          {"breakpoint":1199, "settings": {"slidesToShow": 3 }},
                          {"breakpoint":992, "settings": {"slidesToShow": 2 }},
                          {"breakpoint":768, "settings": {"slidesToShow": 2 }},
                          {"breakpoint":576, "settings": {"slidesToShow": 1, "arrows": false, "autoplay": true }}
                      ]'>

                      @php
                          $calculationImages = json_decode($prewiring_partB->calculation_images ?? '[]', true);
                          $calculationTitles = json_decode($prewiring_partB->calculation_titles ?? '[]', true);
                          $calculationDescriptions = json_decode($prewiring_partB->calculation_descriptions ?? '[]', true);
                      @endphp

                      @foreach($calculationTitles as $index => $title)
                          <div class="col">
                              <div class="single-process">
                                  <img src="{{ asset('uploads/services/' . ($calculationImages[$index] ?? 'img/icon/default.png')) }}" alt="Image">
                                  <h3>{{ $title }}</h3>
                                  <p>{{ $calculationDescriptions[$index] ?? '' }}</p>
                                  <span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                              </div>
                          </div>
                      @endforeach

                      </div>
                  </div>

              </div>
          </div>
      </section>



        @include('components.frontend.footer')
        
        @include('components.frontend.main-js')

</body>
</html>