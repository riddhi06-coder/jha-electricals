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
                                <li><a href="{{ route('home.page') }}">Home</a></li>
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
                    @foreach ($blogs as $blog)
                        <div class="col-lg-4 col-md-4">
                            <div class="single-blog-box">
                                <div class="single-blog-thumb">
                                    <img src="{{ asset('uploads/blogs/' . $blog->thumbnail) }}" alt="{{ $blog->blog_heading }}">
                                </div>
                                <div class="blog-content">
                                    <div class="blog-date-sec">
                                        <ul>
                                            <li>
                                                <img src="{{ asset('frontend/assets/img/icon/calendar-icon.png') }}" alt="Date Icon">
                                                {{ \Carbon\Carbon::parse($blog->date)->format('d M Y') }}
                                            </li>
                                            <li>
                                                <img src="{{ asset('frontend/assets/img/icon/location-icon.png') }}" alt="Location Icon">
                                                {{ $blog->location }}
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="{{ route('blog.details', $blog->slug) }}">{{ $blog->blog_heading }}</a>
                                    <p>{{ $blog->short_description }}</p>
                                    <div class="blog-service-button-sec">
                                        <a href="{{ route('blog.details', $blog->slug) }}">Read More <img src="{{ asset('frontend/assets/img/icon/up-right-arrow.png') }}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


        @include('components.frontend.footer')
        
        @include('components.frontend.main-js')


</body>
</html>