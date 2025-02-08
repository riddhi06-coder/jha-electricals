<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
</head>


<body>
<div id="main-wrapper">

        @include('components.frontend.header')
	 


    <!-- Page Banner Section Start -->
    <div class="page-banner-section section bg-image" 
        data-bg="{{ asset('uploads/contact/' . ($contact->banner_image ?? 'img/bg/breadcrumb-img.webp')) }}"
        style="background-image: url('{{ asset('uploads/contact/' . ($contact->banner_image ?? 'img/bg/breadcrumb-img.webp')) }}');">
        
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-banner text-center">
                        <h2>{{ $contact->banner_heading ?? 'Contact Us' }}</h2>
                        <ul class="page-breadcrumb">
                            <li><a href="{{ route('home.page') }}">Home</a></li>
                            <li>Contact Us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="contact-us-form-sec">
      <div class="container">
        <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-12 col-12">
        <div class="contact-card-area">
            <div class="row justify-content-center">
                
                <!-- Contact Number -->
                <div class="col-lg-12 col-md-6 col-sm-12 col-12">
                    <div class="contact-card">
                        <i class="fa fa-phone"></i>
                        <h4>Our Phone</h4>
                        <p>
                            <a href="tel:{{ $footer->contact_number ?? '18002028514' }}">
                                {{ $footer->contact_number }}
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Email Address -->
                <div class="col-lg-12 col-md-6 col-sm-12 col-12">
                    <div class="contact-card">
                        <i class="fa fa-envelope"></i>
                        <h4>Our Email</h4>
                        <p>
                            <a href="mailto:{{ $footer->email ?? 'customercare@jhaelectricals.com' }}">
                                {{ $footer->email }}
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Location -->
                <div class="col-lg-12 col-md-6 col-sm-12 col-12">
                    <div class="contact-card">
                        <i class="fa fa-map-marker"></i>
                        <h4>Our Location</h4>
                        <p>
                            {!! $footer->address !!}
                        </p>
                    </div>
                </div>

            </div>
            </div>
        </div>



          <div class="col-lg-8 col-md-12 col-sm-12 col-12">
            <div class="contact-page-form-area">
              <div class="contact-form bd-form details-text-area">
                <div class="contact-form-title-sec">
                  <h2>Get In Touch</h2>
                </div>
                <form id="contactForm" novalidate="true">
                  <div class="row">
                    <div class="col-lg-6 col-md-6">
                      <div class="form-group">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required
                          data-error="Please enter your name">
                        <div class="help-block with-errors"></div>
                        <i class="ri-user-3-line"></i>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                      <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Your Email"
                          required data-error="Please enter your email">
                        <div class="help-block with-errors"></div>
                        <i class="ri-mail-send-line"></i>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                      <div class="form-group">
                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                          placeholder="Your Phone Number" required data-error="Please enter your phone number">
                        <div class="help-block with-errors"></div>
                        <i class="ri-phone-line"></i>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                      <div class="form-group">
                        <input type="text" name="msg_subject" id="msg_subject" class="form-control"
                          placeholder="Subject" required data-error="Please enter a subject">
                        <div class="help-block with-errors"></div>
                        <i class="ri-booklet-line"></i>
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <div class="form-group">
                        <textarea name="message" class="form-control" id="message" cols="30" rows="3"
                          placeholder="Your Message" required data-error="Please write your message"></textarea>
                        <div class="help-block with-errors"></div>
                        <i class="ri-pencil-line"></i>
                      </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                      <div class="contact-form-btn-sec">
                        <a href="#" class="small-btn-style">Submit</a>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



    <!--=== Start Contact Map Area ===-->
    <div class="map-sec">
        <iframe src="{{ $contact->url }}" 
            width="100%" height="350" style="border:0;" 
            allowfullscreen="" loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
    <!--=== End Contact Map Area ===-->

        @include('components.frontend.footer')
        
        @include('components.frontend.main-js')




</body>
</html>