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
                  <h4>Edit Qualities Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('home-quality.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Qualities</li>
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
                        <h4>Qualities Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('home-quality.update', $quality->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Quality Icon Upload Table -->
                                    <div class="table-container" style="margin-bottom: 20px;">
                                        <h5 class="mb-4"><strong>Quality Icon Upload</strong></h5>
                                        <table class="table table-bordered p-3" id="dynamicTableIcons" style="border: 2px solid #dee2e6;">
                                            <thead>
                                                <tr>
                                                    <th>Quality Icon <span class="text-danger">*</span></th>
                                                    <th>Quality <span class="text-danger">*</span></th>
                                                    <th>Preview</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="file" onchange="previewIcon(this, 0)" accept=".png, .jpg, .jpeg, .webp" name="quality_icon[]" id="quality_icon_0" class="form-control">
                                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="quality[]" id="quality_0" class="form-control" placeholder="Enter Quality" value="{{ $quality->quality }}" required>
                                                    </td>
                                                    <td>
                                                        <div id="icon-preview-container-0">
                                                            <img src="{{ asset('uploads/home/quality-icons/' . $quality->quality_icon) }}" alt="Quality Icon" style="max-width: 50px; height: auto;">
                                                        </div>
                                                    </td>
                                                   
                                                </tr>
                                               
                                            </tbody>

                                        </table>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('home-quality.index') }}" class="btn btn-danger px-4">Cancel</a>
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
    function previewIcon(input, index) {
        let previewContainer = document.getElementById(`icon-preview-container-${index}`);
        previewContainer.innerHTML = "";

        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                let img = document.createElement("img");
                img.src = e.target.result;
                img.style.maxWidth = "100px";
                img.style.height = "auto";
                img.style.border = "1px solid #ddd";
                img.style.padding = "5px";
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>

</html>