<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
    <!-- Lightbox CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
</head>


<body>
<div id="main-wrapper">

        @include('components.frontend.header')



        <!-- Page Banner Section Start -->
        <div class="page-banner-section section bg-image" data-bg="{{ isset($gallery) && $gallery->banner_image ? asset('uploads/gallery/' . $gallery->banner_image) : asset('uploads/application/default-banner.webp') }}"
            style="background-image: url('{{ isset($gallery) && $gallery->banner_image ? asset('uploads/gallery/' . $gallery->banner_image) : asset('uploads/application/default-banner.webp') }}');">

            <div class="container">
                <div class="row">
                <div class="col">

                    <div class="page-banner text-center">
                    <h2>{{ $gallery->banner_heading }}</h2>
                    <ul class="page-breadcrumb">
                        <li><a href="{{ route('home.page') }}">Home</a></li>
                        <li>{{ $gallery->banner_heading }}</li>
                    </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="photo-gallery-sec">
            <div class="container">
                <div class="row">
                    @if ($galleryImages)
                        @foreach ($galleryImages as $image)
                            @if ($image) 
                                <div class="col-md-4 col-sm-6">
                                    <div class="photo-gallery-box-sec">
                                        <img src="{{ asset('uploads/gallery/' . $image) }}" alt="Gallery Image">
                                        <div class="photo-gallery-box-content-sec">
                                            <div class="inner-content">
                                                <ul class="icon">
                                                    <li>
                                                        <a href="{{ asset('uploads/gallery/' . $image) }}" data-lightbox="gallery" data-title="Gallery Image">
                                                            <i class="fa fa-search-plus"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <p class="text-center">No images available.</p>
                    @endif
                </div>
            </div>
        </div>


        @include('components.frontend.footer')

        @include('components.frontend.main-js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

</body>
</html>