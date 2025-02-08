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
     data-bg="{{ isset($residential) && $residential->banner_image ? asset('uploads/application/' . $residential->banner_image) : asset('uploads/application/default-banner.webp') }}"
     style="background-image: url('{{ isset($residential) && $residential->banner_image ? asset('uploads/application/' . $residential->banner_image) : asset('uploads/application/default-banner.webp') }}');">

        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-banner text-center">
                        <h2>{{ $residential->banner_heading }}</h2>
                        <ul class="page-breadcrumb">
                            <li><a href="{{ route('home.page') }}">Home</a></li>
                            <li><a href="#">Application Area</a></li>
                            <li>{{ $residential->banner_heading }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="residential-lighting-one-sec post-install-train-one-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="post-install-train-image-sec">
                        <img src="{{ isset($residential) && $residential->image ? asset('uploads/application/' . $residential->image) : asset('img/default-image.png') }}" 
                            alt="Residential Lighting">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="post-install-tra-content-sec">
                        <p>{!! $residential->detailed_description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="residential-lighting-two-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="resi-light-second-title-sec">
                        <h3>{{ $residential->section_heading }}</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                @php
                    $calculationImages = json_decode($residential->calculation_images, true) ?? [];
                    $calculationTitles = json_decode($residential->calculation_titles, true) ?? [];
                    $calculationDescriptions = json_decode($residential->calculation_descriptions, true) ?? [];
                @endphp

                @foreach ($calculationTitles as $index => $title)
                    <div class="col-lg-4">
                        <div class="resi-light-three-col-sec">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <div class="resi-light-icon-sec">
                                        <img src="{{ asset('uploads/application/' . ($calculationImages[$index] ?? 'default.png')) }}" 
                                            alt="Switch Icon">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="resi-light-content-sec">
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

    <div class="resi-light-third-sec">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="resi-light-thrid-content-sec">
                        @if($residential_partB)
                            <div class="resi-light-third-listing-sec">
                                <ul>
                                    <li>{!! $residential_partB->detailed_description !!}</li>
                                </ul>
                            </div>
                        @else
                            <p>No data available for this section.</p>
                        @endif
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="resi-light-third-img-sec">
                        @if($residential_partB && $residential_partB->image)
                            <img src="{{ asset('uploads/services/' . $residential_partB->image) }}" alt="Residential Image">
                        @else
                            <img src="{{ asset('img/resi-light-img-2.webp') }}" alt="Default Image">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="resi-light-four-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pit-foo-slider-title-sec">
                        <h2>{{ $residential_partB->section_heading }}</h2>
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

                        @if ($residential_partB)
                            @php
                                $titles = json_decode($residential_partB->calculation_titles ?? '[]', true);
                                $descriptions = json_decode($residential_partB->calculation_descriptions ?? '[]', true);
                                $images = json_decode($residential_partB->calculation_images ?? '[]', true);
                            @endphp


                            @foreach ($titles as $index => $title)
                                <div class="col">
                                    <div class="resi-light-single-box-sec">
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
                    <p>{{ $residential_partB->section_description ?? 'As the Indian residential market continues to evolve, we can expect to see further advancements in lighting, switches, accessories, and wiring technologies, driven by innovation, sustainability, and consumer preferences.' }}</p>
                </div>
            </div>
        </div>
    </div>


    <div class="india-resi-light-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="india-resi-light-left-sec">
                        <div class="india-resi-light-title-sec">
                            @if ($residential_partC->isNotEmpty())
                                <h1>{{ $residential_partC->first()->section_heading ?? 'Overview of each category:' }}</h1>
                                <p>{{ $residential_partC->first()->short_description ?? "India's residential lighting, switches, accessories, and wiring sectors form a critical part of the country's infrastructure, reflecting rapid technological advancements, growing urbanization, and increasing consumer awareness of energy efficiency and aesthetics." }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="row">
                        @foreach ($residential_partC as $index => $part)
                            <div class="col-lg-6">
                                <div class="accordion india-resi-light-accordian-sec" id="faqAccordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $index }}">
                                            <button class="accordion-button collapsed india-resi-light-accordian-head-sec" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" 
                                                aria-expanded="false" aria-controls="collapse{{ $index }}">
                                                <img src="{{ asset('uploads/application/' . $part->image) }}" alt="" class="resi-light-icon-accordian-sec">
                                                      {{ $part->title }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}"
                                            data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                <div class="india-resi-light-accordian-content-sec">
                                                    <p>{!! $part->detailed_description ?? 'No details available.' !!}</p>

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