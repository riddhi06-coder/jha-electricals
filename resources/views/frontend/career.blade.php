<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
</head>


<body>
<div id="main-wrapper">

        @include('components.frontend.header')
	 
        @php
            $bannerImage = $career->first() ? asset('uploads/career/' . $career->first()->banner_image) : asset('uploads/application/default-banner.webp');
        @endphp

    <!-- Page Banner Section Start -->
    <div class="page-banner-section section bg-image"
        data-bg="{{ $bannerImage }}"
        style="background-image: url('{{ $bannerImage }}');">
        <div class="container">
            <div class="row">
                <div class="col">
                @php
                    $firstCareer = $career->first(); 
                @endphp

                @if ($firstCareer)
                    <div class="page-banner text-center">
                        <h2>{{ $firstCareer->banner_heading }}</h2>
                        <ul class="page-breadcrumb">
                            <li><a href="{{ route('home.page') }}">Home</a></li>
                            <li>{{ $firstCareer->banner_heading }}</li>
                        </ul>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>

    <div class="process-area-two career-resources-process-sec">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="single-process-box-two style-one">
              <div class="process-icon-thumb-two">
                <img src="{{ asset('frontend/assets/img/icon/explore-opp-icon.png') }}" alt="">
              </div>
              <div class="process-two-content">
                <h4>Explore Opportunities</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="single-process-box-two">
              <div class="process-icon-thumb-two">
                <img src="{{ asset('frontend/assets/img/icon/submit-application-icon.png') }}" alt="">
              </div>
              <div class="process-two-content">
                <h4>Submit Your Application</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="single-process-box-two style-three">
              <div class="process-icon-thumb-two">
                <img src="{{ asset('frontend/assets/img/icon/our-team-icon.png') }}" alt="">
              </div>
              <div class="process-two-content">
                <h4>Join Our Team</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="careers-current-opening-sec">
      <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
            <div class="section-title mb-30 wow fadeInDown  animated" data-wow-delay="400ms" data-wow-duration="400ms"
              style="visibility: visible; animation-duration: 400ms; animation-delay: 400ms; animation-name: fadeInDown;">
                @php
                    $firstCareer = $career->first(); 
                @endphp

                @if ($firstCareer)
                    <h2>
                        {{ $firstCareer->title }}
                    </h2>
                @endif
            </div>
            
            <div class="careers-current-opening-accordian-sec">
                <div class="accordion" id="faqAccordion">
                    @foreach ($career as $index => $job)
                        <!-- Accordion Item -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading{{ $index }}">
                                <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#faqCollapse{{ $index }}" 
                                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" 
                                    aria-controls="faqCollapse{{ $index }}">
                                    {{ $job->role }}
                                </button>
                            </h2>
                            <div id="faqCollapse{{ $index }}" 
                                class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" 
                                aria-labelledby="faqHeading{{ $index }}" 
                                data-bs-parent="#faqAccordion">
                                
                                <div class="accordion-body">
                                <div class="careers-curr-open-accordion-content-sec">
                                    @if (!empty($job->company_overview))
                                        <h3>Company Overview:</h3>
                                        <p>{{ $job->company_overview }}</p>
                                        <hr>
                                    @endif

                                    @if (!empty($job->job_title))
                                        <h3>Job Title:</h3>
                                        <p>{{ $job->job_title }}</p>
                                        <hr>
                                    @endif

                                    @if (!empty($job->location))
                                        <h3>Location:</h3>
                                        <p>{{ $job->location }}</p>
                                        <hr>
                                    @endif

                                    @if (!empty($job->job_description))
                                        <h3>Job Description:</h3>
                                        <p>{{ $job->job_description }}</p>
                                        <hr>
                                    @endif

                                    @if (!empty($job->responsibilities))
                                        <h3>Responsibilities:</h3>
                                        {!! $job->responsibilities !!}
                                        <hr>
                                    @endif

                                    @if (!empty($job->job_requirements))
                                        <h3>Requirements:</h3>
                                        <ul>
                                            @foreach (explode('.', $job->job_requirements) as $requirement)
                                                @if (trim($requirement) != '') 
                                                    <li>{{ trim($requirement) }}.</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <hr>
                                    @endif

                                    @if (!empty($job->job_benefits))
                                        <h3>Benefits:</h3>
                                        <ul>
                                            @foreach (explode('.', $job->job_benefits) as $benefit)
                                                @if (trim($benefit) != '') 
                                                    <li>{{ trim($benefit) }}.</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <hr>
                                    @endif

                                    @if (!empty($job->job_disclaimer))
                                        <h3>Disclaimer:</h3>
                                        <p>{{ $job->job_disclaimer }}</p>
                                        <hr>
                                    @endif

                                    <div class="career-resou-apply-now-btn">
                                        <a href="#" class="small-btn-style apply-now-btn" data-bs-toggle="modal" data-bs-target="#applyNowModal" data-role="{{ $job->role }}">Apply Now</a>
                                    </div>
                                </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="sub-ml-sec">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="cta-content cta-title-sec">
              <h3>How to Apply</h3>
              <!--<p>Interested candidates are invited to submit their resume/CV along with a cover-->
              <!--  letter highlighting their relevant experience and suitability for the position.</p>-->
              <!--<p>Please send your application to <a href="mailto:hr@jhaelectricals.com">hr@jhaelectricals.com</a></p>-->
              <p>Interested candidates are invited to submit their resume/CV to <a href="mailto:hr@jhaelectricals.com">hr@jhaelectricals.com</a> and CC: <a href="sales@jhaelecticals.com">sales@jhaelecticals.com.</a></p>
            </div>
            <div class="cta-btn-sec">
              <a href="{{ route('contact.us') }}" class="small-btn-style">Contact Us</a>
            </div>
          </div>
        </div>
      </div>
    </div>

     <!-- Career Page Modal -->
    <div class="modal fade careers-apply-now-modal-sec" id="applyNowModal" tabindex="-1" aria-labelledby="applyNowModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applyNowModalLabel">Apply Now</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('career.apply') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="applicantName" class="form-label">Name <span class="txt-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="applicantName" value="{{ old('name') }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="applicantEmail" class="form-label">Email <span class="txt-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="applicantEmail" value="{{ old('email') }}" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="applicantPhone" class="form-label">Phone Number <span class="txt-danger">*</span></label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="applicantPhone" 
                                pattern="[0-9]{10}" maxlength="10" value="{{ old('phone') }}" required>
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="applicationSubject" class="form-label">Subject <span class="txt-danger">*</span></label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" id="applicationSubject" value="{{ old('subject') }}" required>
                            @error('subject')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="positionAppliedFor" class="form-label">Position Applied For <span class="txt-danger">*</span></label>
                            <input type="text" class="form-control @error('position') is-invalid @enderror" name="position" id="positionAppliedFor" value="{{ old('position') }}" required readonly>
                            @error('position')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="resumeUpload" class="form-label">Upload Resume <span class="txt-danger">*</span></label>
                        <input type="file" class="form-control @error('resume') is-invalid @enderror" name="resume" id="resumeUpload" 
                            accept=".pdf" required onchange="validateResume(this)">
                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                        @error('resume')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="career-apply-now-form text-center">
                        <button type="submit" class="small-btn-style">Submit Application</button>
                    </div>
                </form>

            </div>
            </div>
        </div>
    </div>


        @include('components.frontend.footer')
        
        @include('components.frontend.main-js')


<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".apply-now-btn").forEach(function (button) {
            button.addEventListener("click", function () {
                let jobRole = this.getAttribute("data-role"); 
                document.getElementById("positionAppliedFor").value = jobRole; 
            });
        });
    });


</script>


</body>
</html>