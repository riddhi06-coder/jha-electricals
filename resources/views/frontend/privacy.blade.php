<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
</head>


<body>
<div id="main-wrapper">

    @include('components.frontend.header')
	 
    <!-- Page Banner Section Start -->
    @if($privacy)
        <div class="page-banner-section section bg-image"    
            data-bg="{{ asset('uploads/privacy/' . ($privacy->banner_image ?? 'img/bg/breadcrumb-img.webp')) }}"
            style="background-image: url('{{ asset('uploads/privacy/' . ($privacy->banner_image ?? 'img/bg/breadcrumb-img.webp')) }}');">
            
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="page-banner text-center">
                            <h2>{{ $privacy->banner_heading }}</h2>
                            <ul class="page-breadcrumb">
                                <li><a href="{{ route('home.page') }}">Home</a></li>
                                <li>{{ $privacy->banner_heading }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    @if($privacy)
    <div class="privacy-policy-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="privacy-policy-content-sec">
                        {!! $privacy->privacy_policy !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif


        @include('components.frontend.footer')
        
        @include('components.frontend.main-js')

</body>
</html>