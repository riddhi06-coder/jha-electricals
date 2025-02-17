<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
</head>


<body>
<div id="main-wrapper">

        @include('components.frontend.header')
	 


        <!-- Page Banner Section Start -->
        <div class="page-banner-section section bg-image" data-bg="{{ asset('uploads/blogs/' . $blogs->first()->banner_image) }}"
            style="background-image: url('{{ asset('uploads/blogs/' . $blogs->first()->banner_image) }}');">
            <div class="container">
                <div class="row">
                    <div class="col">
                    @php
                        $firstblog = $blogs->first(); 
                    @endphp
                    @if ($firstblog)
                        <div class="page-banner text-center">
                            <h2>{{ $firstblog->banner_heading }}</h2>
                            <ul class="page-breadcrumb">
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>{{ $firstblog->banner_heading }}</li>
                            </ul>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Banner Section End -->

        <div class="blog-grid-area">
        <div class="container">

            <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="single-blog-box">
                <div class="single-blog-thumb">
                    <img src="img/blog/blog-11.png" alt="">
                </div>
                <div class="blog-content">
                    <div class="blog-date-sec">
                    <ul>
                        <li><img src="img/icon/calendar-icon.png" alt="Date Icon">1 Jan 2025</li>
                        <li><img src="img/icon/location-icon.png" alt="Location Icon">Mumbai</li>
                    </ul>
                    </div>
                    <a href="blog-details.html">Lorem ipsum dolor sit, amet consectetur adipisicing</a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing Recusandae repellendus...</p>
                    <div class="blog-service-button-sec">
                    <a href="blog-details.html">Read More <img src="img/icon/up-right-arrow.png" alt=""></a>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="single-blog-box">
                <div class="single-blog-thumb">
                    <img src="img/blog/blog-22.png" alt="">
                </div>
                <div class="blog-content">
                    <div class="blog-date-sec">
                    <ul>
                        <li><img src="img/icon/calendar-icon.png" alt="Date Icon">1 Jan 2025</li>
                        <li><img src="img/icon/location-icon.png" alt="Location Icon">Mumbai</li>
                    </ul>
                    </div>
                    <a href="blog-details.html">Lorem ipsum dolor sit, amet consectetur adipisicing</a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing Recusandae repellendus...</p>
                    <div class="blog-service-button-sec">
                    <a href="blog-details.html">Read More <img src="img/icon/up-right-arrow.png" alt=""></a>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="single-blog-box">
                <div class="single-blog-thumb">
                    <img src="img/blog/blog-33.png" alt="">
                </div>
                <div class="blog-content">
                    <div class="blog-date-sec">
                    <ul>
                        <li><img src="img/icon/calendar-icon.png" alt="Date Icon">1 Jan 2025</li>
                        <li><img src="img/icon/location-icon.png" alt="Location Icon">Mumbai</li>
                    </ul>
                    </div>
                    <a href="blog-details.html">Lorem ipsum dolor sit, amet consectetur adipisicing</a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing Recusandae repellendus...</p>
                    <div class="blog-service-button-sec">
                    <a href="blog-details.html">Read More <img src="img/icon/up-right-arrow.png" alt=""></a>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="single-blog-box">
                <div class="single-blog-thumb">
                    <img src="img/blog/blog-44.png" alt="">
                </div>
                <div class="blog-content">
                    <div class="blog-date-sec">
                    <ul>
                        <li><img src="img/icon/calendar-icon.png" alt="Date Icon">1 Jan 2025</li>
                        <li><img src="img/icon/location-icon.png" alt="Location Icon">Mumbai</li>
                    </ul>
                    </div>
                    <a href="blog-details.html">Lorem ipsum dolor sit, amet consectetur adipisicing</a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing Recusandae repellendus...</p>
                    <div class="blog-service-button-sec">
                    <a href="blog-details.html">Read More <img src="img/icon/up-right-arrow.png" alt=""></a>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="single-blog-box">
                <div class="single-blog-thumb">
                    <img src="img/blog/blog-55.png" alt="">
                </div>
                <div class="blog-content">
                    <div class="blog-date-sec">
                    <ul>
                        <li><img src="img/icon/calendar-icon.png" alt="Date Icon">1 Jan 2025</li>
                        <li><img src="img/icon/location-icon.png" alt="Location Icon">Mumbai</li>
                    </ul>
                    </div>
                    <a href="blog-details.html">Lorem ipsum dolor sit, amet consectetur adipisicing</a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing Recusandae repellendus...</p>
                    <div class="blog-service-button-sec">
                    <a href="blog-details.html">Read More <img src="img/icon/up-right-arrow.png" alt=""></a>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="single-blog-box">
                <div class="single-blog-thumb">
                    <img src="img/blog/blog4.jpg" alt="">
                </div>
                <div class="blog-content">
                    <div class="blog-date-sec">
                    <ul>
                        <li><img src="img/icon/calendar-icon.png" alt="Date Icon">1 Jan 2025</li>
                        <li><img src="img/icon/location-icon.png" alt="Location Icon">Mumbai</li>
                    </ul>
                    </div>
                    <a href="blog-details.html">Lorem ipsum dolor sit, amet consectetur adipisicing</a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing Recusandae repellendus...</p>
                    <div class="blog-service-button-sec">
                    <a href="blog-details.html">Read More <img src="img/icon/up-right-arrow.png" alt=""></a>
                    </div>
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