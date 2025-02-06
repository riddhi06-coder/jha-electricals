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
                  <h4>Add Why Choose Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('who-we-are.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Why Choose</li>
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
                        <h4>Why Choose Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('who-we-are.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="col-12">
                                        <h4><strong>Banner Section</strong></h4>
                                    </div>

                                    <!-- Banner Image -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="banner_image">Banner Image <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="banner_image" type="file" name="banner_image" accept=".jpg, .jpeg, .png, .webp" onchange="previewImage(this, '#banner_image_preview')" required>
                                        <div class="invalid-feedback">Please upload a Banner Image.</div>
                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                        <br>
                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                        <div id="banner_image_preview" class="mt-2"></div>
                                    </div>

                                    <!-- Banner Title -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="banner_title">Banner Title <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="banner_title" type="text" name="banner_title" placeholder="Enter Banner Title" required>
                                        <div class="invalid-feedback">Please enter a Banner Title.</div>
                                    </div>

                                    <!-- Second Section for Image, Short Description, Icon, and Textarea -->
                                    <div class="col-12" style="margin-top: 7.5rem !important; margin-bottom: 1rem;">
                                        <h4><strong>Who We Are Section</strong></h4>
                                    </div>


                                    <!-- Image -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="image">Image <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="image" type="file" name="image" accept=".jpg, .jpeg, .png, .webp" onchange="previewImage(this, '#image_preview')" required>
                                        <div class="invalid-feedback">Please upload an Image.</div>
                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                        <br>
                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                        <div id="image_preview" class="mt-2"></div>
                                    </div>

                                 
                                    <!-- Icon -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="icon">Icon <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="icon" type="file" name="icon" accept=".jpg, .jpeg, .png, .webp" onchange="previewIcon(this)" required>
                                        <div class="invalid-feedback">Please enter an Icon.</div>
                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                        <br>
                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                        <div id="icon_preview" class="mt-2"></div>
                                    </div>


                                    <!-- Short Description -->
                                    <div class="col-xxl-4 col-sm-12">
                                        <label class="form-label" for="short_description">Short Description <span class="txt-danger">*</span></label>
                                        <textarea class="form-control" id="short_description" name="short_description" placeholder="Enter Short Description" rows="3" required></textarea>
                                        <div class="invalid-feedback">Please enter a Short Description.</div>
                                    </div>



                                    <!-- Description (Summernote) -->
                                    <div class="col-xxl-4 col-sm-12">
                                        <label class="form-label" for="summernote">Description <span class="txt-danger">*</span></label>
                                        <textarea class="form-control" id="summernote" name="description" placeholder="Enter Description" required></textarea>
                                        <div class="invalid-feedback">Please enter a Description.</div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('who-we-are.index') }}" class="btn btn-danger px-4">Cancel</a>
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

<script>
    // Function to preview images
    function previewImage(input, previewElementId) {
        const file = input.files[0];
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const previewContainer = document.querySelector(previewElementId);
            previewContainer.innerHTML = `<img src="${e.target.result}" alt="Image Preview" class="img-fluid" style="max-width: 100%; height: auto;">`;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    function previewIcon(input) {
        const file = input.files[0];  // Get the file input
        const previewContainer = document.querySelector('#icon_preview');

        // Clear previous preview
        previewContainer.innerHTML = '';

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;  // Set the source to the file data
                imgElement.style.width = '50px';   // Adjust icon size
                imgElement.style.height = '50px';
                previewContainer.appendChild(imgElement);
            };

            reader.readAsDataURL(file);  // Read the uploaded file as a data URL
        }
    }

</script>

</body>

</html>