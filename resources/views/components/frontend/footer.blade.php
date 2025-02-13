<footer class="footer-section">
    <div class="upper-footer">
        <div class="container">
            <div class="row">
                <div class="col col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="widget about-widget pe-0">
                        <p>For any issues related to any products give us a call or connect with us here</p>
                        <div class="contact-ft">
                            <ul>
                                @php
                                    $footer = \App\Models\HomeFooter::first();
                                @endphp
                                <li><i class="fa fa-envelope"></i> Email: {{ $footer->email }}</li>
                                <li><i class="fa fa-phone"></i> Call: {{ $footer->contact_number }}</li>
                                <li><i class="fa fa-map-marker"></i> {!! $footer->address !!}</li>
                                <li><i class="fa fa-clock-o"></i> {{ $footer->time }}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col col-lg-1 col-md-12 col-sm-12 col-12"></div>

                <div class="col col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="widget link-widget">
                        <div class="widget-title">
                            <h3>Quick Links</h3>
                        </div>
                        <ul>
                            <li><a href="{{ route('about-us.page') }}">About Us</a></li>
                            <li><a href="{{ route('products.category') }}">Products</a></li>
                            <li><a href="{{ route('photo.gallery') }}">Photo Gallery</a></li>
                            <li><a href="{{ route('career.resources') }}">Career Resources</a></li>
                            <li><a href="#">Blogs</a></li>
                            <li><a href="{{ route('product-category.index') }}">Shopping Guide</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="{{ route('contact.us') }}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="widget subscribe">
                        <div class="widget-title">
                            <h3>Newsletter</h3>
                        </div>
                        <p>Subscribe to our newsletters now and stay up to date with new collections, the latest lookbooks and exclusive offers.</p>
                        <form action="#">
                            <div class="form-field">
                                <input type="email" placeholder="Enter Your Email Address" required>
                                <button type="submit" class="small-btn-style">SUBSCRIBE!</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container -->
    </div>

    <div class="lower-footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="text-center">
                        <p>Copyright © {{ date('Y') }} Jha Electricals. All rights reserved. Designed By 
                            <a href="https://matrixbricks.com/" target="_blank">Matrix Bricks</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
