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
                  <h4>Add About Us Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('home-about.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add About Us</li>
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
                        <h4>About Us Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('home-about.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                     <!-- Heading -->
                                     <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="banner_heading">Heading <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="heading" type="text" name="heading" placeholder="Enter Heading" required>
                                        <div class="invalid-feedback">Please enter a Heading.</div>
                                    </div>


                                    <!-- Description -->
                                    <div class="col-xxl-4 col-sm-12">
                                        <label class="form-label" for="description">Description <span class="txt-danger">*</span></label>
                                        <textarea class="form-control" id="summernote" name="description" placeholder="Enter Description" required></textarea>
                                        <div class="invalid-feedback">Please enter a Description.</div>
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="table-container" style="margin-bottom: 20px;">
                                        <h5 class="mb-4"><strong>Image Upload</strong></h5>
                                        <table class="table table-bordered p-3" id="dynamicTable" style="border: 2px solid #dee2e6;">
                                            <thead>
                                                <tr>
                                                    <th>Uploaded Image: <span class="text-danger">*</span></th>
                                                    <th>Preview</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="file" onchange="previewThumbnail(this, 0)" accept=".png, .jpg, .jpeg, .webp" name="thumbnail_image[]" id="thumbnail_image_0" class="form-control" placeholder="Upload Thumbnail Image" multiple required>
                                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                        <br>
                                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                    </td>
                                                    <td>
                                                        <div id="preview-container-0"></div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" id="addRow">Add More</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <!-- Values and Description Table -->
                                    <div class="table-container" style="margin-bottom: 20px;">
                                        <h5 class="mb-4"><strong>Values and Description</strong></h5>
                                        <table class="table table-bordered p-3" id="dynamicTableValues" style="border: 2px solid #dee2e6;">
                                            <thead>
                                                <tr>
                                                    <th>Value <span class="text-danger">*</span></th>
                                                    <th>Description <span class="text-danger">*</span></th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="text" name="value[]" id="value_0" class="form-control" placeholder="Enter Value" required>
                                                    </td>
                                                    <td>
                                                        <textarea name="value_description[]" id="description_0" class="form-control" placeholder="Enter Description" rows="3" required></textarea>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" id="addRowValues">Add More</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('home-about.index') }}" class="btn btn-danger px-4">Cancel</a>
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


<!--Thumbnail Preview-->
<script>
    function previewThumbnail(input, index) {
        const file = input.files[0];
        const previewContainer = document.getElementById(`preview-container-${index}`);
        
        previewContainer.innerHTML = "";

        if (file) {
            const validTypes = ["image/jpeg", "image/png", "image/jpg", "image/webp"];
            if (!validTypes.includes(file.type)) {
                alert("Please upload a valid image file (.jpg, .jpeg, .png, .webp).");
                return;
            }
            if (file.size > 2 * 1024 * 1024) {  
                alert("The file size should be less than 2MB.");
                return;
            }


            const reader = new FileReader();

            reader.onload = function (e) {
                const img = document.createElement("img");
                img.src = e.target.result;
                img.style.maxWidth = "100px";  
                img.style.maxHeight = "100px"; 
                img.alt = "Preview Image";
                
                previewContainer.appendChild(img);
            };

            reader.readAsDataURL(file);
        }
    }

</script>

<!--Thumbnail Add More Option-->
<script>
    $(document).ready(function () {
        let rowId = 0;
        $('#addRow').click(function () {
            rowId++;
            const newRow = `
                <tr>
                    <td>
                        <input type="file" onchange="previewThumbnail(this, ${rowId})" accept=".png, .jpg, .jpeg, .webp" name="thumbnail_image[]" id="thumbnail_image${rowId}" class="form-control" placeholder="Upload thumbnail Image">
                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                        <br>
                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                    </td>
                    <td>
                        <div id="preview-container-${rowId}"></div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger removeRow">Remove</button>
                    </td>
                </tr>`;
            $('#dynamicTable tbody').append(newRow);
        });

        // Remove a row
        $(document).on('click', '.removeRow', function () {
            $(this).closest('tr').remove();
        });
    });

    // Preview function for thumbnail images
    function previewThumbnail(input, rowId) {
        const file = input.files[0];
        const previewContainer = document.getElementById(`preview-container-${rowId}`);

        // Clear previous preview
        previewContainer.innerHTML = '';

        if (file) {
            const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

            if (validImageTypes.includes(file.type)) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Create an image element for preview
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '120px';
                    img.style.maxHeight = '100px';
                    img.style.objectFit = 'cover';

                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            } else {
                previewContainer.innerHTML = '<p>Unsupported file type</p>';
            }
        }
    }
</script>


<!--  Add More Rows for Values-->
<script>
    $(document).ready(function () {
        let rowId = 0; // Start from 0 for the first row

        // Add new row when "Add More" is clicked
        $('#addRowValues').click(function () {
            rowId++; // Increment rowId for each new row

            const newRow = `
                <tr>
                    <td>
                        <input type="text" name="value[]" id="value_${rowId}" class="form-control" placeholder="Enter Value" required>
                    </td>
                    <td>
                        <textarea name="value_description[]" id="description_${rowId}" class="form-control" placeholder="Enter Description" rows="3" required></textarea>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger removeRowValues">Remove</button>
                    </td>
                </tr>`;

            $('#dynamicTableValues tbody').append(newRow); // Append the new row to the table
        });

        // Remove a row when the "Remove" button is clicked
        $(document).on('click', '.removeRowValues', function () {
            $(this).closest('tr').remove(); // Remove the closest <tr> (row)
        });
    });
</script>

</body>

</html>