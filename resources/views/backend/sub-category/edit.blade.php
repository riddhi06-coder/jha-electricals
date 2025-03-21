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
                  <h4>Edit Sub Category Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('sub-category.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Sub Category</li>
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
                        <h4>Sub Category Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('sub-category.update', $details->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT') 

                                    <!-- Category Name -->
                                    <div class="col-6">
                                        <label class="form-label" for="category_id">Select Category <span class="txt-danger">*</span></label>
                                        <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                            <option value="">-- Select Category --</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" 
                                                    {{ old('category_id', $details->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Sub Category Name -->
                                    <div class="col-6">
                                        <label class="form-label" for="sub_category_name">Sub Category Name <span class="txt-danger">*</span></label>
                                        <input type="text" class="form-control @error('sub_category_name') is-invalid @enderror" 
                                            id="sub_category_name" name="sub_category_name" 
                                            value="{{ old('sub_category_name', $details->sub_category_name) }}" 
                                            placeholder="Enter Sub Category Name" required>
                                        @error('sub_category_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="col-6">
                                        <label class="form-label" for="image">Sub Category Image <span class="txt-danger">*</span></label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                            id="image" name="image" accept="image/*" onchange="previewImage(event)">
                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                        <br>
                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Image Preview -->
                                    <div class="col-6">
                                        @if($details->image)
                                            <img id="imagePreview" src="{{ asset('/uploads/sub-category/' . $details->image) }}" 
                                                alt="Current Image" class="img-thumbnail" width="100" height="100">
                                        @else
                                            <img id="imagePreview" src="#" alt="Image Preview" class="img-thumbnail d-none" width="100" height="100">
                                        @endif
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('sub-category.index') }}" class="btn btn-danger px-4">Cancel</a>
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
        var image = document.getElementById('imagePreview');
        var file = event.target.files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function() {
                image.src = reader.result;
                image.classList.remove('d-none'); // Show the image
            }
            reader.readAsDataURL(file);
        }
    }

</script>

</body>

</html>