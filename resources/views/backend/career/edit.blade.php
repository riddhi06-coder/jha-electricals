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
                  <h4>Edit Jobs Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('career.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Details</li>
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
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('career.update', $details->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Banner Heading -->
                                    <div class="col-12">
                                        <label class="form-label" for="banner_heading">Banner Heading</label>
                                        <input type="text" class="form-control" id="banner_heading" name="banner_heading" placeholder="Enter Banner Heading"
                                            value="{{ old('banner_heading', $details->banner_heading) }}">
                                        <div class="invalid-feedback">Please enter a Banner heading.</div>
                                    </div>

                                    <!-- Banner Image Upload -->
                                    <div class="col-12">
                                        <label class="form-label" for="product_image">Banner Image</label>
                                        <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*"
                                            onchange="previewImage(this, 'image_preview')">
                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                        @if ($details->banner_image)
                                            <div id="image_preview" class="mt-2">
                                                <img src="{{ asset('uploads/career/' . $details->banner_image) }}" alt="Current Banner Image" width="150">
                                            </div>
                                        @endif

                                        <div class="invalid-feedback">Please upload a Banner image.</div>
                                    </div>

                                    <!-- Title -->
                                    <div class="col-12">
                                        <label class="form-label" for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title"
                                            value="{{ old('title', $details->title) }}">
                                        <div class="invalid-feedback">Please enter a Title.</div>
                                    </div>

                                    <h3>Job Details</h3>

                                    <!-- Job Role -->
                                    <div class="col-12">
                                        <label class="form-label" for="role">Job Role <span class="txt-danger">*</span></label>
                                        <input type="text" class="form-control" id="role" name="role" placeholder="Enter Role"
                                            value="{{ old('role', $details->role) }}" required>
                                        <div class="invalid-feedback">Please enter a Role.</div>
                                    </div>

                                    <!-- Company Overview -->
                                    <div class="col-12">
                                        <label class="form-label" for="company_interview">Company Overview <span class="txt-danger">*</span></label>
                                        <textarea class="form-control" id="company_interview" name="company_interview" rows="4" required>{{ old('company_overview', $details->company_overview) }}</textarea>
                                        <div class="invalid-feedback">Please enter a Company Overview.</div>
                                    </div>

                                    <!-- Job Title -->
                                    <div class="col-12">
                                        <label class="form-label" for="job_title">Job Title <span class="txt-danger">*</span></label>
                                        <input type="text" class="form-control" id="job_title" name="job_title" placeholder="Enter Job Title"
                                            value="{{ old('job_title', $details->job_title) }}" required>
                                        <div class="invalid-feedback">Please enter a Job Title.</div>
                                    </div>

                                    <!-- Job Location -->
                                    <div class="col-12">
                                        <label class="form-label" for="location">Job Location <span class="txt-danger">*</span></label>
                                        <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location"
                                            value="{{ old('location', $details->location) }}" required>
                                        <div class="invalid-feedback">Please enter a Location.</div>
                                    </div>

                                    <!-- Job Description -->
                                    <div class="col-12">
                                        <label class="form-label" for="job_description">Job Description <span class="txt-danger">*</span></label>
                                        <textarea class="form-control" id="job_description" name="job_description" rows="4" required>{{ old('job_description', $details->job_description) }}</textarea>
                                        <div class="invalid-feedback">Please enter a Job Description.</div>
                                    </div>

                                    <!-- Responsibilities -->
                                    <div class="col-12 mb-5">
                                        <label class="form-label" for="responsibility">Responsibilities</label>
                                        <textarea class="form-control summernote" id="summernote" name="responsibility">{{ old('responsibilities', $details->responsibilities) }}</textarea>
                                        <div class="invalid-feedback">Please enter Responsibilities.</div>
                                    </div>

                                    <!-- Job Requirements -->
                                    <div class="col-12">
                                        <label class="form-label" for="job_requirements">Job Requirements <span class="txt-danger">*</span></label>
                                        <textarea class="form-control" id="job_requirements" name="job_requirements" rows="4" required>{{ old('job_requirements', $details->job_requirements) }}</textarea>
                                        <div class="invalid-feedback">Please enter Job Requirements.</div>
                                    </div>

                                    <!-- Job Benefits -->
                                    <div class="col-12">
                                        <label class="form-label" for="job_benefits">Job Benefits</label>
                                        <textarea class="form-control" id="job_benefits" name="job_benefits" rows="4">{{ old('job_benefits', $details->job_benefits) }}</textarea>
                                        <div class="invalid-feedback">Please enter Job Benefits.</div>
                                    </div>

                                    <!-- Job Disclaimer -->
                                    <div class="col-12">
                                        <label class="form-label" for="job_disclaimer">Job Disclaimer</label>
                                        <textarea class="form-control" id="job_disclaimer" name="job_disclaimer" rows="4">{{ old('job_disclaimer', $details->job_disclaimer) }}</textarea>
                                        <div class="invalid-feedback">Please enter Job Disclaimer.</div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('career.index') }}" class="btn btn-danger px-4">Cancel</a>
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
   function previewImage(input, previewId) {
        let previewContainer = document.getElementById(previewId);
        if (!previewContainer) return;

        previewContainer.innerHTML = ''; // Clear previous image preview

        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                let img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '150px';
                img.style.marginTop = '5px';
                img.style.borderRadius = '5px';
                img.style.border = '1px solid #ddd';

                previewContainer.appendChild(img);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            console.log("No file selected"); // Debugging output
        }
    }

</script>




</body>

</html>