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
            style="background: url('{{ asset('/uploads/services/' . $installationData->banner_image) }}') no-repeat center center; 
                    background-size: contain; 
                    height: 350px;">

            <div class="container">
                <div class="row">
                <div class="col">
                    <div class="page-banner text-center">
                    <h2>{{ $installationData->banner_heading }}</h2>
                    <ul class="page-breadcrumb">
                        <li><a href="{{ route('home.page') }}">Home</a></li>
                        <li><a href="#">Service & Support</a></li>
                        <li>{{ $installationData->banner_heading }}</li>
                    </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="professional-installation-sec">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="pro-install-image-sec">
                            <img src="{{ asset('uploads/services/' . ($installationData->image ?? 'default-image.webp')) }}" alt="Professional Installation">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="pro-install-content-sec">
                            <p>{!! $installationData->detailed_description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('components.frontend.footer')
        

       
        
        @include('components.frontend.main-js')

</body>
</html>