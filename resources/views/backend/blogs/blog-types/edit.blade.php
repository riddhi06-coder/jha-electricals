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
                  <h4>Edit BLogs Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('blog-types.index') }}">Home</a>
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
                        <h4>BLog Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('blog-types.update', $details->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Banner Heading -->
                                    <div class="col-12">
                                        <label class="form-label" for="banner_heading">Banner Heading </label>
                                        <input type="text" class="form-control" id="banner_heading" name="banner_heading" value="{{ old('banner_heading', $details->banner_heading) }}" placeholder="Enter Banner Heading">
                                        <div class="invalid-feedback">Please enter a Banner heading.</div>
                                    </div>

                                    <!-- Banner Image Upload -->
                                    <div class="col-12">
                                        <label class="form-label" for="product_image">Banner Image</label>
                                        <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*" onchange="previewImage(this, 'image_preview')">
                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                        <br>
                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                        <div id="image_preview" class="mt-2">
                                            @if($details->banner_image)
                                                <img src="{{ asset('uploads/blogs/' . $details->banner_image) }}" alt="Banner Image" width="100">
                                            @endif
                                        </div>
                                        <div class="invalid-feedback">Please upload a banner image.</div>
                                    </div>

                                    <div class="col-12 my-4"></div>

                                    <h3>Blog Information</h3>

                                    <!-- Thumbnail Images -->
                                    <div class="col-12">
                                        <label class="form-label" for="thumbnail">Thumbnail Images <span class="txt-danger">*</span></label>
                                        <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*" onchange="previewImage1(event)">
                                        <div class="invalid-feedback">Please upload a thumbnail image.</div>
                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                        <br>
                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                        <img id="thumbnail-preview" src="{{ $details->thumbnail ? asset('uploads/blogs/' . $details->thumbnail) : '#' }}" alt="Image Preview" style="display: {{ $details->thumbnail ? 'block' : 'none' }}; margin-top: 10px; max-width: 100px; max-height: 100px;">
                                    </div>

                                    <!-- Date -->
                                    <div class="col-6">
                                        <label class="form-label" for="date">Date <span class="txt-danger">*</span></label>
                                        <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $details->date) }}" required>
                                        <div class="invalid-feedback">Please select a date.</div>
                                    </div>

                                    <!-- Location -->
                                    <div class="col-6">
                                        <label class="form-label" for="location">Location <span class="txt-danger">*</span></label>
                                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $details->location) }}" placeholder="Enter location" required>
                                        <div class="invalid-feedback">Please enter a location.</div>
                                    </div>

                                    <!-- Blog Heading -->
                                    <div class="col-6">
                                        <label class="form-label" for="blog_heading">Blog Heading <span class="txt-danger">*</span></label>
                                        <input type="text" class="form-control" id="blog_heading" name="blog_heading" value="{{ old('blog_heading', $details->blog_heading) }}" placeholder="Enter Blog Heading" required>
                                        <div class="invalid-feedback">Please enter a blog heading.</div>
                                    </div>

                                    <!-- Short Description -->
                                    <div class="col-6">
                                        <label class="form-label" for="short_description">Short Description <span class="txt-danger">*</span></label>
                                        <textarea class="form-control" id="short_description" name="short_description" placeholder="Enter Short Description" rows="1" required>{{ old('short_description', $details->short_description) }}</textarea>
                                        <div class="invalid-feedback">Please enter a short description.</div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('blog-types.index') }}" class="btn btn-danger px-4">Cancel</a>
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
    // for banner image preview
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
        // for thumbnail image preview
        function previewImage1(event) {
        const preview = document.getElementById('thumbnail-preview');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    }

</script>



</body>

</html>