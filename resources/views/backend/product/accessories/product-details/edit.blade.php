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
                  <h4>Edit Accessories Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('accessories-product-detail.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Accessories</li>
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
                        <h4>Accessories Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('accessories-product-detail.update', $details->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Category Dropdown -->
                                    <div class="col-6">
                                        <label class="form-label" for="category_id">Product Category <span class="txt-danger">*</span></label>
                                        <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                            <option value="">Select Product Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $details->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Product Name -->
                                    <div class="col-6">
                                        <label class="form-label" for="product_name">Product Name <span class="txt-danger">*</span></label>
                                        <select class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" required>
                                            <option value="">Select Product</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" {{ $details->product_id == $product->id ? 'selected' : '' }}>
                                                    {{ $product->product_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('product_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4"></div>

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h3 class="mb-0">Product Images</h3>
                                        <button type="button" class="btn btn-success" onclick="addRow()">Add More</button>
                                    </div>
                                    <table class="table table-bordered p-3" id="productTable" style="border: 2px solid #dee2e6;">
                                        <thead>
                                            <tr>
                                                <th>Image <span class="txt-danger">*</span></th>
                                                <th>Image Preview</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($details->product_images as $index => $image)
                                                <tr>
                                                    <td>
                                                        <input type="file" class="form-control" name="product_images[]" accept="image/*"
                                                            onchange="previewImage(this, 'imagePreview_{{ $index }}')">
                                                        <input type="hidden" name="existing_images[]" value="{{ $image }}" class="existing-image">
                                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                        <br>
                                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                    </td>
                                                    <td class="text-center">
                                                        <img src="{{ asset('/uploads/products/' . $image) }}" alt="Image Preview" id="imagePreview_{{ $index }}" class="img-thumbnail" width="100">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger" onclick="removeRow(this, '{{ $image }}')">Remove</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <!-- Hidden input to track removed images -->
                                    <input type="hidden" name="removed_images" id="removed_images">

                                 

                                    <div class="mb-4"></div>

                                    <!-- Section Heading -->
                                    <div class="col-12">
                                        <label class="form-label" for="section_heading">Section Heading <span class="txt-danger">*</span></label>
                                        <input type="text" class="form-control" id="section_heading" name="section_heading" value="{{ $details->section_heading }}" required>
                                        <div class="invalid-feedback">Please enter a Section heading.</div>
                                    </div>

                                    <div class="mb-4"></div>

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h3 class="mb-0">Product Specification</h3>
                                        <button type="button" class="btn btn-success" onclick="addSpecRow()">Add More</button>
                                    </div>
                                    <table class="table table-bordered p-3" id="specsTable" style="border: 2px solid #dee2e6;">
                                        <thead>
                                            <tr>
                                                <th>Code <span class="txt-danger">*</span></th>
                                                <th>Description <span class="txt-danger">*</span></th>
                                                <th>White ₹ MRP Per PC<span class="txt-danger">*</span></th>
                                                <th>PKG<span class="txt-danger">*</span></th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($details->product_codes as $index => $code)
                                                <tr>
                                                    <td><input type="text" class="form-control" name="product_codes[]" value="{{ $code }}" required></td>
                                                    <td><input type="text" class="form-control" name="product_wattages[]" value="{{ $details->product_description[$index] }}" required></td>
                                                    <td><input type="text" class="form-control" name="product_sizes[]" value="{{ $details->product_pkg[$index] }}" required></td>
                                                    <td><input type="text" class="form-control" name="product_mrps[]" value="{{ $details->product_mrps[$index] }}" required></td>
                                                    <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                

                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('accessories-product-detail.index') }}" class="btn btn-danger px-4">Cancel</a>
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
    var productsByCategory = @json($groupedProducts);

    document.addEventListener("DOMContentLoaded", function () {
        let categoryDropdown = document.getElementById("category_id");
        let productDropdown = document.getElementById("product_name");

        categoryDropdown.addEventListener("change", function () {
            let selectedCategory = this.value;
            productDropdown.innerHTML = '<option value="">Select Product</option>';

            if (productsByCategory[selectedCategory]) {
                productsByCategory[selectedCategory].forEach(function (product) {
                    let option = document.createElement("option");
                    option.value = product.id;
                    option.textContent = product.name; 
                    productDropdown.appendChild(option);
                });
            }
        });
    });
</script>



<!-- Product Images section-->      
<script>

    function addRow() {
        let table = document.getElementById('productTable').getElementsByTagName('tbody')[0];
        let rowCount = table.rows.length;
        let uniqueId = Date.now();

        let row = table.insertRow(rowCount);
        row.innerHTML = `
            <td>
                <input type="file" class="form-control" name="product_images[]" accept="image/*" 
                    onchange="previewImage(this, 'imagePreview_${uniqueId}')" required>
                <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                <br>
                <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
            </td>
            <td class="text-center">
                <img src="#" alt="Image Preview" id="imagePreview_${uniqueId}" class="img-thumbnail d-none" width="100">
            </td>
            <td>
                <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
            </td>
        `;
    }

    let removedImages = [];

function removeRow(button, imageName = null) {
    let row = button.closest("tr");

    if (imageName) {
        removedImages.push(imageName);
        document.getElementById("removed_images").value = JSON.stringify(removedImages);

        // Remove the associated hidden input for existing image
        let hiddenInput = row.querySelector(".existing-image");
        if (hiddenInput) {
            hiddenInput.remove();
        }
    }

    row.remove();
}

    function previewImage(input, imgId) {
        let imgElement = document.getElementById(imgId);

        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                imgElement.src = e.target.result;
                imgElement.classList.remove("d-none");
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>


<!-- JavaScript to Add and Remove Rows for Sepcification -->
<script>
    function addImageRow() {
        let table = document.getElementById('productTable').getElementsByTagName('tbody')[0];
        let rowCount = table.rows.length;
        let row = table.insertRow(rowCount);
        let uniqueId = Date.now();

        row.innerHTML = `
            <td>
                <input type="file" class="form-control" name="product_images[]" accept="image/*" 
                    onchange="previewImage(this, 'imagePreview_${uniqueId}')" required>
                <small class="text-secondary"><b>Max size: 2MB | Formats: .jpg, .jpeg, .png, .webp</b></small>
            </td>
            <td class="text-center">
                <img src="#" alt="Image Preview" id="imagePreview_${uniqueId}" class="img-thumbnail d-none" width="100">
            </td>
            <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
        `;
    }

    function addSpecRow() {
        let table = document.getElementById('specsTable').getElementsByTagName('tbody')[0];
        let rowCount = table.rows.length;
        let row = table.insertRow(rowCount);

        row.innerHTML = `
            <td><input type="text" class="form-control" name="product_codes[]" placeholder="Enter Code" required></td>
            <td><input type="text" class="form-control" name="product_wattages[]" placeholder="Enter Description" required></td>
            <td><input type="text" class="form-control" name="product_sizes[]" placeholder="Enter MRP Per PC" required></td>
            <td><input type="text" class="form-control" name="product_mrps[]" placeholder="Enter PKG" required></td>
            <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
        `;
    }

    function removeRow(button) {
        let row = button.closest('tr');
        row.remove();
    }

</script>

</body>

</html>