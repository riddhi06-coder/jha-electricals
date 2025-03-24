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
                        <h2>{{ $product->product_name ?? $specialDetails->product_name ?? 'Product Name' }}</h2>
                        <ul class="page-breadcrumb">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('/products') }}">Products</a></li>
                            @if(!empty($product->sub_category_name) || !empty($specialDetails->sub_category_name))
                                <li><a href="#">{{ $product->sub_category_name ?? $specialDetails->sub_category_name }}</a></li>
                            @endif
                            <li>{{ $product->product_name ?? $specialDetails->product_name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="hdfr-unilay-wires-one-sec">
      <div class="container">
        <div class="row align-items-center">
        <div class="col-lg-6">
            <div class="hdfr-unilay-wires-img-sec">
                <img src="{{ asset('/uploads/wire-details/' . ($specialDetails->product_images ?? 'default.jpg')) }}" alt="Product Image">
            </div>
        </div>
            <div class="col-lg-6">
                <div class="hdfr-unilay-wires-listing-sec">
                    {!! $specialDetails->detailed_description ?? '<p>No description available.</p>' !!}
                </div>
            </div>

        </div>
      </div>
    </div>
    
    
    <!--========-->
    <div class="wires-two-sec" style="background-image: url('{{ asset('/uploads/wire-details/' . ($specialDetails->background_images ?? 'default-bg.jpg')) }}'); background-size: cover; background-position: center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wires-two-sec-title-sec">
                        {!! $specialDetails->description ?? '<p>No description available.</p>' !!} 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--========-->

    <!-- === -->
    <div class="hdfr-unilay-wires-sq-ron-con-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hdfr-unilay-wires-title-sec">
                        <h2>Product Data</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="hdfr-unilay-wires-panel">
                        <div class="panel-body table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td><strong>Approvals</strong></td>
                                        <td>{{ $specialDetails->approvals ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Voltage Grade</strong></td>
                                        <td>{{ $specialDetails->voltage_grade ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Conductor</strong></td>
                                        <td>{{ $specialDetails->conductor ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Conductor Specialty</strong></td>
                                        <td>{{ $specialDetails->conductor_specialty ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Insulation</strong></td>
                                        <td>{{ $specialDetails->insulation ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Colours</strong></td>
                                        <td>{{ $specialDetails->colours ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Marking</strong></td>
                                        <td>{{ $specialDetails->marking ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Packing</strong></td>
                                        <td>{{ $specialDetails->packing ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="hdfr-unilay-wires-btn-sec cta-banner-section">
                        @if (!empty($specialDetails->brochures))
                            <a href="{{ asset('/uploads/wire-details/brochures/' . $specialDetails->brochures) }}" 
                            class="small-btn-style" target="_blank" download>
                                Download Brochure
                            </a>
                        @else
                            <p>No brochure available.</p>
                        @endif
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