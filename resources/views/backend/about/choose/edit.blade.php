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
                  <h4>Edit Why choose Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('choose-us.index') }}">Home</a>
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
                        <h4>Why choose Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('choose-us.update', $choose->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Product Title -->
                                    <div class="col-6">
                                        <label class="form-label" for="product_title">Title <span class="txt-danger">*</span></label>
                                        <input type="text" class="form-control" id="product_title" name="product_title" value="{{ $choose->product_title }}" placeholder="Enter Title" required>
                                        <div class="invalid-feedback">Please enter a title.</div>
                                    </div>

                                    <!-- Product Range Description -->
                                    <div class="col-12">
                                        <label class="form-label" for="product_description">Description <span class="txt-danger">*</span></label>
                                        <textarea class="form-control" id="product_description" name="product_description" placeholder="Enter Description" rows="3" required>{{ $choose->product_description }}</textarea>
                                        <div class="invalid-feedback">Please enter a description.</div>
                                    </div>

                                    <!-- Product Range Table -->
                                    <div class="col-12">
                                        <h4>Qualities Details</h4><br>
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
                                                    $images = json_decode($choose->product_images, true) ?? [];
                                                    $titles = json_decode($choose->product_titles, true) ?? [];
                                                    $descriptions = json_decode($choose->product_descriptions, true) ?? [];
                                                @endphp

                                                @foreach($titles as $index => $title)
                                                    <tr>
                                                        <td>
                                                            @if(isset($images[$index]) && !empty($images[$index]))
                                                                <img src="{{ asset('uploads/choose-us/'.$images[$index]) }}" alt="Uploaded Image" width="100">
                                                            @endif
                                                            <input type="file" class="form-control mt-2" name="product_images[]" accept="image/*" onchange="previewImage(this, 'product_preview_{{ $index }}')">
                                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                            <br>
                                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                            <div id="product_preview_{{ $index }}" class="mt-2"></div>
                                                        </td>

                                                        <td><input type="text" class="form-control" name="product_titles[]" value="{{ $title }}" required></td>
                                                        <td><textarea class="form-control" name="product_descriptions[]" required>{{ $descriptions[$index] }}</textarea></td>
                                                        <td>
                                                            @if($index == 0)
                                                                <button type="button" class="btn btn-success" onclick="addRow()">Add More</button>
                                                            @else
                                                                <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('choose-us.index') }}" class="btn btn-danger px-4">Cancel</a>
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
                 <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                <br>
                <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
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
        
        if (!previewContainer) return; // Prevent errors if the ID is incorrect

        previewContainer.innerHTML = ''; // Clear previous previews

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


</body>

</html>