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
                  <h4>Add Company Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('home-footer.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Company Details</li>
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
                        <h4>Company Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('home-footer.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Email -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="email">Email Address <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="email" type="email" name="email" placeholder="Enter Email Address" required>
                                        <div class="invalid-feedback">Please enter a valid email address.</div>
                                    </div>


                                    <!-- Contact Number -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="contact_number">Contact Number <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="contact_number" type="tel" name="contact_number" placeholder="Enter Contact Number" required>
                                        <div class="invalid-feedback">Please enter a valid 10-digit contact number.</div>
                                    </div>


                                    <!-- Address -->
                                    <div class="col-xxl-4 col-sm-12">
                                        <label class="form-label" for="address">Address <span class="txt-danger">*</span></label>
                                        <textarea class="form-control" id="summernote" name="address" placeholder="Enter Address" required rows="3"></textarea>
                                        <div class="invalid-feedback">Please enter an address.</div>
                                    </div>

                                    <!-- Time -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="blog_time">Time <span class="txt-danger">*</span></label>
                                        <textarea class="form-control" id="blog_time" name="blog_time" placeholder="Enter Time" required rows="3"></textarea>
                                        <div class="invalid-feedback">Please enter a Time.</div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="col-12 text-end">
                                        <a href="{{ route('home-footer.index') }}" class="btn btn-danger px-4">Cancel</a>
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

</body>

</html>