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
                  <h4>Add Social Media Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('social-media.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Social Media Details</li>
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
                        <h4>Social Media Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('social-media.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Social Media Links Table -->
                                    <div class="col-12">
                                        <table class="table table-bordered p-3" id="socialMediaTable" style="border: 2px solid #dee2e6;">
                                            <thead>
                                                <tr>
                                                    <th>Social Media Platform <span class="txt-danger">*</span></th>
                                                    <th>URL <span class="txt-danger">*</span></th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select class="form-control" name="social_media_platform[]" required>
                                                            <option value="">Select Platform</option>
                                                            <option value="Facebook">Facebook</option>
                                                            <option value="Twitter">Twitter</option>
                                                            <option value="Instagram">Instagram</option>
                                                            <option value="LinkedIn">LinkedIn</option>
                                                            <option value="Youtube">YouTube</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="url" name="social_media_url[]" placeholder="Enter URL" required>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-success add-row">Add Row</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('social-media.index') }}" class="btn btn-danger px-4">Cancel</a>
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

<!-- JavaScript to add rows dynamically -->
<script>
    document.querySelector('.add-row').addEventListener('click', function() {
        var tableBody = document.querySelector('#socialMediaTable tbody');
        var newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td>
                <select class="form-control" name="social_media_platform[]" required>
                    <option value="">Select Platform</option>
                    <option value="Facebook">Facebook</option>
                    <option value="Twitter">Twitter</option>
                    <option value="Instagram">Instagram</option>
                    <option value="LinkedIn">LinkedIn</option>
                    <option value="Youtube">YouTube</option>
                </select>
            </td>
            <td>
                <input class="form-control" type="url" name="social_media_url[]" placeholder="Enter URL" required>
            </td>
            <td>
                <button type="button" class="btn btn-danger remove-row">Remove</button>
            </td>
        `;

        // Add the new row to the table body
        tableBody.appendChild(newRow);

        // Add event listener for remove button
        newRow.querySelector('.remove-row').addEventListener('click', function() {
            newRow.remove();
        });
    });
</script>

</body>

</html>