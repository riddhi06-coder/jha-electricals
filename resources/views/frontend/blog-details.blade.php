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
        data-bg="{{ asset('uploads/blogs/' . ($blog_head->isNotEmpty() ? $blog_head->first()->banner_image : 'default-banner.jpg')) }}"
        style="background-image: url('{{ asset('uploads/blog_head/' . ($blog_head->isNotEmpty() ? $blog_head->first()->banner_image : 'default-banner.jpg')) }}');">
    <div class="container">
        <div class="row">
        <div class="col">
            @php
            $firstblog = $blog_head->isNotEmpty() ? $blog_head->first() : null;
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



    <div class="blog-details-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @foreach($blogs as $blog)
                        <div class="blog-details-thumb">
                            <img src="{{ asset('uploads/blogs/' . $blog->image) }}" alt="Banner Image" style="max-width: 100%; height: auto;">
                        </div>
                        <div class="blog-details-content">
                            <p class="blog-details-desc">{!! $blog->description !!}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>




        @include('components.frontend.footer')
        
        @include('components.frontend.main-js')


</body>
</html>