  <!--Header section start-->
  <section class="topbar desktop-topbar">
      <div class="container">
          <div class="row">
              <div class="col-md-3">
                  <div class="topbar-left">
                      <ul>
                          <!-- Loop through the social media links -->
                          @foreach (\App\Models\SocialMedia::all()->whereNull('deleted_by') as $link)
                              <li><a href="{{ $link->url }}" target="_blank"><i class="fa fa-{{ strtolower($link->platform) }}"></i></a></li>
                          @endforeach
                      </ul>
                  </div>
              </div>
              <div class="col-md-9">
                  <div class="topbar-right">
                      <ul>
                          <!-- Display contact number and email from the footer model -->
                          @php
                              $footer = \App\Models\HomeFooter::first();
                          @endphp

                          <li>Customer Care : <a href="tel:{{ $footer->contact_number }}">{{ $footer->contact_number }}</a></li>
                          <li>|</li>
                          <li><a href="mailto:{{ $footer->email }}">{{ $footer->email }}</a></li>
                          <li>|</li>
                          <li>
                              <div id="google_translate_element"></div>
                              <script type="text/javascript">
                                  function googleTranslateElementInit() {
                                      new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
                                  }
                              </script>
                              <label class="dropdown flag">
                                  <div class="dd-button">
                                      <span>Select Language</span>
                                  </div>
                                  <input type="checkbox" class="dd-input" id="test">
                                  <ul class="dd-menu">
                                      <li><a class="flag_link eng" data-lang="en">English</a></li>
                                      <li><a class="flag_link eng" data-lang="hi">Hindi</a></li>
                                  </ul>
                              </label>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </section>


      <header class="header header-sticky d-none d-lg-block">
        <div class="header-default">
          <div
            class="container">
            <div class="row align-items-center">
              <!-- Header Logo Start -->
              <div class="col-lg-12">
                <div class="header-nav d-flex justify-content-between align-items-center">
                  <div class="header-logo text-center">
                    <a href="./"><img src="{{ asset('frontend/assets/img/logo/jha-electricals-logo.png') }}" alt="jha electricals logo" width="170" height="39" class="img-fluid"></a>
                  </div>
                  <nav class="main-menu main-menu-two">
                    <ul>
                      <li><a href="{{ route('about-us.page') }}">About Us</a></li>
                      <li>
                        <a href="products.html">Products</a>
                        <ul class="mega-menu four-column left-0">
                          <li>
                            <a href="led-panel-lights.html" class="item-link">LED Panel Lights</a>
                            <ul>
                              <li><a href="led-panel-light-square-round-conceaded-type.html">LED Panel Light(Square/Round Conceaded Type)</a></li>
                              <li><a href="#">LED Panel Light - Glow Model</a></li>
                              <li><a href="#">LED Panel Light - Polyglow</a></li>
                              <li><a href="#">LED Panel Light - Zenith</a></li>
                              <li><a href="#">LED Panel Light (Square+Round Surface Type)</a></li>
                              <li><a href="#">Twister Surface Light With Holder</a></li>
                              <li><a href="#">LED Panel Light (Rectangle Concealed Type)</a></li>
                              <li><a href="#">LED Down Light</a></li>
                              <li><a href="#" class="item-title">COB Spot Lights</a></li>
                              <li><a href="#">COB Spot Lights - Flat Model(Ro./Sq. Movable Type)</a></li>
                              <li><a href="#">Delta COB Spot Light (Round Conceaded Type)</a></li>
                            </ul>
                          </li>
                          <li>
                            <ul>
                              <li><a href="#">Curve COB Spot Light (Round Conceaded Type)</a></li>
                              <li><a href="#">COB Spot Lights</a></li>
                              <li><a href="#">Silver Chrome/Rose Gold Delta COB Spot Light(Round Conceaded Type)</a></li>
                              <li><a href="#">New COB Lens</a></li>
                              <li><a href="#">COB Spot Light (Conceaded & Junction Box Fittigs)</a></li>
                              <li><a href="#">COB Spot Light Surface Cylinder & Hanging Light</a></li>
                              <li><a href="#">COB Spot Light (Spike & Wall Outdoor Light)</a></li>
                              <li><a href="#">PC Lens COB Spot Light(Tiltable)</a></li>
                              <li><a href="#" class="item-title">Outdoor Wall Light</a></li>
                              <li><a href="#" class="item-title">LED Bulb / Lamp Light</a></li>
                              <li><a href="#" class="item-title">LED Tube / T</a></li>
                              <li><a href="#" class="item-title">LED Track Light(ARM Type)</a></li>
                              <li><a href="#" class="item-title">LED Track Light(Cylinder Type)</a></li>
                            </ul>
                          </li>
                          <li>
                            <ul>
                              <li><a href="#" class="item-title">LED Track Light(Linear Type)</a></li>
                              <li><a href="#" class="item-title">LED Bulk Head Alfa</a></li>
                              <li><a href="#" class="item-title">LED Street Light</a></li>
                              <li><a href="#">LED Street Light(Super Delux Model)</a></li>
                              <li><a href="#">Super Lens LED Street Light</a></li>
                              <li><a href="#">Lens LED Street Light (Back Side Driver System)</a></li>
                              <li><a href="#" class="item-title">LED Flood Light</a></li>
                              <li><a href="#">Flood Light</a></li>
                              <li><a href="#">Back Choke Flood Light</a></li>
                              <li><a href="#">Down Choke Super Delux Flood Light</a></li>
                              <li><a href="#">Down Choke Lens Flood Light</a></li>
                              <li><a href="#" class="item-title">High Bay Light</a></li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <span>Service & Support</span>
                        <ul class="sub-menu">
                          <li><a href="{{ route('professional.installation') }}">Professional Installation</a></li>
                          <li><a href="{{ route('prewiring.consultation') }}">Pre-Wiring Consultations</a></li>
                          <li><a href="{{ route('postinstallation.training') }}">Post-Installation Training</a></li>
                          <!--<li><a href="#">Online Knowledge Base</a></li>-->
                        </ul>
                      </li>
                      <li>
                        <span>Application Area</span>
                        <ul class="sub-menu">
                          <li><a href="{{ route('residential.lighting') }}">Residential Lighting</a></li>
                          <li><a href="commercial-lighting.html">Commercial Lighting</a></li>
                        </ul>
                      </li>
                      <li><a href="career-resources.html">Career Resources</a></li>
                        <li><a href="photo-gallery.html">Photo Gallery</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="contact-us.html">Contact Us</a></li>
                    </ul>
                  </nav>
                  <div class="header-right_wrap d-flex">
                    <div class="header-search">
                      <button class="header-search-toggle"><i
                        class="fa fa-search"></i></button>
                      <div class="header-search-form">
                        <form action="#">
                          <input type="text" placeholder="Type and hit enter">
                          <button><i class="fa fa-search"></i></button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Header Logo Start -->
            </div>
          </div>
        </div>
      </header>
      <!--Header section end-->
      <!--Header Mobile section start-->
      <header class="header-mobile d-block d-lg-none">
        <div class="header-bottom menu-right">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="header-mobile-navigation d-block d-lg-none">
                  <div class="row align-items-center">
                    <div class="col-6 col-md-6">
                      <div class="header-logo">
                        <a href="./">
                        <img src="{{ asset('frontend/assets/img/logo/jha-electricals-logo.png') }}" class="img-fluid" alt="jha electricals logo">
                        </a>
                      </div>
                    </div>
                    <div class="col-6 col-md-6">
                      <div class="mobile-navigation text-end">
                        <div class="header-icon-wrapper">
                          <ul class="icon-list justify-content-end">
                            <!-- <li>
                              <div class="header-cart-icon">
                                <a href="cart.html"><i
                                  class="ion-bag"></i><span>2</span></a>
                              </div>
                              </li> -->
                            <li>
                              <a href="javascript:void(0)" class="mobile-menu-icon"
                                id="mobile-menu-trigger"><i class="fa fa-bars"></i></a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--Mobile Menu start-->
            <div class="row">
              <div class="col-12 d-flex d-lg-none">
                <div class="mobile-menu"></div>
              </div>
            </div>
            <!--Mobile Menu end-->
          </div>
        </div>
      </header>
      <!--Header Mobile section end-->
      <!-- Offcanvas Menu Start -->
      <div class="offcanvas-mobile-menu" id="offcanvas-mobile-menu">
        <a href="javascript:void(0)" class="offcanvas-menu-close" id="offcanvas-menu-close-trigger">
        <i class="fa fa-close"></i>
        </a>
        <div class="offcanvas-wrapper">
          <div class="offcanvas-inner-content">
            <div class="offcanvas-mobile-search-area">
              <form action="#">
                <input type="search" placeholder="Search ...">
                <button type="submit"><i class="fa fa-search"></i></button>
              </form>
            </div>
            <nav class="offcanvas-navigation">
              <ul>
                <li class="menu-item-has-children"><a href="{{ route('about-us.page') }}">About Us</a>
                </li>
                <li class="menu-item-has-children">
                  <a href="products.html">Products</a>
                  <ul class="submenu2">
                    <li class="menu-item-has-children">
                      <a href="led-panel-lights.html">LED Panel Lights</a>
                      <ul class="submenu2">
                        <li><a href="led-panel-light-square-round-conceaded-type.html">LED Panel Light(Square/Round Conceaded Type)</a></li>
                        <li><a href="#">LED Panel Light - Glow Model</a></li>
                        <li><a href="#">LED Panel Light - Polyglow</a></li>
                        <li><a href="#">LED Panel Light - Zenith</a></li>
                        <li><a href="#">LED Panel Light (Square+Round Surface Type)</a></li>
                        <li><a href="#">Twister Surface Light With Holder</a></li>
                        <li><a href="#">LED Panel Light (Rectangle Concealed Type)</a></li>
                        <li><a href="#">LED Down Light</a></li>
                      </ul>
                    </li>
                    <li class="menu-item-has-children">
                      <a href="#">COB Spot Lights</a>
                      <ul class="submenu2">
                        <li><a href="#">COB Spot Lights - Flat Model(Ro./Sq. Movable Type)</a></li>
                        <li><a href="#">Delta COB Spot Light (Round Conceaded Type)</a></li>
                        <li><a href="#">Curve COB Spot Light (Round Conceaded Type)</a></li>
                        <li><a href="#">COB Spot Lights</a></li>
                        <li><a href="#">Silver Chrome/Rose Gold Delta COB Spot Light(Round Conceaded Type)</a></li>
                        <li><a href="#">New COB Lens</a></li>
                        <li><a href="#">COB Spot Light (Conceaded & Junction Box Fittigs)</a></li>
                        <li><a href="#">COB Spot Light Surface Cylinder & Hanging Light</a></li>
                        <li><a href="#">COB Spot Light (Spike & Wall Outdoor Light)</a></li>
                        <li><a href="#">PC Lens COB Spot Light(Tiltable)</a></li>
                      </ul>
                    </li>
                    <li class="menu-item-has-children"><a href="#">Outdoor Wall Light</a></li>
                    <li class="menu-item-has-children"><a href="#">LED Bulb / Lamp Light</a></li>
                    <li class="menu-item-has-children"><a href="#">LED Tube / T</a></li>
                    <li class="menu-item-has-children"><a href="#">LED Track Light(ARM Type)</a></li>
                    <li class="menu-item-has-children"><a href="#">LED Track Light(Cylinder Type)</a></li>
                    <li class="menu-item-has-children"><a href="#">LED Track Light(Linear Type)</a></li>
                    <li class="menu-item-has-children"><a href="#">LED Bulk Head Alfa</a></li>
                    <li class="menu-item-has-children">
                      <a href="#">LED Street Light</a>
                      <ul class="submenu2">
                        <li><a href="#">LED Street Light(Super Delux Model)</a></li>
                        <li><a href="#">Super Lens LED Street Light</a></li>
                        <li><a href="#">Lens LED Street Light (Back Side Driver System)</a></li>
                      </ul>
                    </li>
                    <li class="menu-item-has-children">
                      <a href="#">LED Flood Light</a>
                      <ul class="submenu2">
                        <li><a href="#">Flood Light</a></li>
                        <li><a href="#">Back Choke Flood Light</a></li>
                        <li><a href="#">Down Choke Super Delux Flood Light</a></li>
                        <li><a href="#">Down Choke Lens Flood Light</a></li>
                      </ul>
                    </li>
                    <li class="menu-item-has-children"><a href="#">High Bay Light</a></li>
                  </ul>
                </li>
                <li class="menu-item-has-children">
                  <a href="#">Service & Support</a>
                  <ul class="submenu2">
                    <li><a href="{{ route('professional.installation') }}">Professional Installation</a></li>
                    <li><a href="{{ route('prewiring.consultation') }}">Pre-Wiring Consultations</a></li>
                    <li><a href="{{ route('postinstallation.training') }}">Post-Installation Training</a></li>
                    <!--<li><a href="#">Online Knowledge Base</a></li>-->
                  </ul>
                </li>
                <li class="menu-item-has-children">
                  <a href="#">Application Area</a>
                  <ul class="submenu2">
                    <li><a href="{{ route('residential.lighting') }}">Residential Lighting</a></li>
                    <li><a href="commercial-lighting.html">Commercial Lighting</a></li>
                  </ul>
                </li>
                <li class="menu-item-has-children"><a href="career-resources.html">Career Resources</a></li>
                <li class="menu-item-has-children"><a href="photo-gallery.html">Photo Gallery</a></li>
                <li class="menu-item-has-children"><a href="#">Blog</a></li>
                <li class="menu-item-has-children"><a href="contact-us.html">Contact Us</a></li>
              </ul>
            </nav>
            <!-- <div class="offcanvas-settings">
              <nav class="offcanvas-navigation">
                <ul>
                  <li class="menu-item-has-children">
                    <a href="#">MY ACCOUNT </a>
                    <ul class="submenu2">
                      <li><a href="login-register.html">Register</a></li>
                      <li><a href="login-register.html">Login</a></li>
                    </ul>
                  </li>
                  <li class="menu-item-has-children">
                    <a href="#">CURRENCY: USD </a>
                    <ul class="submenu2">
                      <li><a href="javascript:void(0)">€ Euro</a></li>
                      <li><a href="javascript:void(0)">$ US Dollar</a></li>
                    </ul>
                  </li>
                  <li class="menu-item-has-children">
                    <a href="#">LANGUAGE: EN-GB </a>
                    <ul class="submenu2">
                      <li><a href="javascript:void(0)"><img src="./images/icons/en-gb.png"
                        alt="English"> English</a></li>
                      <li><a href="javascript:void(0)"><img src="./images/icons/de-de.png"
                        alt="Germany"> Germany</a></li>
                    </ul>
                  </li>
                </ul>
              </nav>
              </div> -->
            <div class="offcanvas-widget-area">
              <div class="off-canvas-contact-widget">
                <div class="header-contact-info">
                  <ul class="header-contact-info-list">
                    <li><i class="fa fa-phone"></i> <a href="tel:1800-202-8514">1800-202-8514</a>
                    </li>
                    <li><i class="fa fa-envelope"></i> <a href="mailto:customercare@jhaelectricals.com">customercare@jhaelectricals.com</a></li>
                  </ul>
                </div>
              </div>
              <!--Off Canvas Widget Social Start-->
              <div class="off-canvas-widget-social">
                <a href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
                <a href="#" title="Twitter"><i class="fa fa-twitter"></i></a>
                <a href="#" title="LinkedIn"><i class="fa fa-instagram"></i></a>
                <a href="#" title="Youtube"><i class="fa fa-linkedin"></i></a>
                <a href="#" title="Vimeo"><i class="fa fa-youtube"></i></a>
              </div>
              <!--Off Canvas Widget Social End-->
            </div>
          </div>
        </div>
      </div>
      <!-- Offcanvas Menu End -->