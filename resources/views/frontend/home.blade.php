<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
</head>


<body>
<div id="main-wrapper">

        @include('components.frontend.header')
	       
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif 
     
    <!--slider section start-->
    <div class="hero-section section position-relative">
        <div class="tf-element-carousel slider-nav" data-slick-options='{
            "slidesToShow": 1,
            "slidesToScroll": 1,
            "infinite": true,
            "arrows": false,
            "dots": true,
            "autoplay": true
        }' data-slick-responsive='[
            {"breakpoint":768, "settings": {"slidesToShow": 1}},
            {"breakpoint":575, "settings": {"slidesToShow": 1}}
        ]'>

        @foreach ($banners as $index => $banner)
        <!-- Hero Item start -->
        <div class="hero-item bg-image" data-bg="{{ asset('uploads/home/banner/' . $banner->banner_image) }}">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Hero Content start -->
                        @php
                            // Define which banners should be left-aligned (1, 2, 3, and 5)
                            $leftAlignedIndexes = [0, 1, 2, 4]; // Since index starts from 0
                            $position = in_array($index, $leftAlignedIndexes) ? 'left' : 'right';

                            // Formatting the title with line breaks
                            $words = explode(' ', e($banner->banner_title));
                            $formattedTitle = '';

                            foreach ($words as $i => $word) {
                                $formattedTitle .= $word . ' ';
                                if (($i + 1) % 2 == 0 || count($words) == 2) {
                                    $formattedTitle .= '<br>';
                                }
                            }
                        @endphp

                        <div class="hero-content-2 {{ $position }} pt-sm-0 pt-xs-0">
                            <h3>{{ $banner->banner_heading }}</h3>
                            <h1>{!! trim($formattedTitle) !!}</h1>
                            <a class="small-btn-style" href="#">shop now</a>
                        </div>
                        <!-- Hero Content end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Item end -->
        @endforeach

        </div>
    </div>

    <!--slider section end-->
    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-img-wrap wow fadeInLeft animated" data-wow-delay="400ms" data-wow-duration="400ms">
                    <div class="about-img-top">
                        @php
                            $images = json_decode($homeAbout->images ?? '[]');
                        @endphp
                        @if(!empty($images) && isset($images[0]))
                            <img src="{{ asset('uploads/home/about/' . $images[0]) }}" alt="About Us Image 1" width="442" height="347">
                        @endif
                    </div>

                    <div class="about-img-bottom">
                        @if(!empty($images) && isset($images[1]))
                            <img class="img-fluid" src="{{ asset('uploads/home/about/' . $images[1]) }}" alt="About Us Image 2" width="330" height="313">
                        @endif
                    </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-text wow fadeInRight animated" data-wow-delay="400ms" data-wow-duration="400ms">
                        <h2>{{ $homeAbout->heading }}</h2>
                        <p>{!! $homeAbout->description !!}</p>

                        @php
                            $values = json_decode($homeAbout->value);
                            $descriptions = json_decode($homeAbout->value_description);
                        @endphp

                        <div class="row">
                            @foreach($values as $index => $value)
                            <div class="col-sm-6">
                                <div class="about-features">
                                    <h3>{{ $value }}</h3>
                                    <p>{{ $descriptions[$index] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <a href="about-us.html" class="small-btn-style">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="foundert_sec">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="foundert_text">
                        <div class="section-title mb-30 pt-20 wow fadeInDown animated" data-wow-delay="400ms" data-wow-duration="400ms">
                        @php
                            $titleParts = explode(' ', $homeFounder->title);
                            $firstTwoWords = implode(' ', array_splice($titleParts, 0, 2));
                            $remainingWords = implode(' ', $titleParts);
                        @endphp

                        <h2>{{ $firstTwoWords }} <span>{{ $remainingWords }}</span></h2>

                        </div>

                        @if($homeFounder)
                            <p>{!! $homeFounder->description !!}</p>
                        @endif
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="foundert_img">
                        @php
                            $founderImage = $homeFounder->image ;
                        @endphp
                        <img src="{{ asset('uploads/home/founder/' . $founderImage) }}" 
                            width="266" height="464" class="img-fluid" alt="Founder Image">
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!--Product section start-->
    <div class="product-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-title text-center mb-40 wow fadeInDown animated" data-wow-delay="400ms" data-wow-duration="400ms">
                        <h2><span>Explore</span> Our Range</h2>
                    </div>
                </div>
            </div>
            <div class="product-slider tf-element-carousel normal-nav" data-slick-options='{
                "slidesToShow": 4,
                "slidesToScroll": 1,
                "infinite": true,
                "rows": 1,
                "autoplay": true,
                "arrows": true,
                "prevArrow": {"buttonClass": "slick-btn slick-prev", "iconClass": "fa fa-angle-left" },
                "nextArrow": {"buttonClass": "slick-btn slick-next", "iconClass": "fa fa-angle-right" }
                }' data-slick-responsive='[
                {"breakpoint":1199, "settings": {
                "slidesToShow": 3
                }},
                {"breakpoint":992, "settings": {
                "slidesToShow": 2
                }},
                {"breakpoint":768, "settings": {
                "slidesToShow": 2
                }},
                {"breakpoint":576, "settings": {
                "slidesToShow": 1,
                "arrows": false,
                "autoplay": true
                }}
                ]'>
                @foreach ($homeRange as $range)
                    <div class="col">
                        <!--  Single Grid product Start -->
                        <div class="single-grid-product mb-40">
                            <div class="product-image">
                                <a href="#">
                                    <img src="{{ asset('/uploads/home/range/' . $range->image) }}" class="img-fluid" alt="{{ $range->product_name }}" width="266" height="355" loading="lazy">
                                </a>
                                <div class="product-action d-flex justify-content-between">
                                    <a class="product-btn" href="#">Know More</a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3 class="title">
                                    <a href="#">{{ $range->product_name }}</a>
                                </h3>
                                <p class="product-price">Starting from <span class="discounted-price">{{ $range->product_price }}</span></p>
                            </div>
                        </div>
                        <!--  Single Grid product End -->
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="feature-section feature-section-2">
        <div class="container">
            <div class="row">
                @foreach ($homeQualities as $quality)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <!-- Single Feature Start -->
                        <div class="single-feature">
                            <div class="feature-image">
                                <img src="{{ asset('uploads/home/quality-icons/' . $quality->quality_icon) }}" class="img-fluid" alt="{{ $quality->quality }}" width="60" height="60" loading="lazy">
                            </div>
                            <div class="feature-content">
                                <h4 class="title">{{ $quality->quality }}</h4>
                            </div>
                        </div>
                        <!-- Single Feature End -->
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- start of cta-banner-section -->
    <section class="cta-banner-section separator-padding">
        <div class="container">
            <div class="cta-banner-wrap wow fadeInUp animated" data-wow-delay="400ms" data-wow-duration="400ms">
                <div class="row">
                    <div class="col-lg-3 col-md-5">
                        <div class="cta-banner-img">
                            @if ($homeContact && $homeContact->image)
                                <img src="{{ asset('uploads/home/contact/' . $homeContact->image) }}" alt="{{ $homeContact->title }}" width="200" height="275" loading="lazy">
                            @else
                                <img src="img/quote_bg.webp" alt="LED Track Light (Linear Type) Image" width="200" height="275" loading="lazy">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-6">
                        <div class="cta-banner-text">
                            <h3>{{ $homeContact->title }}</h3>
                            <h5>{{ $homeContact->heading }}</h5>
                            <a href="{{ route('contact.us') }}" class="small-btn-style">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of cta-banner-section -->


    <!-- Testimonial Area Start -->
    <div class="testimonial-section section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-title text-center mb-30 wow fadeInDown animated" data-wow-delay="400ms" data-wow-duration="400ms">
                        @php
                            $firstTestimonial = $homeTestimonials->first(); 
                            $titleParts = explode(' ', $firstTestimonial->title);
                            $firstTwoWords = implode(' ', array_splice($titleParts, 0, 2));
                            $remainingWords = implode(' ', $titleParts);
                        @endphp

                        <h2>{{ $firstTwoWords }} <span>{{ $remainingWords }}</span></h2>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="testimonial-wrap">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="testimonial-wrapper section-space--inner">
                                    <div class="tf-element-carousel" data-slick-options='{
                                        "slidesToShow": 1,
                                        "slidesToScroll": 1,
                                        "infinite": true,
                                        "autoplay": true,
                                        "arrows": false,
                                        "dots": true
                                    }' data-slick-responsive='[
                                        {"breakpoint":768, "settings": {
                                            "slidesToShow": 1
                                        }},
                                        {"breakpoint":575, "settings": {
                                            "slidesToShow": 1
                                        }}
                                    ]'>
                                        @foreach ($homeTestimonials as $testimonial)
                                        
                                        <div class="item">
                                            <div class="single-testimonial-item">
                                                <div class="testimonial-image">
                                                    <img src="{{ asset('uploads/testimonials/' . $testimonial->image) }}" class="img-fluid" alt="{{ $testimonial->name }}" width="70" height="70" loading="lazy">
                                                </div>
                                                <div class="testimonial-content">
                                                    {!! $testimonial->message !!}
                                                    <img src="{{ asset('frontend/assets/img/icon/quote-icon.webp') }}" alt="Quote Icon" width="29" height="20" loading="lazy">
                                                    <p class="testimonial-author">{{ $testimonial->name }}</p>
                                                    <span class="post">Customer</span>
                                                </div>
                                            </div>
                                            <!-- single testimonial item End-->
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial Area End -->


    <!-- Blog section start -->
    <div class="blog-section">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="col">
                <div class="section-title mb-40 wow fadeInDown animated" data-wow-delay="400ms" data-wow-duration="400ms">
                    @if($homeBlogs->isNotEmpty())
                        @php
                            $firstBlog = $homeBlogs->sortBy('inserted_at')->first();  // Sort blogs and get the first one
                            $titleParts = explode(' ', $firstBlog->title);  // Split the blog title into words
                            $firstWord = $titleParts[0] ?? '';  // Get the first word
                            $secondWord = $titleParts[1] ?? '';  // Get the second word (if exists)
                            $remainingWords = implode(' ', array_slice($titleParts, 2));  // Get the remaining words after the first two
                        @endphp

                        <h2>{{ $firstWord }} <span>{{ $secondWord }}</span> {{ $remainingWords }}</h2>

                    @else
                        <h2>Latest <span>Blogs</span></h2>
                    @endif
                </div>

                </div>
                <!-- Section Title End -->
            </div>

            <div class="blog-slider tf-element-carousel" data-slick-options='{
                "slidesToShow": 3,
                "slidesToScroll": 1,
                "infinite": true,
                "autoplay": true,
                "autoplayTimeout": 2000,
                "arrows": true,
                "dots": false,
                "prevArrow": {"buttonClass": "slick-btn slick-prev", "iconClass": "fa fa-angle-left" },
                "nextArrow": {"buttonClass": "slick-btn slick-next", "iconClass": "fa fa-angle-right" }
            }' data-slick-responsive='[
                {"breakpoint":1199, "settings": {"slidesToShow": 3}},
                {"breakpoint":992, "settings": {"slidesToShow": 2}},
                {"breakpoint":768, "settings": {"slidesToShow": 2}},
                {"breakpoint":575, "settings": {"slidesToShow": 1, "arrows": false, "autoplay": true}}
            ]'>
                <!-- Loop through blogs -->
                @foreach ($homeBlogs as $blog)
                    <div class="blog col">
                        <div class="blog-inner">
                            <div class="media">
                                <a href="#" class="image">
                                    <!-- Use the dynamic image path -->
                                    <img src="{{ asset('uploads/home/blogs/' . $blog->image) }}" alt="Blog Image" width="364" height="265" class="img-fluid" loading="lazy">
                                </a>
                            </div>
                            <div class="content">
                                <h3 class="title">
                                    <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}">{{ $blog->blog_heading }}</a>
                                </h3>
                                <ul class="meta">
                                    <li>By <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}" tabindex="0">{{ $blog->blog_author }}</a></li>
                                    <li>{{ \Carbon\Carbon::parse($blog->blog_date)->format('d M Y') }}</li>
                                </ul>
                                <a class="small-btn-style" href="{{ route('blog.details', ['slug' => $blog->slug]) }}">Read more</a>
                            </div>

                        </div>
                    </div>
                @endforeach

                <!-- End Loop -->
            </div>
        </div>
    </div>
    <!-- Blog section end -->




      <!--NewsLetter section start-->
      <div class="newsLetter-section">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="newsletter-wrapper">
                <h3 class="title">Special Offers For Subscribers</h3>
                <p class="short-desc">Subscribe to our newsletters now and stay up to date with new
                  collections, the latest lookbooks and exclusive offers.
                </p>
                <div class="newsletter-form">
                <form id="mc-form" class="mc-form" action="{{ route('subscribe') }}" method="POST">
                    @csrf
                    <input type="email" name="email" placeholder="Enter Your Email Address Here..." required value="{{ old('email') }}">
                    <button type="submit">SUBSCRIBE!</button>
                    
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </form>



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