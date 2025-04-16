@php
    $categories = DB::table('master_category')
        ->select(
            'master_category.id as category_id', 
            'master_category.category_name', 
            'master_category.slug as category_slug',  // Added category slug
            'master_sub_category.id as subcategory_id', 
            'master_sub_category.sub_category_name',
            'master_sub_category.slug as subcategory_slug',  // Added subcategory slug
            'master_products.id as product_id', 
            'master_products.product_name',
            'master_products.slug as product_slug',  // Added product slug
        )
        ->leftJoin('master_sub_category', function ($join) {
            $join->on('master_category.id', '=', 'master_sub_category.category_id')
                ->whereNull('master_sub_category.deleted_by');
        })
        ->leftJoin('master_products', function ($join) {
            $join->on('master_sub_category.id', '=', 'master_products.sub_category_id')
                ->whereNull('master_products.deleted_by');
        })
        ->whereNull('master_category.deleted_at')
        ->whereNull('master_sub_category.deleted_at')
        ->get()
        ->groupBy('category_id'); // Group by category
@endphp

 <style>
      .search-dropdown {
        position: absolute;
        width: 100%;
        background: white;
        border: 1px solid #ccc;
        max-height: 300px;
        overflow-y: auto;
        z-index: 1000;
    }

    .search-item {
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #eee;
    }

    .search-item a {
        text-decoration: none;
        color: black;
        font-weight: bold;
    }

    .search-item:hover {
        background: #f5f5f5;
    }

    .header-search-form {
        display: none;
    }

    .header-search-form.active {
        display: block;
    }

  </style>



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
                                                        <li><a href="{{ route('product.page', ['slug' => $subcategory->subcategory_slug]) }}" class="item-title">{{ $subcategory->sub_category_name }}</a></li>
                                                        @foreach ($subcategoryGroup->whereNotNull('product_id') as $product)
                                                            <li><a href="{{ route('product-details', ['slug' => $product->product_slug]) }}">{{ $product->product_name }}</a></li>
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


                      <!-- <li>
                        <a href="products.html">Products</a>
                        <ul class="sub-menu">
                          <li><a href="#">Lighting</a>
                            <ul class="sub-menu mega-menu four-column left-0">
                              <li>
                                <ul>
                                  <li><a href="led-panel-lights.html" class="item-title">LED Panel Lights</a></li>
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
                                  <li><a href="#">Curve COB Spot Light (Round Conceaded Type)</a></li>
                                </ul>
                              </li>
                              <li>
                                <ul>
                                  <li><a href="#">COB Spot Lights</a></li>
                                  <li><a href="#">Silver Chrome/Rose Gold Delta COB Spot Light(Round Conceaded Type)</a>
                                  </li>
                                  <li><a href="#">New COB Lens</a></li>
                                  <li><a href="#">COB Spot Light (Conceaded &amp; Junction Box Fittigs)</a></li>
                                  <li><a href="#">COB Spot Light Surface Cylinder &amp; Hanging Light</a></li>
                                  <li><a href="#">COB Spot Light (Spike &amp; Wall Outdoor Light)</a></li>
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
                          <li><a href="#">Switches</a>
                            <ul class="sub-menu mega-menu four-column left-0">
                              <li>
                                <ul>
                                  <li><a href="#" class="item-title">Jha Switch</a></li>
                                  <li><a href="#">Nova (Rocker Switch)</a></li>
                                  <li><a href="#">Astra (Big Switch)</a></li>
                                  <li><a href="#">Muse (Flat Round Switch "Capsule")</a></li>
                                  <li><a href="#">Nexus (Flat Switch)</a></li>
                                  <li><a href="#">Chromium Switch (Silver)</a></li>
                                  <li><a href="#">Enigma (Half Round Switch)</a></li>
                                  <li><a href="#">Aura (Full Round Switch)</a></li>
                                  <li><a href="#" class="item-title">Jha Penta Series</a></li>
                                  <li><a href="#">6A. Switches / Indicator</a></li>
                                  <li><a href="#">6A. Socket / Kit Kat Fuse</a></li>                                
                                </ul>
                              </li>
                              <li>
                                <ul>                     
                                  <li><a href="#">16 A. Switch / 6A. & 16A. Universal Socket</a></li>
                                  <li><a href="#">Dimmer / Fan Regulator</a></li>           
                                  <li><a href="#">MCB / Isolator</a></li>
                                  <li><a href="#">6A. 3 in 1</a></li>
                                  <li><a href="#">6A. & 16A. 5 in 1</a></li>
                                  <li><a href="#">Double S.S. Combined</a></li>
                                  <li><a href="#">32A. D.P. Switch with Indicator</a></li>
                                  <li><a href="#" class="item-title">Jha Black/Grey Series</a></li>
                                  <li><a href="#">Noir (Black Rocker)</a></li>
                                  <li><a href="#">Eclipse (Black Flat Round Switch "Capsule")</a></li>
                                  <li><a href="#">Jet (Black Big Switch)</a></li>
                                </ul>
                              </li>
                              <li>
                                <ul>                                
                                  <li><a href="#">Onyx (Black Flat Switch)</a></li>
                                  <li><a href="#">Charcoal (Black Chromium Switch)</a></li>
                                  <li><a href="#">BlackCurve (Black Half Round Switch)</a></li>
                                  <li><a href="#">DarkGlobe (Black Full Round Switch)</a></li>
                                  <li><a href="#" class="item-title">Jha Plates Series</a></li>
                                  <li><a href="#">Deco (Radius Plate - Black & White)</a></li>
                                  <li><a href="#">Gleam (Radius Plate - Silver & White)</a></li>
                                  <li><a href="#">Clique (Radius Plate - Metallic)</a></li>
                                  <li><a href="#">Heavenwood (Radius Plate Rosewood)</a></li>
                                </ul>
                              </li>
                            </ul>
                          </li>
                          <li><a href="#">Accessories</a>
                            <ul class="sub-menu mega-menu four-column left-0">
                              <li>
                                <ul>
                                    <li><a href="#" class="item-title">Accessories</a></li>
                                  <li><a href="#">Holder</a></li>
                                  <li><a href="#">Top & Plug</a></li>
                                  <li><a href="#">Ceiling Rose</a></li>    
                                  <li><a href="#">Bell</a></li>
                                  <li><a href="#">Regulator & Dimmer</a></li>
                                  <li><a href="#">Auxiliaries</a></li>   
                                  <li><a href="#" class="item-title">Jha GangBox</a></li>
                                  <li><a href="#">PowerNest (Modular Surface Gang Box - White)</a></li>
                                  <li><a href="#">Connex (Modular Surface Gang Box - Silver)</a></li>                         
                                </ul>
                              </li>
                              <li>
                                <ul>
                                  <li><a href="#">Concealer (Concealed Gang Boxes)</a></li>
                                  <li><a href="#">Safezone (Metal Gang Boxes)</a></li>
                                  <li><a href="#" class="item-title">Jha MCB Distribution Box</a></li>
                                  <li><a href="#">SPN MCB Distribution Box (Double Door)</a></li>
                                  <li><a href="#">TPN MCB Distribution Box (Double Door)</a></li>
                                  <li><a href="#">SPN Gold MCB Distribution Box (Double Door)</a></li>
                                  <li><a href="#">TPN Gold MCB Distribution Box (Double Door)</a></li>
                                </ul>
                              </li>
                              <li>
                                <ul>                                
                                  <li><a href="#">Single Pole MCB (SP) 10kA</a></li>
                                  <li><a href="#">Double Pole MCB (DP) 10kA</a></li>
                                  <li><a href="#">Triple Pole MCB (TP) 10kA</a></li>
                                  <li><a href="#">Triple Pole Neutral MCB (TPN) 10kA</a></li>
                                  <li><a href="#">Isolator</a></li>
                                  <li><a href="#">R.C.C.B. (E.L.C.B.)</a></li>
                                  <li><a href="#">Changeover</a></li>
                                  <li><a href="#">Surface D.P. Enclosure</a></li>
                                </ul>
                              </li>
                            </ul>
                          </li>
                          <li><a href="#">Wires</a>
                            <ul class="sub-menu mega-menu four-column wires-mega-menu left-0">
                              <li>
                                <ul>
                                  <li><a href="#" class="item-title">Building Wires</a></li>
                                  <li><a href="#">HDFR-Unilay Wires</a></li>
                                  <li><a href="#">Extra Safe Wires</a></li>  
                                  <li><a href="flame-retardant-low-smoke.html">Flame Retardant Low Smoke</a></li>
                                </ul>
                              </li>
                              <li>
                                <ul>
                                  <li><a href="#" class="item-title">PVC Submersible Cable</a></li>
                                  <li><a href="#" class="item-title">Submersible Winding Wires</a></li> 
                                </ul>
                              </li>
                              <li>
                                <ul>
                                  <li><a href="#" class="item-title">Winding Wires</a></li>
                                  <li><a href="#">Enameled Round Copper Winding Wire</a></li> 
                                  <li><a href="#">Solar Cables</a></li> 
                                  <li><a href="#">ZHFR Cables</a></li> 
                                </ul>
                              </li>
                            </ul>
                          </li>
                        </ul>
                      </li> -->

                      <li>
                        <span>Service & Support</span>
                        <ul class="sub-menu">
                          <li><a href="{{ route('professional.installation') }}">Professional Installation</a></li>
                          <li><a href="{{ route('prewiring.consultation') }}">Pre-Wiring Consultations</a></li>
                          <li><a href="{{ route('postinstallation.training') }}">Post-Installation Training</a></li>
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
                              <button class="header-search-toggle"><i class="fa fa-search"></i></button>
                              <div class="header-search-form">
                                  <form id="searchForm">
                                      <input type="text" id="searchInput" placeholder="Type and hit enter" required>
                                      <button type="submit"><i class="fa fa-search"></i></button>
                                  </form>
                                  <!-- Search results container (hidden initially) -->
                                  <div id="searchResults" class="search-dropdown" style="display: none;">
                                      <div id="productList"></div>
                                  </div>
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
                    <a href="{{ route('products.category') }}">Products</a>
                    <ul class="submenu2">
                        @foreach ($categories as $categoryGroup)
                            @php
                                $category = $categoryGroup->first();
                            @endphp
                            <li class="menu-item-has-children">
                                <a href="{{ route('product.page', ['slug' => $category->category_slug]) }}">{{ $category->category_name }}</a>
                                @if ($categoryGroup->whereNotNull('subcategory_id')->count())
                                    <ul class="submenu2">
                                        @foreach ($categoryGroup->groupBy('subcategory_id') as $subcategoryGroup)
                                            @php
                                                $subcategory = $subcategoryGroup->first();
                                            @endphp
                                            <li class="menu-item-has-children">
                                                <a href="#">{{ $subcategory->sub_category_name }}</a>
                                                @if ($subcategoryGroup->whereNotNull('product_id')->count())
                                                    <ul class="submenu2">
                                                        @foreach ($subcategoryGroup as $product)
                                                            <li><a href="{{ route('product-details', ['slug' => $product->product_slug]) }}">{{ $product->product_name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
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


      
      <!-- For Google Translator -->
      <script>
          document.addEventListener("DOMContentLoaded", function () {
              document.querySelectorAll(".flag_link").forEach(function (el) {
                  el.addEventListener("click", function () {
                      var lang = this.getAttribute("data-lang");
                      var select = document.querySelector("select.goog-te-combo");
                      if (select) {
                          select.value = lang;
                          select.dispatchEvent(new Event('change'));
                      }
                  });
              });
          });
      </script>



    <!------for search Functionality----->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Toggle search form visibility and ensure dropdown shows correctly
            $('.header-search-toggle').on('click', function () {
                $('.header-search-form').toggleClass('active'); // Use class for visibility
                if ($('.header-search-form').hasClass('active')) {
                    $('#searchInput').focus(); // Auto-focus on input
                    $('#searchResults').show(); // ✅ Show dropdown immediately
                } else {
                    $('#searchResults').hide(); // Hide dropdown when closing
                }
            });

            // Handle search submission
            $('#searchForm').submit(function (e) {
                e.preventDefault();
                let query = $('#searchInput').val().trim();

                if (query === "") {
                    $('#searchResults').hide(); // Hide dropdown if search is empty
                    return;
                }

                console.log("Searching for:", query); // ✅ Debugging log
                let assetBaseUrl = "{{ rtrim(asset(''), '/') }}"; 
                $.ajax({
                    url: "{{ route('search.products') }}",
                    method: "GET",
                    data: { query: query },
                    success: function (response) {
                        console.log("Response received:", response); // ✅ Debugging log

                        let productList = $('#productList');
                        productList.empty();
                        $('#searchResults').show(); // ✅ Ensure results box remains visible

                        if (response.length === 0) {
                            productList.append('<p>No products found.</p>');
                        } else {
                            response.forEach(product => {
                                let productItem = `
                                    <div class="search-item">
                                        <a href="${assetBaseUrl}/product-details/${product.slug}">
                                            <span>${product.product_name}</span>
                                        </a>
                                    </div>`;
                                productList.append(productItem);
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log("Search error:", error);
                    }
                });
            });

            // Hide search form & dropdown when clicking outside
            $(document).on('click', function (event) {
                if (!$(event.target).closest('.header-search, #searchResults').length) {
                    $('.header-search-form').removeClass('active'); // Use class to hide
                    $('#searchResults').hide();
                }
            });

            // Show dropdown on typing in the search input
            $('#searchInput').on('input', function () {
                if ($(this).val().trim() !== "") {
                    $('#searchResults').show();
                } else {
                    $('#searchResults').hide();
                }
            });
        });
    </script>