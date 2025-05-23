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

        <!-- Page Banner Section Start -->
        <div class="page-banner-section section bg-image" data-bg="{{ asset('frontend/assets/img/bg/breadcrumb-img.webp') }}"
        style="background-image: url({{ asset('frontend/assets/img/bg/breadcrumb-img.webp') }});background-position: right;">
        <div class="container">
            <div class="row">
            <div class="col">
                <div class="page-banner text-center">
                    <h2>{{ $product->sub_category_name }}</h2>  
                    <ul class="page-breadcrumb">
                        <li><a href="{{ route('home.page') }}">Home</a></li>
                        <li><a href="{{ route('products.category') }}">Products</a></li>
                        <li>
                            <a href="#">
                                {{ $product->category_name }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('product.page', ['slug' => Str::slug($product->sub_category_name)]) }}">
                                {{ $product->sub_category_name }}
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
                                        @if (!empty($product->product_header) && is_array($product->product_header))
                                            @foreach ($product->product_header as $header)
                                                <th>{{ $header }}</th>
                                            @endforeach
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $headers  = $product->product_header ?? [];
                                        $rowCount = count(json_decode($product->product_codes, true) ?? []);

                                        // Combine all rows based on index
                                        $rows = [];
                                        for ($i = 0; $i < $rowCount; $i++) {
                                            $rows[] = [
                                                json_decode($product->product_codes, true)[$i] ?? '',
                                                json_decode($product->product_wattages, true)[$i] ?? '',
                                                json_decode($product->product_sizes, true)[$i] ?? '',
                                                json_decode($product->product_mrps, true)[$i] ?? '',
                                            ];
                                        }
                                    @endphp

                                    @forelse ($rows as $row)
                                        <tr>
                                            @for ($i = 0; $i < count($headers); $i++)
                                                <td>{{ $row[$i] ?? '-' }}</td>
                                            @endfor
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ count($headers) }}" class="text-center">No specifications available.</td>
                                        </tr>
                                    @endforelse
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

           

                <form action="{{ route('enquiry.submit') }}" method="POST">
                  @csrf
                  <div class="row">
                      <!-- Name -->
                      <div class="col-md-12 mb-3">
                          <input type="text" class="form-control" name="name" placeholder="Name *" required value="{{ old('name') }}" pattern="^[a-zA-Z\s]+$" title="Only letters and spaces are allowed.">
                          @error('name')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>

                      <!-- Phone -->
                      <div class="col-md-6 mb-3">
                          <input type="tel" class="form-control" name="phone" placeholder="Phone Number *" required minlength="10" maxlength="12" value="{{ old('phone') }}">
                          @error('phone')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>

                      <!-- Email -->
                      <div class="col-md-6 mb-3">
                          <input type="email" class="form-control" name="email" placeholder="Email *" required value="{{ old('email') }}">
                          @error('email')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>

                      <!-- Product -->
                      <div class="col-md-6 mb-3">
                          <input type="text" class="form-control" name="product" placeholder="Product Name *" required value="{{ old('product') }}">
                          @error('product')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>

                      <!-- Quantity -->
                      <div class="col-md-6 mb-3">
                          <input type="number" class="form-control" name="quantity" placeholder="Quantity *" required min="1" value="{{ old('quantity') }}">
                          @error('quantity')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>

                      <!-- Location -->
                      <div class="col-md-12 mb-3">
                          <input type="text" class="form-control" name="location" placeholder="Location *" required value="{{ old('location') }}">
                          @error('location')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>

                      <!-- Message -->
                      <div class="col-md-12 mb-3">
                          <textarea class="form-control" name="message" rows="3" placeholder="Message *">{{ old('message') }}</textarea>
                          @error('message')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>

                      <!-- Submit Button -->
                      <div class="col-md-12 text-center">
                            <button type="submit" class="small-btn-style">Submit</button>
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