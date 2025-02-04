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
                  <h4>Edit About Us Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('home-about.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit About Us</li>
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
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('home-about.update', $about->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Heading -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="banner_heading">Heading <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="heading" type="text" name="heading" placeholder="Enter Heading" value="{{ old('heading', $about->heading) }}" required>
                                        <div class="invalid-feedback">Please enter a Heading.</div>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-xxl-4 col-sm-12">
                                        <label class="form-label" for="description">Description <span class="txt-danger">*</span></label>
                                        <textarea class="form-control" id="summernote" name="description" placeholder="Enter Description" required>{{ old('description', $about->description) }}</textarea>
                                        <div class="invalid-feedback">Please enter a Description.</div>
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="table-container" style="margin-bottom: 20px;">
                                        <div class="d-flex align-items-center">
                                            <h5 class="mb-4 me-3"><strong>Image Upload</strong></h5>
                                            <button type="button" class="btn btn-primary ms-auto" id="addRow">Add More</button>
                                        </div>
                                        <table class="table table-bordered p-3" id="dynamicTable" style="border: 2px solid #dee2e6;">
                                            <thead>
                                                <tr>
                                                    <th>Uploaded Image: <span class="text-danger">*</span></th>
                                                    <th>Preview</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($images as $index => $image)
                                                <tr>
                                                    <td>
                                                        <input type="file" onchange="previewThumbnail(this, {{ $index }})" accept=".png, .jpg, .jpeg, .webp" name="thumbnail_image[]" id="thumbnail_image_{{ $index }}" class="form-control">
                                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                        <br>
                                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                        
                                                        <!-- Hidden input to retain existing image names -->
                                                        <input type="hidden" name="existing_images[]" value="{{ $image }}">
                                                    </td>

                                                    <td>
                                                        <div id="preview-container-{{ $index }}">
                                                            <img src="{{ asset('/uploads/home/about/' . $image) }}" style="max-width: 100px; max-height: 100px;" alt="Image Preview">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger removeRow">Remove</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Values and Description Table -->
                                    <div class="table-container" style="margin-bottom: 20px;">
                                        <div class="d-flex align-items-center">
                                            <h5 class="mb-4 me-3"><strong>Values</strong></h5>
                                            <button type="button" class="btn btn-primary ms-auto" id="addRowValues">Add More</button>
                                        </div>
                                        <table class="table table-bordered p-3" id="dynamicTableValues" style="border: 2px solid #dee2e6;">
                                            <thead>
                                                <tr>
                                                    <th>Value <span class="text-danger">*</span></th>
                                                    <th>Description <span class="text-danger">*</span></th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($values as $index => $value)
                                                <tr>
                                                    <td>
                                                        <input type="text" name="value[]" id="value_{{ $index }}" class="form-control" placeholder="Enter Value" value="{{ old('value.' . $index, $value) }}" required>
                                                    </td>
                                                    <td>
                                                        <textarea name="value_description[]" id="description_{{ $index }}" class="form-control" placeholder="Enter Description" rows="3" required>{{ old('value_description.' . $index, $valueDescriptions[$index] ?? '') }}</textarea>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger removeRowValues">Remove</button>
                                                    </td>
                                                </tr>
                                                @endforeach
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


    <!-- Thumbnail Preview Script -->
<script>
    function previewThumbnail(input, index) {
        const file = input.files[0];
        const previewContainer = document.getElementById(`preview-container-${index}`);
        
        previewContainer.innerHTML = "";  // Clear the preview container

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

<!-- Thumbnail Add More Row Script -->
<script>
    $(document).ready(function () {
        let rowId = {{ count($images) }}; // Start from the number of images already available

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

        // Remove a row and push image to removed images list
        $(document).on('click', '.removeRow', function () {
            const row = $(this).closest('tr');
            const imgSrc = row.find('img').attr('src'); // Get the image path
            
            // Add the removed image to the hidden "removed_images" field
            const removedImagesInput = $('<input>', {
                type: 'hidden',
                name: 'removed_images[]',
                value: imgSrc.split('/uploads/home/about/')[1]  // Extract the image name
            });

            // Append to the form
            $('form').append(removedImagesInput);

            row.remove();
        });
    });
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