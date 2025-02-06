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
                  <h4>Edit Vision Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('product-vision.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Vision</li>
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
                        <h4>Vision Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('product-vision.update', $range->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Product Range Section -->
                                    <div class="col-12">
                                        <h4><strong>Product Range</strong></h4>
                                    </div>
                                    
                                    <!-- Product Title -->
                                    <div class="col-6">
                                        <label class="form-label" for="product_title">Product Title <span class="txt-danger">*</span></label>
                                        <input type="text" class="form-control" id="product_title" name="product_title" placeholder="Enter Product Title" value="{{ old('product_title', $range->product_title) }}" required>
                                        <div class="invalid-feedback">Please enter a Product title.</div>
                                    </div>

                                    <!-- Product Range Description -->
                                    <div class="col-12">
                                        <label class="form-label" for="product_description">Description <span class="txt-danger">*</span></label>
                                        <textarea class="form-control" id="product_description" name="product_description" placeholder="Enter Description" rows="3" required>{{ old('product_description', $range->product_description) }}</textarea>
                                        <div class="invalid-feedback">Please enter a description.</div>
                                    </div>
                                    
                                    <!-- Product Range Table -->
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4><strong>Product Range</strong></h4>
                                            <button type="button" class="btn btn-success" onclick="addRow()">Add More</button>
                                        </div>

                                        <table class="table table-bordered p-3" id="productTable" style="border: 2px solid #dee2e6;">
                                            <thead>
                                                <tr>
                                                    <th>Image <span class="txt-danger">*</span></th>
                                                    <th>Title <span class="txt-danger">*</span></th>
                                                    <th>Description <span class="txt-danger">*</span></th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
    @php
        // Decode the JSON data into arrays
        $productImages = json_decode($range->product_images, true) ?? [];
        $productTitles = json_decode($range->product_titles, true) ?? [];
        $productDescriptions = json_decode($range->product_descriptions, true) ?? [];
    @endphp

    @foreach($productImages as $index => $image)
        <tr>
            <td>
                <!-- Input for product image -->
                <input type="file" class="form-control" name="product_images[]" accept="image/*" onchange="previewImage(this, 'product_preview_{{ $index }}')">
                <input type="hidden" name="existing_product_images[]" value="{{ $image }}">
                <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                <br>
                <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                <div id="product_preview_{{ $index }}" class="mt-2">
                    @if(isset($image))
                        <img src="{{ asset('uploads/about/product-range/' . $image) }}" style="max-width: 150px;">
                    @endif
                </div>
            </td>
            <td>
                <!-- Input for product title -->
                <input type="text" class="form-control" name="product_titles[]" placeholder="Enter Title" value="{{ old('product_titles.' . $index, $productTitles[$index] ?? '') }}" required>
            </td>
            <td>
                <!-- Textarea for product description -->
                <textarea class="form-control" name="product_descriptions[]" placeholder="Enter Description" required>{{ old('product_descriptions.' . $index, $productDescriptions[$index] ?? '') }}</textarea>
            </td>
            <td>
                <!-- Button to remove the row -->
                <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
            </td>
        </tr>
    @endforeach
</tbody>


                                        </table>
                                    </div>

                                    <!-- Our Vision Section -->
                                    <div class="col-12" style="margin-top: 7.5rem !important; margin-bottom: 1rem;">
                                        <h4><strong>Our Vision</strong></h4>
                                    </div>

                                    <!-- Vision Title -->
                                    <div class="col-12">
                                        <label class="form-label" for="vision_title">Title <span class="txt-danger">*</span></label>
                                        <input type="text" class="form-control" id="vision_title" name="vision_title" placeholder="Enter Title" value="{{ old('vision_title', $range->vision_title) }}" required>
                                        <div class="invalid-feedback">Please enter a title.</div>
                                    </div>

                                    <!-- Vision Description -->
                                    <div class="col-12">
                                        <label class="form-label" for="vision_description">Description <span class="txt-danger">*</span></label>
                                        <textarea class="form-control" id="summernote" name="vision_description" placeholder="Enter Description" required>{{ old('vision_description', $range->vision_description) }}</textarea>
                                        <div class="invalid-feedback">Please enter a description.</div>
                                    </div>

                                    <!-- Vision Image Upload -->
                                    <div class="col-12">
                                        <label class="form-label" for="vision_image">Image <span class="txt-danger">*</span></label>
                                        <input type="file" class="form-control" id="vision_image" name="vision_image" accept="image/*" onchange="previewImage(this, 'vision_image_preview')">
                                        <div class="invalid-feedback">Please upload an image.</div>
                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                        <br>
                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                        <div id="vision_image_preview" class="mt-2">
                                            @if($range->vision_image)
                                                <img src="{{ asset('uploads/about/product-vision/' . $range->vision_image) }}" style="max-width: 150px;">
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('product-vision.index') }}" class="btn btn-danger px-4">Cancel</a>
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
    function addRow() {
        let table = document.getElementById('productTable').getElementsByTagName('tbody')[0];
        let rowCount = table.rows.length;
        let row = table.insertRow(rowCount);

        row.innerHTML = `
            <td>
                <input type="file" class="form-control" name="product_images[]" accept="image/*" onchange="previewImage(this, 'product_preview_${rowCount}')" required>
                <div id="product_preview_${rowCount}" class="mt-2"></div>
            </td>
            <td><input type="text" class="form-control" name="product_titles[]" placeholder="Enter Title" required></td>
            <td><textarea class="form-control" name="product_descriptions[]" placeholder="Enter Description" required></textarea></td>
            <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
        `;
    }

    function removeRow(button) {
    let row = button.closest('tr');
    row.remove();
}




    function previewImage(input, previewId) {
        let previewContainer = document.getElementById(previewId);
        previewContainer.innerHTML = '';
        
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                let img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '150px';
                img.style.marginTop = '5px';
                previewContainer.appendChild(img);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

</body>

</html>