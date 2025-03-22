@php
    $categories = DB::table('master_category')
        ->select('master_category.id as category_id', 'master_category.category_name', 
                 'master_sub_category.id as subcategory_id', 'master_sub_category.sub_category_name',
                 'master_products.id as product_id', 'master_products.product_name')
        ->leftJoin('master_sub_category', function ($join) {
            $join->on('master_category.id', '=', 'master_sub_category.category_id')
                ->whereNull('master_sub_category.deleted_by');
        })
        ->leftJoin('master_products', function ($join) {
            $join->on('master_sub_category.id', '=', 'master_products.sub_category_id')
                ->whereNull('master_products.deleted_by');
        })
        ->whereNull('master_category.deleted_by')
        ->get()
        ->groupBy('category_id'); // Group by category
@endphp

 
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
                    <a href="{{ route('home.page') }}"><img src="{{ asset('frontend/assets/img/logo/jha-electricals-logo.png') }}" alt="jha electricals logo" width="170" height="39" class="img-fluid"></a>
                  </div>
                  <nav class="main-menu main-menu-two">
                    <ul>
                      <li><a href="{{ route('about-us.page') }}">About Us</a></li>
                      
                 
                      <li>
                      <a href="{{ route('products.category') }}">Products</a>
                      <ul class="sub-menu">
                          @foreach ($categories as $category_id => $categoryGroup)
                              @php 
                                  $category = $categoryGroup->first();
                              @endphp
                              <li>
                                  <a href="#">{{ $category->category_name }}</a>
                                  @if ($categoryGroup->whereNotNull('subcategory_id')->count())
                                      <ul class="sub-menu mega-menu four-column left-0">
                                          @foreach ($categoryGroup->groupBy('subcategory_id') as $subcategory_id => $subcategoryGroup)
                                              @php 
                                                  $subcategory = $subcategoryGroup->first();
                                              @endphp
                                              <li>
                                                  <ul>
                                                      <li><a href="#" class="item-title">{{ $subcategory->sub_category_name }}</a></li>
                                                      @foreach ($subcategoryGroup->whereNotNull('product_id') as $product)
                                                          <li><a href="#">{{ $product->product_name }}</a></li>
                                                      @endforeach
                                                  </ul>
                                              </li>
                                          @endforeach
                                      </ul>
                                  @endif
                              </li>
                          @endforeach
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
                          <li><a href="{{ route('commercial.lighting') }}">Commercial Lighting</a></li>
                        </ul>
                      </li>
                      <li><a href="{{ route('career.resources') }}">Career Resources</a></li>
                        <li><a href="{{ route('photo.gallery') }}">Photo Gallery</a></li>
                        <li><a href="{{ route('blogs') }}">Blog</a></li>
                        <li><a href="{{ route('contact.us') }}">Contact Us</a></li>
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
                        <a href="{{ route('home.page') }}">
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
                    <li><a href="{{ route('commercial.lighting') }}">Commercial Lighting</a></li>
                  </ul>
                </li>
                <li class="menu-item-has-children"><a href="{{ route('career.resources') }}">Career Resources</a></li>
                <li class="menu-item-has-children"><a href="{{ route('photo.gallery') }}">Photo Gallery</a></li>
                <li class="menu-item-has-children"><a href="#">Blog</a></li>
                <li class="menu-item-has-children"><a href="{{ route('contact.us') }}">Contact Us</a></li>
              </ul>
            </nav>
          
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