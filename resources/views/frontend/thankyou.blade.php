<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
</head>


<body>
<div id="main-wrapper">

        @include('components.frontend.header')
	 


    <!-- Page Banner Section Start -->
    <div class="page-banner-section section bg-image" data-bg="{{ asset('frontend/assets/img/bg/breadcrumb-img.webp') }}"
      style="background-image: url({{ asset('frontend/assets/img/bg/breadcrumb-img.webp') }});">
      <div class="container">
        <div class="row">
          <div class="col">

            <div class="page-banner text-center">
              <h2>Thank You</h2>
              <ul class="page-breadcrumb">
                <li><a href="{{ route('home.page') }}">Home</a></li>
                <li>Thank You</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="thank-you-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="thank-you-content-sec">
                        <img src="{{ asset('frontend/assets/img/icon/thank-you-sec.png') }}" alt="">
                        <h2>Thank You</h2>
                        <p>For any inquiries or updates, please feel free to contact us.</p>
                        <a href="{{ route('home.page') }}" class="small-btn-style">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('components.frontend.footer')
        
    @include('components.frontend.main-js')

</body>
</html>