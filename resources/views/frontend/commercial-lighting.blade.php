<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
</head>


<body>
<div id="main-wrapper">

        @include('components.frontend.header')
	 


    <!-- Page Banner Section Start -->
    <div class="page-banner-section section bg-image"   data-bg="{{ isset($commercial) && $commercial->banner_image ? asset('uploads/application/' . $commercial->banner_image) : asset('uploads/application/default-banner.webp') }}"
     style="background-image: url('{{ isset($commercial) && $commercial->banner_image ? asset('uploads/application/' . $commercial->banner_image) : asset('uploads/application/default-banner.webp') }}');">

      <div class="container">
        <div class="row">
          <div class="col">

            <div class="page-banner text-center">
              <h2>{{ $commercial->banner_heading }}</h2>
              <ul class="page-breadcrumb">
                <li><a href="{{ route('home.page') }}">Home</a></li>
                <li><a href="#">Application Area</a></li>
                <li>{{ $commercial->banner_heading }}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="commercial-lighting-one-sec">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="commercial-light-img-sec">
                <img src="{{ isset($commercial) && $commercial->image ? asset('uploads/application/' . $commercial->image) : asset('img/default-image.png') }}" 
                alt="commercial Lighting">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="commercial-light-listing-sec">
              <p>{!! $commercial->detailed_description !!}</p>
            </div>
            
          </div>
        </div>
      </div>
    </div>

    <div class="commercial-light-two-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="commercial-light-second-title-sec">
                        <h3>{{ $commercial->section_heading }}</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                @php
                    $calculationImages = json_decode($commercial->calculation_images, true) ?? [];
                    $calculationTitles = json_decode($commercial->calculation_titles, true) ?? [];
                    $calculationDescriptions = json_decode($commercial->calculation_descriptions, true) ?? [];
                @endphp

                @foreach ($calculationTitles as $index => $title)
                    <div class="col-lg-4">
                        <div class="commer-light-three-col-sec">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <div class="commer-light-icon-sec">
                                        <img src="{{ asset('uploads/application/' . ($calculationImages[$index] ?? 'default.png')) }}" 
                                            alt="Switch Icon">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="commer-light-content-sec">
                                        <h3>{{ $title }}</h3>
                                        <p>{{ $calculationDescriptions[$index] ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="commer-light-third-sec">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="commer-light-thrid-content-sec">
                        @if($commercial_partB)
                            <div class="commer-light-third-listing-sec">
                                <ul>
                                    <li>{!! $commercial_partB->detailed_description !!}</li>
                                </ul>
                            </div>
                        @else
                            <p>No data available for this section.</p>
                        @endif
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="commer-light-third-img-sec">
                        @if($commercial_partB && $commercial_partB->image)
                            <img src="{{ asset('uploads/services/' . $commercial_partB->image) }}" alt="Commercial Image">
                        @else
                            <img src="{{ asset('img/commercial-lighting-img-2.jpg') }}" alt="Default Image">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="commer-light-four-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pit-foo-slider-title-sec">
                        <h2>{{ $commercial_partB->section_heading }}</h2>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="product-slider tf-element-carousel normal-nav" 
                        data-slick-options='{
                            "slidesToShow": 4,
                            "slidesToScroll": 1,
                            "infinite": true,
                            "rows": 1,
                            "autoplay": true,
                            "arrows": true,
                            "prevArrow": {"buttonClass": "slick-btn slick-prev", "iconClass": "fa fa-angle-left" },
                            "nextArrow": {"buttonClass": "slick-btn slick-next", "iconClass": "fa fa-angle-right" }
                        }' 
                        data-slick-responsive='[
                            {"breakpoint":1199, "settings": {"slidesToShow": 3}},
                            {"breakpoint":992, "settings": {"slidesToShow": 2}},
                            {"breakpoint":768, "settings": {"slidesToShow": 2}},
                            {"breakpoint":576, "settings": {"slidesToShow": 1, "arrows": false, "autoplay": true}}
                        ]'>

                        @if ($commercial_partB)
                            @php
                                $titles = json_decode($commercial_partB->calculation_titles ?? '[]', true);
                                $descriptions = json_decode($commercial_partB->calculation_descriptions ?? '[]', true);
                                $images = json_decode($commercial_partB->calculation_images ?? '[]', true);
                            @endphp

                            @foreach ($titles as $index => $title)
                                <div class="col">
                                    <div class="commer-light-single-box-sec">
                                        <img src="{{ asset('uploads/services/' . ($images[$index] ?? 'default.png')) }}" alt="Image">
                                        <h3>{{ $title }}</h3>
                                        <p>{{ $descriptions[$index] ?? '' }}</p>
                                        <span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>

                <div class="col-lg-12">
                    <p>{{ $commercial_partB->short_description }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="india-commer-light-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="india-commer-light-left-sec">
                        <div class="india-commer-light-title-sec">
                            @if ($commercial_partC->isNotEmpty())
                                <h1>{{ $commercial_partC->first()->section_heading }}</h1>
                                <p>{{ $commercial_partC->first()->short_description }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="row">
                        @foreach ($commercial_partC as $index => $part)
                            <div class="col-lg-6">
                                <div class="accordion india-commer-light-accordian-sec" id="faqAccordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $index }}">
                                            <button class="accordion-button collapsed india-commer-light-accordian-head-sec" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" 
                                                aria-expanded="false" aria-controls="collapse{{ $index }}">
                                                <img src="{{ asset('uploads/application/' . $part->image) }}" alt="" class="commer-light-icon-accordian-sec">
                                                {{ $part->title }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}"
                                            data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                <div class="india-commer-light-accordian-content-sec">
                                                    <p>{!! $part->detailed_description !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Add a new row after every 2 items --}}
                            @if (($index + 1) % 2 == 0)
                                </div><div class="row">
                            @endif

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


        
        @include('components.frontend.footer')

        @include('components.frontend.main-js')

</body>
</html>