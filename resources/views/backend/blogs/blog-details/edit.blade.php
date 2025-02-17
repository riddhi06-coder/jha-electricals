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
                    <a href="{{ route('blog-detail.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Blogs Details</li>
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
                        <h4>BLog Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('blog-detail.update', $details->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT') <!-- Use PUT for updating the resource -->

                                    <!-- Banner Heading -->
                                    <div class="col-12">
                                        <label class="form-label" for="banner_heading">Banner Heading</label>
                                        <input type="text" class="form-control" id="banner_heading" name="banner_heading" placeholder="Enter Banner Heading" value="{{ old('banner_heading', $details->banner_heading) }}">
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
                                            @if ($details->banner_image)
                                                <img src="{{ asset('uploads/blogs/' . $details->banner_image) }}" alt="Banner Image" width="100">
                                            @endif
                                        </div>
                                        <div class="invalid-feedback">Please upload a Banner image.</div>
                                    </div>

                                    <div class="col-12 my-4"></div>

                                    <h3>Blog Details</h3>

                                    <!-- Blog Title Dropdown -->
                                    <div class="col-12">
                                        <label class="form-label" for="blog_title">Blog Title <span class="txt-danger">*</span></label>
                                        <select class="form-control" id="blog_title" name="blog_title" required>
                                            <option value="" disabled>Select Blog Title</option>
                                            @foreach ($blogs as $blog)
                                                <option value="{{ $blog->id }}" {{ $blog->id == $details->blog_title ? 'selected' : '' }}>
                                                    {{ $blog->blog_heading }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select a blog Title.</div>
                                    </div>

                                   <!-- Image -->
                                    <div class="col-12">
                                        <label class="form-label" for="image">Image <span class="txt-danger">*</span></label>
                                        <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewImage1(event)">
                                        
                                        <div class="invalid-feedback">Please upload an Image.</div>
                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                        <br>
                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                        @if ($details->image) 
                                            <div class="mt-2">
                                                <img src="{{ asset('uploads/blogs/' . $details->image) }}" alt="Image Preview" style="max-width: 100px; max-height: 100px;">
                                            </div>
                                        @endif

                                        <img id="thumbnail-preview" src="#" alt="Image Preview" style="display: none; margin-top: 10px; max-width: 100px; max-height: 100px;">
                                    </div>


                                    <!-- Description -->
                                    <div class="col-12">
                                        <label class="form-label" for="description">Description <span class="txt-danger">*</span></label>
                                        <textarea class="form-control" id="summernote" name="description" placeholder="Enter Description" required>{{ old('description', $details->description) }}</textarea>
                                        <div class="invalid-feedback">Please enter a short description.</div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('blog-detail.index') }}" class="btn btn-danger px-4">Cancel</a>
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