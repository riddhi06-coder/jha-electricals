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
                  <h4>Edit Wires Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('wire-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Wires details</li>
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
                        <h4>Wires Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('wire-details.update', $details->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Category Dropdown -->
                                    <div class="col-6">
                                        <label class="form-label" for="category_id">Product Category <span class="txt-danger">*</span></label>
                                        <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                            <option value="">Select Product Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $details->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <!-- Subcategory Dropdown -->
                                    <div class="col-6">
                                        <label class="form-label" for="sub_category_id">Product Sub Category <span class="txt-danger">*</span></label>
                                        <!-- Subcategory Dropdown -->
                                        <select class="form-control @error('sub_category_id') is-invalid @enderror" id="sub_category_id" name="sub_category_id" required>
                                            <option value="">Select Sub Category</option>
                                            @if(isset($groupedSubcategories[$details->category_id]))
                                                @foreach($groupedSubcategories[$details->category_id] as $subCategory)
                                                    <option value="{{ $subCategory['id'] }}" 
                                                        {{ old('sub_category_id', $details->sub_category_id) == $subCategory['id'] ? 'selected' : '' }}>
                                                        {{ $subCategory['name'] }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>

                                        @error('sub_category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <!-- Product Dropdown -->
                                    <div class="col-6">
                                        <label class="form-label" for="product_id">Product Name <span class="txt-danger">*</span></label>
                                        <select class="form-control @error('product_id') is-invalid @enderror" id="product_id" name="product_id" required>
                                            <option value="">Select Product</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" {{ old('product_id', $details->product_id) == $product->id ? 'selected' : '' }}>
                                                    {{ $product->product_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('product_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-4"></div>
                                    <h4>Section I</h4>

                                    <!-- Image Upload -->
                                    <div class="col-12">
                                        <label class="form-label" for="product_image">Image <span class="txt-danger">*</span></label>
                                        <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*" onchange="previewImage(this, 'image_preview', 'existing_image')">
                                        
                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                        
                                        @if($details->product_images)
                                            <div class="mt-2">
                                                <img id="existing_image" src="{{ asset('uploads/wire-details/' . $details->product_images) }}" alt="Product Image" width="100">
                                            </div>
                                        @endif

                                        <div id="image_preview" class="mt-2"></div>
                                        <div class="invalid-feedback">Please upload an image.</div>
                                    </div>


                                    <!-- Detailed Description -->
                                    <div class="col-12">
                                        <label class="form-label" for="detailed_description">Detailed Description <span class="txt-danger">*</span></label>
                                        <textarea class="form-control summernote" id="summernote" name="detailed_description" required>{{ old('detailed_description', $details->detailed_description) }}</textarea>
                                        @error('detailed_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-4"></div>
                                    <h4>Section II</h4>

                                    <!-- Background Image Upload -->
                                    <div class="col-12">
                                        <label class="form-label" for="background_image">Background Image <span class="txt-danger">*</span></label>
                                        <input type="file" class="form-control" id="background_image" name="background_image" accept="image/*" onchange="previewbgImage(this, 'image_bg_preview', 'existing_bg_image')" required>
                                        
                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                        <br>
                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                        <div id="image_bg_preview" class="mt-2"></div>

                                        @if($details->background_images)
                                            <div class="mt-2">
                                                <img id="existing_bg_image" src="{{ asset('/uploads/wire-details/' . $details->background_images) }}" alt="Background Image" width="200">
                                            </div>
                                        @endif

                                        <div class="invalid-feedback">Please upload an image.</div>
                                    </div>


                                    <!-- Description -->
                                    <div class="col-12">
                                        <label class="form-label" for="description">Description <span class="txt-danger">*</span></label>
                                        <textarea class="form-control description" id="description" name="description" required>{{ old('description', $details->description) }}</textarea>
                                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-4"></div>
                                    <h4>Section III: Product Data</h4>

                                    @foreach(['approvals', 'voltage_grade', 'conductor', 'conductor_specialty', 'insulation', 'colours', 'marking', 'packing'] as $field)
                                        <div class="col-12">
                                            <label class="form-label" for="{{ $field }}">{{ ucfirst(str_replace('_', ' ', $field)) }} <span class="txt-danger">*</span></label>
                                            <input type="text" class="form-control" id="{{ $field }}" name="{{ $field }}" value="{{ old($field, $details->$field) }}" required>
                                            @error($field) <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    @endforeach

                                    <div class="mb-4"></div>
                                    <h4>Section IV: Brochure Upload</h4>


                                    <!-- Brochure Upload -->
                                    <div class="col-12">
                                        <label class="form-label" for="brochure">Upload Brochure (PDF) <span class="txt-danger">*</span></label>
                                        <input type="file" class="form-control" id="brochure" name="brochure" accept="application/pdf" onchange="previewBrochure(this, 'existing_brochure_preview')" required>
                                        <small class="text-secondary"><b>Note: Only PDF files are allowed (Max: 3MB).</b></small>
                                        <div class="invalid-feedback">Please upload a brochure.</div>
                                    </div>

                                    <!-- Brochure Preview -->
                                    <div class="col-12 mt-3" id="brochure_preview" style="display: none;">
                                        <iframe id="brochure_frame" src="" width="100%" height="500px" style="border: 1px solid #ddd;"></iframe>
                                    </div><br><br>

                                    @if($details->brochures)
                                        <div class="mt-2" id="existing_brochure_preview">
                                            <iframe src="{{ asset('/uploads/wire-details/brochures/' . $details->brochures) }}" width="100%" height="300px"></iframe>
                                        </div>
                                    @endif


                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('wire-details.index') }}" class="btn btn-danger px-4">Cancel</a>
                                        <button class="btn btn-primary" type="submit">Submit</button>
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

<!----for summernote for section II descripton---->
<script>
  $(document).ready(function() {
    $('#description').summernote({
      height: 200, 
      focus: true 
    });
  });
</script>


<!----for Catgeory, sub category and product name fetching---->
<script>
    $(document).ready(function () {
        // Load Subcategories based on Category
        $('#category_id').change(function () {
            var category_id = $(this).val();
            $('#sub_category_id').html('<option value="">Loading...</option>');
            $('#product_id').html('<option value="">Select Product</option>');

            if (category_id) {
                $.ajax({
                    url: "{{ route('get.subcategories') }}",
                    type: "GET",
                    data: { category_id: category_id },
                    success: function (response) {
                        $('#sub_category_id').html('<option value="">Select Sub Category</option>');
                        $.each(response.subcategories, function (key, value) {
                            $('#sub_category_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#sub_category_id').html('<option value="">Select Sub Category</option>');
            }
        });

        // Load Products based on Subcategory
        $('#sub_category_id').change(function () {
            var sub_category_id = $(this).val();
            $('#product_id').html('<option value="">Loading...</option>');

            if (sub_category_id) {
                $.ajax({
                    url: "{{ route('get.products') }}",
                    type: "GET",
                    data: { sub_category_id: sub_category_id },
                    success: function (response) {
                        $('#product_id').html('<option value="">Select Product</option>');
                        $.each(response.products, function (key, value) {
                            $('#product_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#product_id').html('<option value="">Select Product</option>');
            }
        });
    });
</script>


<!----for Section 1 Image preview---->
<script>
    function previewImage(input, previewId, existingImageId) {
        let previewContainer = document.getElementById(previewId);
        let existingImage = document.getElementById(existingImageId);

        if (!previewContainer) return;

        // Remove old preview image
        previewContainer.innerHTML = '';

        // Hide existing image (if present)
        if (existingImage) {
            existingImage.style.display = 'none';
        }

        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                let img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '150px';
                img.style.marginTop = '5px';
                img.style.borderRadius = '5px';
                img.style.border = '1px solid #ddd';
                previewContainer.appendChild(img);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


<script>
    function previewbgImage(input, previewId, existingBgImageId) {
        let previewContainer = document.getElementById(previewId);
        let existingBgImage = document.getElementById(existingBgImageId);

        if (!previewContainer) return;

        previewContainer.innerHTML = ''; // Clear previous preview

        // Hide existing image if present
        if (existingBgImage) {
            existingBgImage.style.display = 'none';
        }

        if (input.files && input.files[0]) {
            let file = input.files[0];

            // Validate file size (less than 2MB)
            let fileSize = file.size / 1024 / 1024; // Convert bytes to MB
            if (fileSize > 2) {
                alert("The file size should be less than 2MB.");
                input.value = ''; // Clear the input
                return;
            }

            let reader = new FileReader();
            reader.onload = function(e) {
                let img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '150px';
                img.style.marginTop = '5px';
                img.style.borderRadius = '5px';
                img.style.border = '1px solid #ddd';
                previewContainer.appendChild(img);
            }
            reader.readAsDataURL(file);
        }
    }
</script>

<!----for Section 4 PDF preview---->
<script>
    function previewBrochure(input, existingBrochureId) {
        var file = input.files[0];

        if (!file) return; // Exit if no file is selected

        var fileSize = file.size / 1024 / 1024; // Convert bytes to MB

        if (file.type !== "application/pdf") {
            alert("Only PDF files are allowed.");
            input.value = ''; // Clear the input
            return;
        }

        if (fileSize > 3) {
            alert("The file size should be less than 3MB.");
            input.value = ''; // Clear the input
            return;
        }

        // Hide existing brochure preview if present
        var existingBrochure = document.getElementById(existingBrochureId);
        if (existingBrochure) {
            existingBrochure.style.display = 'none';
        }

        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('brochure_frame').src = e.target.result;
            document.getElementById('brochure_preview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
</script>

</body>

</html>