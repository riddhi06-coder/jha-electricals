<!doctype html>
<html lang="en">
    
<head>
    @include('components.backend.head')
</head>
	   
		@include('components.backend.header')

	    <!--start sidebar wrapper-->	
	    @include('components.backend.sidebar')
	   <!--end sidebar wrapper-->


        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Edit Range Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('home-range.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Range Details</li>
                </ol>

                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>Range Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('home-range.update', $range->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT') <!-- Ensure PUT method for updating -->

                                    <!-- Heading -->
                                    <div class="col-xxl-4 col-sm-12">
                                        <label class="form-label" for="banner_heading">Section Heading</label>
                                        <input class="form-control" id="banner_heading" type="text" name="banner_heading" placeholder="Enter heading" value="{{ old('banner_heading', $range->banner_heading) }}">
                                        <div class="invalid-feedback">Please enter a Section Heading.</div>
                                    </div>

                                    <!-- Product Name -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="product_name">Product Name <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="product_name" type="text" name="product_name" placeholder="Enter Product Name" required value="{{ old('product_name', $range->product_name) }}">
                                        <div class="invalid-feedback">Please enter a Product Name.</div>
                                    </div>

                                    <!-- Product Price -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="product_price">Product Price <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="product_price" type="text" name="product_price" placeholder="Enter Product Price" required value="{{ old('product_price', $range->product_price) }}">
                                        <div class="invalid-feedback">Please enter a Product Price.</div>
                                    </div>

                                    <!-- Banner Image Upload -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="banner_image">Upload Image <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="banner_image" type="file" name="banner_image" accept="image/*" onchange="previewImage(event)">
                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                        <br>
                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                    </div>

                                    <!-- Image Preview -->
                                    <div class="col-12">
                                        <label class="form-label"></label>
                                        <div>
                                            @if($range->image)
                                                <img id="imagePreview" src="{{ asset('uploads/home/range/' . $range->image) }}" alt="Image Preview" style="max-width: 30%; height: auto; border: 1px solid #ddd; padding: 5px;">
                                            @else
                                                <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 30%; height: auto; display: none; border: 1px solid #ddd; padding: 5px;">
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('home-range.index') }}" class="btn btn-danger px-4">Cancel</a>
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </form>



                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

          </div>
        </div>
        <!-- footer start-->
        @include('components.backend.footer')
        </div>
        </div>


       
       @include('components.backend.main-js')


<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById("imagePreview");

        if (file) {
            const validTypes = ["image/jpeg", "image/png", "image/jpg", "image/webp"];
            
            if (!validTypes.includes(file.type)) {
                alert("Please upload a valid image file (.jpg, .jpeg, .png, .webp).");
                return;
            }
            
            if (file.size > 2 * 1024 * 1024) { // 2MB limit
                alert("The file size should be less than 2MB.");
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = "block";
            };

            reader.readAsDataURL(file);
        } else {
            preview.style.display = "none";
        }
    }
</script>


</body>

</html>