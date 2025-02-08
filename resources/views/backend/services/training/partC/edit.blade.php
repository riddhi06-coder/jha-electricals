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
                  <h4>Edit Post Installation Part C Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('post-install-partC.index') }}">Home</a>
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
                        <h4>Post Installation Part C Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('post-install-partC.update', $details->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Section Heading -->
                                    <div class="col-12">
                                        <label class="form-label" for="section_heading">Section Heading<span class="txt-danger">*</span></label>
                                        <input type="text" class="form-control" id="section_heading" name="section_heading" value="{{ $details->section_heading }}" required>
                                        <div class="invalid-feedback">Please enter a Section heading.</div>
                                    </div>

                                    <!-- Calculations Table -->
                                  
                                    <div class="d-flex justify-content-end mb-2">
                                        <button type="button" class="btn btn-success" onclick="addRow()">Add More</button>
                                    </div>
                                    <table class="table table-bordered p-3" id="productTable">
                                        <thead>
                                            <tr>
                                                <th>Image <span class="txt-danger">*</span></th>
                                                <th>Title <span class="txt-danger">*</span></th>
                                                <th>Description <span class="txt-danger">*</span></th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="productTableBody">
                                            @foreach ($calculation_images as $index => $image)
                                                <tr data-index="{{ $index }}">
                                                    <td>
                                                        <input type="file" class="form-control" name="calculation_images[]" accept="image/*" onchange="previewImage(this, 'calculation_preview_{{ $index }}')">
                                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                        <br>
                                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                        @if ($image)
                                                            <img src="{{ asset('uploads/services/' . $image) }}" width="100" class="mt-2" alt="Current Image">
                                                            <input type="hidden" name="existing_images[]" value="{{ $image }}">
                                                        @endif
                                                        <div id="calculation_preview_{{ $index }}" class="mt-2"></div>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="calculation_titles[]" 
                                                            value="{{ $calculation_titles[$index] ?? '' }}" required>
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control" name="calculation_descriptions[]" required>{{ $calculation_descriptions[$index] ?? '' }}</textarea>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger removeRow" data-image="{{ $image }}">Remove</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                        <!-- Hidden input to store deleted images -->
                                        <input type="hidden" name="deleted_calculation_images" id="deleted_calculation_images">


                                    </table>

                                   
                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('post-install-partC.index') }}" class="btn btn-danger px-4">Cancel</a>
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
   $(document).ready(function () {
    let deletedImages = [];

    function updateDeletedImages() {
        $("#deleted_calculation_images").val(JSON.stringify(deletedImages));
    }

    // Add new row dynamically
    window.addRow = function () {
        let index = $("#productTable tbody tr").length;
        let newRow = `
            <tr data-index="${index}">
                <td>
                    <input type="file" class="form-control" name="calculation_images[]" accept="image/*" onchange="previewImage(this, 'calculation_preview_${index}')">
                    <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                    <br>
                    <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                    <div id="calculation_preview_${index}" class="mt-2"></div>
                </td>
                <td><input type="text" class="form-control" name="calculation_titles[]" placeholder="Enter Title" required></td>
                <td><textarea class="form-control" name="calculation_descriptions[]" placeholder="Enter Description" required></textarea></td>
                <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
            </tr>
        `;
        $("#productTable tbody").append(newRow);
        updateRowIndices(); // Update row indexes for consistency
    }

    // Remove row and update deleted images array
    $(document).on("click", ".removeRow", function () {
        let row = $(this).closest("tr");
        let imageName = row.find("input[name='existing_images[]']").val();

        // If the image exists, mark it for deletion
        if (imageName) {
            deletedImages.push(imageName);
            updateDeletedImages();
        }

        row.remove();
        updateRowIndices(); // Update indexes after removal
    });

    // Function to update row indices dynamically
    function updateRowIndices() {
        $("#productTable tbody tr").each(function (index) {
            $(this).attr("data-index", index);
            $(this).find("input[type='file']").attr("onchange", `previewImage(this, 'calculation_preview_${index}')`);
            $(this).find("div[id^='calculation_preview_']").attr("id", `calculation_preview_${index}`);
        });
    }
});

</script>


</body>

</html>