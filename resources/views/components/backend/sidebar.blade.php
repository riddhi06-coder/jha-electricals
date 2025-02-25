 <!-- Page Body Start-->
 <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="sidebar-wrapper" data-layout="stroke-svg">
          <div class="logo-wrapper">
		  	<a href="{{ route('admin.dashboard') }}">
				<img class="img-fluid" src="{{ asset('admin/assets/images/logo/logo_1.png') }}" alt="" style="max-width: 85% !important;">
			</a>  
		  <div class="back-btn"><i class="fa fa-angle-left"> </i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
          </div>
          <div class="logo-icon-wrapper"><a href="{{ route('admin.dashboard') }}"><img class="img-fluid" src="{{ asset('admin/assets/images/favicon-1.png') }}" alt="" ></a></div>
          <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
              <ul class="sidebar-links" id="simple-bar">
                <li class="back-btn"><a href="{{ route('admin.dashboard') }}"><img class="img-fluid" src="{{ asset('admin/assets/images/logo/logo_1.png') }}" alt=""></a>
                  <div class="mobile-back text-end"> <span>Back </span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                </li>
                <li class="pin-title sidebar-main-title">
                  <div> 
                    <h6>Pinned</h6>
                  </div>
                </li>
                <li class="sidebar-main-title">
                  <div>
                    <h6 class="lan-1">General</h6>
                  </div>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"> </i>
                <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.dashboard') }}">
                    <svg class="stroke-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#fill-home') }}"></use>
                    </svg><span class="lan-3">Dashboard </span>
                  </a>
                </li>


                <li class="sidebar-list"> <i class="fa fa-thumb-tack"></i> <a class="sidebar-link sidebar-title" href="#">
                        <svg class="stroke-icon">
                            <use href="{{ asset('admin/assets/svg/icon-sprite.svg#product-category') }}"></use>
                        </svg>
                        <svg class="fill-icon">
                            <use href="{{ asset('admin/assets/svg/icon-sprite.svg#product-category') }}"></use>
                        </svg>
                        <span>Products</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a class="submenu-title" href="#">Lights 
                                <span class="sub-arrow"><i class="fa fa-angle-right"></i></span>
                            </a>
                            <ul class="nav-sub-childmenu submenu-content">
                                <li><a href="{{ route('product-category.index') }}">Product Category</a></li>
                                <li><a href="{{ route('add-products.index') }}">Add Products</a></li>
                                <li><a href="{{ route('product-detail.index') }}">Product Details</a></li>
                            </ul>
                        </li>

                        <li>
                            <a class="submenu-title" href="#">Switch 
                                <span class="sub-arrow"><i class="fa fa-angle-right"></i></span>
                            </a>
                            <ul class="nav-sub-childmenu submenu-content">
                                <li><a href="{{ route('switch-product-category.index') }}">Switch Category</a></li>
                                <li><a href="{{ route('switch-add-products.index') }}">Add Switches</a></li>
                                <li><a href="{{ route('switch-product-detail.index') }}">Switches Details</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>



                <li class="sidebar-list"> <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-knowledgebase') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#fill-knowledgebase') }}"></use>
                    </svg><span>Home page</span></a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ route('home-banner.index') }}">Banner Details</a></li>
                    <li><a href="{{ route('home-about.index') }}">About</a></li>
                    <li><a href="{{ route('home-founder.index') }}">Founder's Desk</a></li>
                    <li><a href="{{ route('home-range.index') }}">Explore Our Range</a></li>
                    <li><a href="{{ route('home-quality.index') }}">Product Qualities</a></li>
                    <li><a href="{{ route('home-contact.index') }}">Contact Details</a></li>
                    <li><a href="{{ route('home-testimonails.index') }}">Testimonials</a></li>
                    <li><a href="{{ route('home-blogs.index') }}">Latest Blogs</a></li>
                    <li><a href="{{ route('home-footer.index') }}">Company Details</a></li>
                    <li><a href="{{ route('social-media.index') }}">Social Media</a></li>
                  
                  </ul>
                </li>

                <li class="sidebar-list"> <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-project') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-project') }}"></use>
                    </svg><span>About Us</span></a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ route('who-we-are.index') }}">Who We Are</a></li>
                    <li><a href="{{ route('product-vision.index') }}">Product & Vision </a></li>
                    <li><a href="{{ route('choose-us.index') }}">Why Choose Us?</a></li>
                  </ul>
                </li>

                <li class="sidebar-list"> <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-support-tickets') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-support-tickets') }}"></use>
                    </svg><span>Service & Support</span></a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ route('professional-install.index') }}">Professional Installation</a></li>
                    <li><a href="{{ route('pre-wiring.index') }}">Pre-Wiring(A)</a></li>
                    <li><a href="{{ route('pre-wiring-partB.index') }}">Pre-Wiring(B)</a></li>
                    <li><a href="{{ route('post-install.index') }}">Post-Installation(A)</a></li>
                    <li><a href="{{ route('post-install-partB.index') }}">Post-Installation(B)</a></li>
                    <li><a href="{{ route('post-install-partC.index') }}">Post-Installation(C)</a></li>
                  </ul>
                </li>

                <li class="sidebar-list"> <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-ecommerce') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-ecommerce') }}"></use>
                    </svg><span>Application Area</span></a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ route('reside-light-partA.index') }}">Residential(A)</a></li>
                    <li><a href="{{ route('reside-light-partB.index') }}">Residential(B)</a></li>
                    <li><a href="{{ route('reside-light-partC.index') }}">Residential(C)</a></li>
                    <li><a href="{{ route('commercial-light-partA.index') }}">Commercial(A)</a></li>
                    <li><a href="{{ route('commercial-light-partB.index') }}">Commercial(B)</a></li>
                    <li><a href="{{ route('commercial-light-partC.index') }}">Commercial(C)</a></li>
                  </ul>
                </li>


                <li class="sidebar-list"> <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title" href="{{ route('career.index') }}">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-layout') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-layout') }}"></use>
                    </svg><span>Career</span></a>
                </li>

                <li class="sidebar-list"> <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-learning') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-learning') }}"></use>
                    </svg><span>Shopping Guide</span></a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ route('guide.index') }}">Guide(A)</a></li>
                    <li><a href="{{ route('guide-partB.index') }}">Guide(B)</a></li>
                  </ul>
                </li>
                
                <li class="sidebar-list"> <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title" href="{{ route('gallery.index') }}">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-gallery') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-gallery') }}"></use>
                    </svg><span>Photo Gallery</span></a>
                </li>


                <li class="sidebar-list"> <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-blog') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-blog') }}"></use>
                    </svg><span>Blogs</span></a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ route('blog-types.index') }}">Blogs Section</a></li>
                    <li><a href="{{ route('blog-detail.index') }}">Blog Details</a></li>
                  </ul>
                </li>

                <li class="sidebar-list"> <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title" href="{{ route('contact.index') }}">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-contact') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-contact') }}"></use>
                    </svg><span>Contact Us</span></a>
                </li>

                <li class="sidebar-list"> <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title" href="{{ route('privacy.index') }}">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#activity') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#activity') }}"></use>
                    </svg><span>Privacy Policy</span></a>
                </li>


              </ul>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
          </nav>
        </div>