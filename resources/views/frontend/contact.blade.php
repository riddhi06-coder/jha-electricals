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
                        <a href="https://maps.app.goo.gl/1n97eYHCXh4vM7QV7" target="_blank" rel="noopener noreferrer">
                            {!! $footer->address !!}
                        </a>
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
                    <form id="contactForm" method="POST" action="{{ route('contact.store') }}" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Your Name *" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <i class="ri-user-3-line"></i>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email *" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <i class="ri-mail-send-line"></i>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Your Phone Number*" required pattern="\d{10}" maxlength="10">
                                    @error('phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <i class="ri-phone-line"></i>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="msg_subject" id="msg_subject" class="form-control @error('msg_subject') is-invalid @enderror" placeholder="Subject*" required>
                                    @error('msg_subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <i class="ri-booklet-line"></i>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea name="message" class="form-control @error('message') is-invalid @enderror" id="message" cols="30" rows="3" placeholder="Your Message*" required></textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <i class="ri-pencil-line"></i>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="contact-form-btn-sec">
                                    <button type="submit" class="small-btn-style">Submit</button>
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