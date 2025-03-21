<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
</head>


<body>
<div id="main-wrapper">

        @include('components.frontend.header')
	 

       <!-- Page Banner Section Start -->
        <div class="page-banner-section section bg-image" data-bg="{{ asset('frontend/assets/img/bg/breadcrumb-img.webp') }}" style="background-image: url({{ asset('frontend/assets/img/bg/breadcrumb-img.webp') }});">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="page-banner text-center">
                            <h2>{{ $category->sub_category_name }}</h2>
                            <ul class="page-breadcrumb">
                                <li><a href="{{ route('home.page') }}">Home</a></li>
                                <li><a href="{{ route('products.category') }}">Products</a></li>
                                <li>{{ $category->sub_category_name }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Banner Section End -->

        <!-- Product Listing Section -->
        <section class="product-listing-sec">
            <div class="container">
                <div class="row align-items-center">
                    @foreach($products as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="product-list-single-grid-sec mb-30">
                                <div class="product-image">
                                    <a href="{{ route('product-details', $product->slug) }}">
                                        <img src="{{ asset('uploads/products/' . $product->image) }}" class="img-fluid" alt="{{ $product->product_name }}">
                                    </a>
                                    <div class="product-action d-flex justify-content-between">
                                        <a class="product-btn" href="{{ route('product-details', $product->slug) }}">Know More</a>
                                    </div>
                                </div>
                                <div class="product-list-content-sec">
                                    <h3 class="title">
                                        <a href="{{ route('product-details', $product->slug) }}">{{ $product->product_name }}</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>
        </section>




        @include('components.frontend.footer')
        
        @include('components.frontend.main-js')

</body>
</html>