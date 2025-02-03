  <!-- Footer -->
  <footer id="footer" class="footer">
            <div class="footer-wrap">
            <div class="footer-body">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="footer-infor">
                    <div class="footer-logo">
                        <a href="#">
                            <img src="{{ asset('frontend/assets/images/logo/logo.webp') }}" width="144px" height="26px" alt="Murupp Logo">
                        </a>
                    </div>
                    @php
                        $footer = \App\Models\Footer::first();
                    @endphp
                    <div class="footer-address">
                        <p>{!! $footer->about !!}</p>
                        <a href="{{ $footer->map_url ?? '#' }}" class="tf-btn-default fw-6" target="_blank">GET DIRECTION<i class="icon-arrowUpRight"></i></a>
                    </div>

                    <ul class="footer-info">
                        <li>
                            <i class="icon-mail"></i>
                            <p>{{ $footer->email ?? '' }}</p>
                        </li>
                        <li>
                            <i class="icon-phone"></i>
                            <p>{{ $footer->contact_number ?? '' }}</p>
                        </li>
                    </ul>
                    <ul class="tf-social-icon">
                        <li>
                            <a href="{{ json_decode($footer->media_link ?? '[]')[0] ?? '#' }}" class="social-facebook" aria-label="Facebook">
                                <i class="icon icon-fb"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ json_decode($footer->media_link ?? '[]')[1] ?? '#' }}" class="social-twiter" aria-label="Twitter">
                                <i class="icon icon-x"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ json_decode($footer->media_link ?? '[]')[2] ?? '#' }}" class="social-instagram" aria-label="Instagram">
                                <i class="icon icon-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ json_decode($footer->media_link ?? '[]')[3] ?? '#' }}" class="social-pinterest" aria-label="Pinterest">
                                <i class="icon icon-pinterest"></i>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="col-lg-5">
                <div class="footer-menu">
                    <div class="footer-col-block">
                        <div class="footer-heading text-button footer-heading-mobile">
                            Information
                        </div>
                        <div class="tf-collapse-content">
                            <ul class="footer-menu-list">
                                <li class="text-caption-1">
                                    <a href="#" class="footer-menu_item">About Us</a>
                                </li>
                                <li class="text-caption-1">
                                    <a href="#" class="footer-menu_item">New Collection</a>
                                </li>
                                <li class="text-caption-1">
                                    <a href="#" class="footer-menu_item">Shop</a>
                                </li>
                                <li class="text-caption-1">
                                    <a href="#" class="footer-menu_item">Contact us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer-col-block">
                        <div class="footer-heading text-button footer-heading-mobile">
                            Customer Services
                        </div>
                        <div class="tf-collapse-content">
                            <ul class="footer-menu-list">
                                <li class="text-caption-1">
                                    <a href="#" class="footer-menu_item">Shipping</a>
                                </li>
                                <li class="text-caption-1">
                                    <a href="#" class="footer-menu_item">Return & Refund</a>
                                </li>
                                <li class="text-caption-1">
                                    <a href="#" class="footer-menu_item">Privacy Policy</a>
                                </li>
                                <li class="text-caption-1">
                                    <a href="#" class="footer-menu_item">Terms & Conditions</a>
                                </li>
                                <li class="text-caption-1">
                                    <a href="#" class="footer-menu_item">Orders FAQs</a>
                                </li>
                                <li class="text-caption-1">
                                    <a href="#" class="footer-menu_item">My Wishlist</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="footer-col-block">
                    <div class="footer-heading text-button footer-heading-mobile">
                        Newsletter
                    </div>
                    <div class="tf-collapse-content">
                        <div class="footer-newsletter">
                            <p class="text-caption-1">Sign up for our newsletter and get 10% off your first purchase</p>
                            <form id="subscribe-form" action="#" class="form-newsletter subscribe-form" method="post" accept-charset="utf-8" data-mailchimp="true">
                                <div id="subscribe-content" class="subscribe-content">
                                    <fieldset class="email">
                                        <input id="subscribe-email" type="email" name="email-form" class="subscribe-email" placeholder="Enter your e-mail" tabindex="0" aria-required="true">
                                    </fieldset>
                                    <div class="button-submit">
                                        <button id="subscribe-button" class="subscribe-button" type="button" aria-label="Subscribe">
                                            <i class="icon icon-arrowUpRight"></i>
                                        </button>
                                    </div>
                                </div>
                                <div id="subscribe-msg" class="subscribe-msg"></div>
                            </form>
                            <div class="tf-cart-checkbox">
                                <div class="tf-checkbox-wrapp">
                                    <input class="" type="checkbox" id="footer-Form_agree" name="agree_checkbox">
                                    <div>
                                        <i class="icon-check"></i>
                                    </div>
                                </div>
                                <label class="text-caption-1" for="footer-Form_agree">
                                    By clicking subscribe, you agree to the <a class="fw-6 link" href="#">Terms of Service</a> and <a class="fw-6 link" href="#">Privacy Policy</a>.
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                <div class="footer-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="footer-bottom-wrap">
                                    <div class="left">
                                        <p class="text-caption-1">Copyright © 2025 Murupp. All rights reserved. Designed By <a href="https://www.matrixbricks.com/" target="_bl">Matrix Bricks</a></p>
                                    </div>
                                    <div class="tf-payment">
                                        <p class="text-caption-1">Payment:</p>
                                        <ul>
                                            <li>
                                                <img src="{{ asset('frontend/assets/images/payment/img-1.png') }}" alt="">
                                            </li>
                                            <li>
                                                <img src="{{ asset('frontend/assets/images/payment/img-2.png') }}" alt="">
                                            </li>
                                            <li>
                                                <img src="{{ asset('frontend/assets/images/payment/img-3.png') }}" alt="">
                                            </li>
                                            <li>
                                                <img src="{{ asset('frontend/assets/images/payment/img-4.png') }}" alt="">
                                            </li>
                                            <li>
                                                <img src="{{ asset('frontend/assets/images/payment/img-5.png') }}" alt="">
                                            </li>
                                            <li>
                                                <img src="{{ asset('frontend/assets/images/payment/img-6.png') }}" alt="">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /Footer -->

        <a href="https://web.whatsapp.com/" class="float" target="_blank">
<i class="fab fa-whatsapp my-float"></i>
</a>