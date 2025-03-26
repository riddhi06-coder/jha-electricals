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
                  <h4>Add Wires Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('wire-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Wires details</li>
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
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('wire-details.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Category Dropdown -->
                                    <div class="col-6">
                                        <label class="form-label" for="category_id">Product Category <span class="txt-danger">*</span></label>
                                        <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                            <option value="">Select Product Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Subcategory Dropdown -->
                                    <div class="col-6">
                                        <label class="form-label" for="sub_category_id">Product Sub Category <span class="txt-danger">*</span></label>
                                        <select class="form-control @error('sub_category_id') is-invalid @enderror" id="sub_category_id" name="sub_category_id" required>
                                            <option value="">Select Sub Category</option>
                                        </select>
                                        @error('sub_category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Product Dropdown -->
                                    <div class="col-6">
                                        <label class="form-label" for="product_id">Product Name <span class="txt-danger">*</span></label>
                                        <select class="form-control @error('product_id') is-invalid @enderror" id="product_id" name="product_id" required>
                                            <option value="">Select Product</option>
                                        </select>
                                        @error('product_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="mb-4"></div>
                                    <h4>Section I</h4>
                                      <!-- Image Upload -->
                                      <div class="col-12">
                                        <label class="form-label" for="product_image">Image <span class="txt-danger">*</span></label>
                                        <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*" onchange="previewImage(this, 'image_preview')" required>
                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                        <br>
                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                        <div id="image_preview" class="mt-2"></div>
                                        <div class="invalid-feedback">Please upload an image.</div>
                                    </div>

                                    <!-- Detailed Description with Summernote -->
                                    <div class="col-12">
                                        <label class="form-label" for="detailed_description">Detailed Description <span class="txt-danger">*</span></label>
                                        <textarea class="form-control summernote" id="summernote" name="detailed_description" placeholder="Enter Detailed Description" required></textarea>
                                        <div class="invalid-feedback">Please enter a detailed description.</div>
                                    </div>


                                    <div class="mb-4"></div>
                                    <h4>Section II</h4>
                                    <!-- Image Upload -->
                                    <div class="col-12">
                                        <label class="form-label" for="background_image">Background Image <span class="txt-danger">*</span></label>
                                        <input type="file" class="form-control" id="background_image" name="background_image" accept="image/*" onchange="previewbgImage(this, 'image_bg_preview')" required>
                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                        <br>
                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                        <div id="image_bg_preview" class="mt-2"></div>
                                        <div class="invalid-feedback">Please upload an image.</div>
                                    </div>

                                    <!-- Description with Summernote -->
                                    <div class="col-12">
                                        <label class="form-label" for="description">Description <span class="txt-danger">*</span></label>
                                        <textarea class="form-control description" id="description" name="description" placeholder="Enter Description" required></textarea>
                                        <div class="invalid-feedback">Please enter a description.</div>
                                    </div>


                           
                                    <div class="mb-4"></div>
                                    <h4>Section III: Product Data</h4>

                                    <!-- Approvals -->
                                    <div class="col-12">
                                        <label class="form-label" for="approvals">Approvals </label>
                                        <input type="text" class="form-control" id="approvals" name="approvals" >
                                        <div class="invalid-feedback">Please enter approvals.</div>
                                    </div>

                                    <!-- Voltage Grade -->
                                    <div class="col-12">
                                        <label class="form-label" for="voltage_grade">Voltage Grade </label>
                                        <input type="text" class="form-control" id="voltage_grade" name="voltage_grade">
                                        <div class="invalid-feedback">Please enter voltage grade.</div>
                                    </div>

                                    <!-- Conductor -->
                                    <div class="col-12">
                                        <label class="form-label" for="conductor">Conductor </label>
                                        <textarea class="form-control" id="conductor" name="conductor"></textarea>
                                        <div class="invalid-feedback">Please enter conductor details.</div>
                                    </div>

                                    <!-- Conductor Specialty -->
                                    <div class="col-12">
                                        <label class="form-label" for="conductor_specialty">Conductor Specialty </label>
                                        <input type="text" class="form-control" id="conductor_specialty" name="conductor_specialty">
                                        <div class="invalid-feedback">Please enter conductor specialty.</div>
                                    </div>

                                    <!-- Insulation -->
                                    <div class="col-12">
                                        <label class="form-label" for="insulation">Insulation </label>
                                        <input type="text" class="form-control" id="insulation" name="insulation">
                                        <div class="invalid-feedback">Please enter insulation type.</div>
                                    </div>

                                    <!-- Colours -->
                                    <div class="col-12">
                                        <label class="form-label" for="colours">Colours </label>
                                        <input type="text" class="form-control" id="colours" name="colours">
                                        <div class="invalid-feedback">Please enter available colours.</div>
                                    </div>

                                    <!-- Marking -->
                                    <div class="col-12">
                                        <label class="form-label" for="marking">Marking </label>
                                        <textarea class="form-control" id="marking" name="marking"></textarea>
                                        <div class="invalid-feedback">Please enter marking details.</div>
                                    </div>

                                    <!-- Packing -->
                                    <div class="col-12">
                                        <label class="form-label" for="packing">Packing </label>
                                        <input type="text" class="form-control" id="packing" name="packing">
                                        <div class="invalid-feedback">Please enter packing details.</div>
                                    </div>


                                    <div class="mb-4"></div>
                                    <h4>Section IV: Brochure Upload</h4>

                                    <!-- Brochure Upload -->
                                    <div class="col-12">
                                        <label class="form-label" for="brochure">Upload Brochure (PDF) </label>
                                        <input type="file" class="form-control" id="brochure" name="brochure" accept="application/pdf" onchange="previewBrochure(this)">
                                        <small class="text-secondary"><b>Note: Only PDF files are allowed (Max: 3MB).</b></small>
                                        <div class="invalid-feedback">Please upload a brochure.</div>
                                    </div>

                                    <!-- Brochure Preview -->
                                    <div class="col-12 mt-3" id="brochure_preview" style="display: none;">
                                        <iframe id="brochure_frame" src="" width="100%" height="500px" style="border: 1px solid #ddd;"></iframe>
                                    </div>
                               
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
<!-- <script>
  $(document).ready(function() {
    $('#description').summernote({
      height: 200, 
      focus: true 
    });
  });
</script> -->


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
    function previewImage(input, previewId) {
        let previewContainer = document.getElementById(previewId);
        if (!previewContainer) return;

        previewContainer.innerHTML = '';

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
    function previewbgImage(input, previewId) {
        let previewContainer = document.getElementById(previewId);
        if (!previewContainer) return;

        previewContainer.innerHTML = ''; // Clear previous image

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
    function previewBrochure(input) {
        var file = input.files[0];
        var fileSize = file.size / 1024 / 1024; 

        if (file && file.type === "application/pdf") {
            if (fileSize > 3) {
                alert("The file size should be less than 3MB.");
                input.value = ''; 
                return;
            }
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('brochure_frame').src = e.target.result;
                document.getElementById('brochure_preview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            alert("Only PDF files are allowed.");
            input.value = ''; 
        }
    }
</script>

</body>

</html>