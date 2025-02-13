<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
</head>


<body>
<div id="main-wrapper">

        @include('components.frontend.header')
	 




    <!-- Page Banner Section Start -->
    <div class="page-banner-section section bg-image" 
    data-bg="{{ isset($guide->banner_image) ? asset('uploads/application/' . $guide->banner_image) : asset('img/bg/default-banner.jpg') }}"
    style="background-image: url({{ isset($guide->banner_image) ? asset('uploads/application/' . $guide->banner_image) : asset('img/bg/default-banner.jpg') }});">
    <div class="container">
        <div class="row">
        <div class="col">
            <div class="page-banner text-center">
            <h2>{{ $guide->banner_heading }}</h2>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('home.page') }}">Home</a></li>
                <li>{{ $guide->banner_heading }}</li>
            </ul>
            </div>
        </div>
        </div>
    </div>
    </div>

    <!--==================================================-->
    <div class="faqs-area shop-guide-second-sec">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12">
            <div class="shop-guide-second-left-sec">
                <div class="shop-guide-second-left-title">
                    <h3>{!! $guide->short_description  !!}</h3>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--==================================================-->

    <div class="shop-guide-process-area">
        <div class="container">
            <div class="row" id="shop-guide-second-row">
            <div class="col-lg-6">
                <div class="shop-guide-second-thumb">
                <img src="{{ asset('uploads/application/' . ($guide->image ?? 'default.jpg')) }}" alt="Shopping Guide">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shop-guide-second-process-left">
                <div class="shop-guide-second-title-sec">
                    <p>{!! $guide->detailed_description !!}</p>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!--==================================================-->
    <!-- End Echofy Process Area Home-Two -->
    <!--==================================================-->


    <div class="shop-guide-right-pro-sec">
        <div class="container">
            <div class="row">
            <div class="col-lg-12">
                <div class="shop-guid-right-title-sec">
                <h2>{{ $guide->section_heading }}</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product-slider tf-element-carousel normal-nav" data-slick-options='{
                    "slidesToShow": 4,
                    "slidesToScroll": 1,
                    "infinite": true,
                    "rows": 1,
                    "autoplay": true,
                    "arrows": false,
                    "prevArrow": {"buttonClass": "slick-btn slick-prev", "iconClass": "fa fa-angle-left" },
                    "nextArrow": {"buttonClass": "slick-btn slick-next", "iconClass": "fa fa-angle-right" }
                }' data-slick-responsive='[
                    {"breakpoint":1199, "settings": {"slidesToShow": 3}},
                    {"breakpoint":992, "settings": {"slidesToShow": 2}},
                    {"breakpoint":768, "settings": {"slidesToShow": 2}},
                    {"breakpoint":576, "settings": {"slidesToShow": 1, "arrows": false, "autoplay": true}}
                ]'>
                
                @php
                    $calculationImages = json_decode($guide->calculation_images, true) ?? [];
                    $calculationTitles = json_decode($guide->calculation_titles, true) ?? [];
                    $calculationDescriptions = json_decode($guide->calculation_descriptions, true) ?? [];
                @endphp

                @foreach ($calculationTitles as $index => $title)
                    <div class="col">
                    <div class="shop-guide-single-box-sec">
                        <img src="{{ asset('uploads/application/' . ($calculationImages[$index] ?? 'default.png')) }}" alt="Image">
                        <h3>{{ $title }}</h3>
                        <p>{{ $calculationDescriptions[$index] ?? '' }}</p>
                        <span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    </div>
                @endforeach

                </div>
            </div>
            <div class="col-lg-12">
                <p>{!! $guide->section_description !!}</p>
            </div>
            </div>
        </div>
    </div>



    <div class="indian-light-shopping-guide-sec">
        <div class="container">
            <div class="row">
            <div class="col-lg-12">
                <div class="indian-light-shopping-guide-left-sec">
                <div class="ind-li-shop-guide-title-sec">
                    @if ($guide_partB->isNotEmpty())
                        <h1>{{ $guide_partB->first()->section_heading }}</h1>
                        <p>{!! $guide_partB->first()->short_description !!}</p>
                    @endif
                </div>
                </div>
            </div>

            @if ($guide_partB && $guide_partB->isNotEmpty())
                @foreach ($guide_partB as $index => $guide)
                    <div class="col-lg-6">
                        <div class="accordion india-commer-light-accordian-sec" id="faqAccordion{{ $index }}">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $index }}">
                                    <button class="accordion-button collapsed india-commer-light-accordian-head-sec" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" 
                                        aria-expanded="false" aria-controls="collapse{{ $index }}">
                                        <img src="{{ asset('uploads/shopping/' . ($guide->image ?? 'default.png')) }}" 
                                            alt="" class="commer-light-icon-accordian-sec">
                                        {{ $guide->title }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $index }}" class="accordion-collapse collapse" 
                                    aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion{{ $index }}">
                                    <div class="accordion-body">
                                        <div class="india-commer-light-accordian-content-sec">
                                            <h3>{{ $guide->sub_title }}</h3>
                                            <p>{!! $guide->detailed_description !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No data found.</p>
            @endif


            </div>
        </div>
    </div>


        @include('components.frontend.footer')

        @include('components.frontend.main-js')

</body>
</html>