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
                  <h4>Add Guide Part B Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('guide-partB.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Details</li>
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
                        <h4>Guide Part B Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('guide-partB.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Section Heading -->
                                    <div class="col-12">
                                        <label class="form-label" for="banner_heading">Section Heading </label>
                                        <input type="text" class="form-control" id="banner_heading" name="banner_heading" placeholder="Enter Section Heading">
                                        <div class="invalid-feedback">Please enter a Section heading.</div>
                                    </div>

                                    <!-- Short Description with Summernote -->
                                    <div class="col-12 mb-5">
                                        <label class="form-label" for="short_description">Short Description </label>
                                        <textarea class="form-control summernote" id="short_description" name="short_description" placeholder="Enter Short Description"></textarea>
                                        <div class="invalid-feedback">Please enter a Short description.</div>
                                    </div><br><br><br><br><br><br>

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

                                    <!-- Title -->
                                    <div class="col-12">
                                        <label class="form-label" for="title">Title <span class="txt-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required>
                                        <div class="invalid-feedback">Please enter a Title.</div>
                                    </div>

                                    <!-- Detailed Description with Summernote -->
                                    <div class="col-12 mb-5">
                                        <label class="form-label" for="detailed_description">Detailed Description <span class="txt-danger">*</span></label>
                                        <textarea class="form-control summernote" id="summernote" name="detailed_description" placeholder="Enter Detailed Description" required></textarea>
                                        <div class="invalid-feedback">Please enter a detailed description.</div>
                                    </div><br><br><br><br><br><br>

                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('guide-partB.index') }}" class="btn btn-danger px-4">Cancel</a>
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

{{-- Summernote Editor --}}
<script>
    $(document).ready(function() {
        $('#short_description').summernote({
            placeholder: 'Enter your description here...',
            tabsize: 2,
            height: 100,
        });
    });
</script>

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




</body>

</html>