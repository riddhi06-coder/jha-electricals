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
      style="background-image: url({{ asset('frontend/assets/img/bg/breadcrumb-img.webp') }});background-position: right;">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="page-banner text-center">
                <h2>{{ $product->category_name }}</h2>  
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home.page') }}">Home</a></li>
                    <li><a href="{{ route('products.category') }}">Products</a></li>
                    <li>
                        <a href="{{ route('product.page', ['slug' => Str::slug($product->category_name)]) }}">
                            {{ $product->category_name }}
                        </a>
                    </li>

                    <li>{{ $product->product_name }}</li>  
                </ul>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- Page Banner Section End -->


    <div class="ledplsr-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="ledplsr-title-sec">
                        <h2>{{ $product->product_name }}</h2>
                    </div>
                </div>

                @php
                    $images = json_decode($product->product_images, true) ?? [];
                @endphp

                <div class="col-lg-8 col-md-8">
                    <div class="ledplsr-product-image-sec">
                        @if (!empty($images[0]))
                            <img src="{{ asset('/uploads/products/' . $images[0]) }}" class="img-fluid" alt="{{ $product->product_name }}">
                        @else
                            <img src="{{ asset('img/banner/102-img.jpg') }}" class="img-fluid" alt="Default Image">
                        @endif
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    @if (!empty($images[1]))
                        <div class="ledplsr-product-image-two-sec">
                            <img src="{{ asset('/uploads/products/' . $images[1]) }}" class="img-fluid" alt="{{ $product->product_name }}">
                        </div>
                    @endif
                    
                    @if (!empty($images[2]))
                        <div class="ledplsr-product-image-three-sec">
                            <img src="{{ asset('/uploads/products/' . $images[2]) }}" class="img-fluid" alt="{{ $product->product_name }}">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="led-panel-light-sq-ron-con-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="lplsrc-title-sec">
                        <h2>{{ $product->section_heading }}</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="active">
                                        <th>Code</th>
                                        <th>Wattage</th>
                                        <th>Outer Size (mm)</th>
                                        <th>MRP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $codes = json_decode($product->product_codes, true) ?? [];
                                        $wattages = json_decode($product->product_wattages, true) ?? [];
                                        $sizes = json_decode($product->product_sizes, true) ?? [];
                                        $mrps = json_decode($product->product_mrps, true) ?? [];
                                    @endphp

                                    @foreach ($codes as $index => $code)
                                        <tr>
                                            <td>{{ $code }}</td>
                                            <td>{{ $wattages[$index] ?? '-' }}</td>
                                            <td>{{ $sizes[$index] ?? '-' }}</td>
                                            <td>₹{{ $mrps[$index] ?? 0 }}/-</td>
                                        </tr>
                                    @endforeach
                                    
                                    @if(empty($codes))
                                        <tr>
                                            <td colspan="4" class="text-center">No specifications available.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <div class="call-to-action-wrap led-cta-sec">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-7">
            <div class="call-to-action-left">
              <h4>For more information, please get in touch with us.</h4>
            </div>
          </div>
          <div class="col-lg-3 col-md-5">
            <div class="call-to-action-right">
              <a class="small-btn-style" href="#" data-bs-toggle="modal" data-bs-target="#contactModal">Enquire Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>



      <!-- Modal -->
      <div class="modal fade bann-modal-sec" id="contactModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bann-modal-header-sec">
                <h5 class="modal-title bann-modal-title-sec" id="modalLabel">Enquiry Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <input type="text" class="form-control" id="name" placeholder="Name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="tel" class="form-control" id="phone" placeholder="Phone Number">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="email" class="form-control" id="email" placeholder="Email">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" id="product" placeholder="Product Name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="number" class="form-control" id="quantity" placeholder="Quantity">
                        </div>
                        <div class="col-md-12 mb-3">
                            <input type="text" class="form-control" id="location" placeholder="Location">
                        </div>
                        <div class="col-md-12 mb-3">
                            <textarea class="form-control" id="message" rows="3" placeholder="Message"></textarea>
                        </div>
                        <div class="col-md-12">
                            <div class="bann-modal-btn-sec">
                                <a href="contact-us.html" class="small-btn-style">Submit</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

        @include('components.frontend.footer')
        
        @include('components.frontend.main-js')


</body>
</html>