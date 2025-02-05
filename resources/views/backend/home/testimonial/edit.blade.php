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
                  <h4>Edit Testimonial Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('home-testimonails.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Testimonial Details</li>
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
                        <h4>Testimonial Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate 
                                    action="{{ route('home-testimonails.update', $testimonail->id) }}" 
                                    method="POST" enctype="multipart/form-data">
                                    
                                    @csrf
                                    @method('PUT')

                                    <!-- Title -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="title">Title</label>
                                        <input class="form-control" id="title" type="text" name="title" 
                                            placeholder="Enter Title" value="{{ old('title', $testimonail->title) }}">
                                        <div class="invalid-feedback">Please enter a title.</div>
                                    </div>

                                    <!-- Reviewer's Name -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="name">Reviewer's Name <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="name" type="text" name="name" 
                                            placeholder="Enter Reviewer's Name" required value="{{ old('name', $testimonail->name) }}">
                                        <div class="invalid-feedback">Please enter a Reviewer's Name.</div>
                                    </div>

                                    <!-- Review -->
                                    <div class="col-xxl-4 col-sm-12">
                                        <label class="form-label" for="message">Message <span class="txt-danger">*</span></label>
                                        <textarea class="form-control" id="summernote" name="message" placeholder="Enter Message" required>
                                            {{ old('message', $testimonail->message) }}
                                        </textarea>
                                        <div class="invalid-feedback">Please enter a Message.</div>
                                    </div>

                                    <!-- Banner Image Upload -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="banner_image">Upload Image <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="banner_image" type="file" name="banner_image" accept="image/*" 
                                            onchange="previewImage(event)">
                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                        <br>
                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                    </div>

                                    <!-- Image Preview -->
                                    <div class="col-12">
                                        <div>
                                            @if($testimonail->image)
                                                <img id="imagePreview" src="{{ asset('uploads/testimonials/' . $testimonail->image) }}" 
                                                    alt="Current Image" style="max-width: 30%; height: auto; border: 1px solid #ddd; padding: 5px;">
                                            @else
                                                <p class="text-muted">No image uploaded.</p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('home-testimonails.index') }}" class="btn btn-danger px-4">Cancel</a>
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