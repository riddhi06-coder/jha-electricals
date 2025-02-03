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
                  <h4>Edit Banner Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('home-banner.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Banner</li>
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
                        <h4>Banner Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('home-banner.update', $HomeBanner->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT') <!-- Use PUT method for updating the resource -->

                                    <!-- Banner Heading -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="banner_heading">Banner Heading <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="banner_heading" type="text" name="banner_heading" value="{{ old('banner_heading', $HomeBanner->banner_heading) }}" placeholder="Enter Banner Heading" required>
                                        <div class="invalid-feedback">Please enter a banner Heading.</div>
                                    </div>

                                    <!-- Banner Title -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="banner_title">Banner Title <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="banner_title" type="text" name="banner_title" value="{{ old('banner_title', $HomeBanner->banner_title) }}" placeholder="Enter Banner Title" required>
                                        <div class="invalid-feedback">Please enter a banner title.</div>
                                    </div>

                                    <!-- Banner Image Upload -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="banner_image">Upload Banner Image <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="banner_image" type="file" name="banner_image" accept="image/*" onchange="previewImage(event)">
                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                        <br>
                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                    </div>

                                    <!-- Existing Image Preview -->
                                    @if($HomeBanner->banner_image)
                                        <div class="col-12">
                                            <label class="form-label"></label>
                                            <div>
                                                <img id="currentImage" src="{{ asset('uploads/home/banner/' . $HomeBanner->banner_image) }}" alt="Banner Image" style="max-width: 100px;">
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Image Preview (if new image is selected) -->
                                    <div class="col-12">
                                        <label class="form-label"></label>
                                        <div>
                                            <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 30%; height: auto; display: none; border: 1px solid #ddd; padding: 5px;">
                                        </div>
                                    </div>


                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('home-banner.index') }}" class="btn btn-danger px-4">Cancel</a>
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
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById("imagePreview");
        const currentImage = document.getElementById("currentImage");

        // Remove the current image if new file is selected
        if (file) {
            currentImage?.remove(); // Remove the current image element if it exists

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