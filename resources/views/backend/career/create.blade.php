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
                  <h4>Add Jobs Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('career.index') }}">Home</a>
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
                        <h4>Jobs Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('career.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Banner Heading -->
                                    <div class="col-12">
                                        <label class="form-label" for="banner_heading">Banner Heading </label>
                                        <input type="text" class="form-control" id="banner_heading" name="banner_heading" placeholder="Enter Banner Heading">
                                        <div class="invalid-feedback">Please enter a Banner heading.</div>
                                    </div>

                                    <!-- Banner Image Upload -->
                                    <div class="col-12">
                                        <label class="form-label" for="product_image"> Banner Image </label>
                                        <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*" onchange="previewImage(this, 'image_preview')">
                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                        <br>
                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                        <div id="image_preview" class="mt-2"></div>
                                        <div class="invalid-feedback">Please upload an Banner image.</div>
                                    </div>

                                    <!-- Title -->
                                    <div class="col-12">
                                        <label class="form-label" for="title">Title </label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
                                        <div class="invalid-feedback">Please enter a Title.</div><br><br><br>
                                    </div>


                                    <h3>Job Details</h3>

                                    <!-- Job role -->
                                    <div class="col-12">
                                        <label class="form-label" for="role">Job role <span class="txt-danger">*</span></label>
                                        <input type="text" class="form-control" id="role" name="role" placeholder="Enter role" required>
                                        <div class="invalid-feedback">Please enter a role.</div>
                                    </div>


                                   <!-- Company Overview -->
                                    <div class="col-12">
                                        <label class="form-label" for="company_interview">Company Overview <span class="txt-danger">*</span></label>
                                        <textarea class="form-control" id="company_interview" name="company_interview" placeholder="Enter Company Overview" rows="4" required></textarea>
                                        <div class="invalid-feedback">Please enter a Company Overview.</div>
                                    </div>


                                    <!-- Job Title -->
                                    <div class="col-12">
                                        <label class="form-label" for="job_title">Job Title <span class="txt-danger">*</span></label>
                                        <input type="text" class="form-control" id="job_title" name="job_title" placeholder="Enter Title" required>
                                        <div class="invalid-feedback">Please enter a Title.</div>
                                    </div>

                                    <!-- Job location -->
                                    <div class="col-12">
                                        <label class="form-label" for="location">Job location <span class="txt-danger">*</span></label>
                                        <input type="text" class="form-control" id="location" name="location" placeholder="Enter location" required>
                                        <div class="invalid-feedback">Please enter a location.</div>
                                    </div>


                                    <!-- Job Description -->
                                    <div class="col-12">
                                        <label class="form-label" for="job_description">Job Description <span class="txt-danger">*</span></label>
                                        <textarea class="form-control" id="job_description" name="job_description" placeholder="Enter Job Description" rows="4" required></textarea>
                                        <div class="invalid-feedback">Please enter a Job Description.</div>
                                    </div>

                                    <!--Responsibilities  -->
                                    <div class="col-12 mb-5">
                                        <label class="form-label" for="responsibility">Responsibilities </label>
                                        <textarea class="form-control summernote" id="summernote" name="responsibility" placeholder="Enter Responsibilities" required></textarea>
                                        <div class="invalid-feedback">Please enter a Responsibilities.</div>
                                    </div>


                                    <!-- Job Requirements -->
                                    <div class="col-12">
                                        <label class="form-label" for="job_requirements">Job Requirements <span class="txt-danger">*</span></label>
                                        <textarea class="form-control" id="job_requirements" name="job_requirements" placeholder="Enter Job Requirements" rows="4" required></textarea>
                                        <div class="invalid-feedback">Please enter a Job Requirements.</div>
                                    </div>

                                    <!-- Job Benefits -->
                                    <div class="col-12">
                                        <label class="form-label" for="job_benefits">Job Benefits </label>
                                        <textarea class="form-control" id="job_benefits" name="job_benefits" placeholder="Enter Job Benefits" rows="4"></textarea>
                                        <div class="invalid-feedback">Please enter a Job Benefits.</div>
                                    </div>

                                    
                                    <!-- Job Disclaimer -->
                                    <div class="col-12">
                                        <label class="form-label" for="job_disclaimer">Job Disclaimer </label>
                                        <textarea class="form-control" id="job_disclaimer" name="job_disclaimer" placeholder="Enter Job Disclaimer" rows="4"></textarea>
                                        <div class="invalid-feedback">Please enter a Job Disclaimer.</div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('career.index') }}" class="btn btn-danger px-4">Cancel</a>
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