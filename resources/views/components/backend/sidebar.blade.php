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
                    <li><a href="{{ route('home-banner.index') }}">Product Qualities</a></li>
                    <li><a href="{{ route('home-banner.index') }}">Contact Details</a></li>
                    <li><a href="{{ route('home-banner.index') }}">Testimonials</a></li>
                    <li><a href="{{ route('home-banner.index') }}">Latest Blogs</a></li>
                    <li><a href="{{ route('home-banner.index') }}">Company Details</a></li>
                    <li><a href="{{ route('home-banner.index') }}">Header Details</a></li>
                  
                  </ul>
                </li>

                <li class="sidebar-list"> <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#user-visitor') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#user-visitor') }}"></use>
                    </svg><span>About Us</span></a>
                  <ul class="sidebar-submenu">
                    <li><a href="#">Banner Details</a></li>
                    <li><a href="#">Who We Are</a></li>
                    <li><a href="#">Our Product Range</a></li>
                    <li><a href="#">Explore Our Range</a></li>
                    <li><a href="#">Why Choose Us?</a></li>
                    <li><a href="#">Our Vision</a></li>
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
                    <li><a href="#">Professional Installation</a></li>
                    <li><a href="#">Pre-Wiring Consultation</a></li>
                    <li><a href="#">Post-Installation Training</a></li>
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
                    <li><a href="#">Residential Lighting</a></li>
                    <li><a href="#">Commercial Lighting</a></li>
                  </ul>
                </li>


                <li class="sidebar-list"> <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-layout') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-layout') }}"></use>
                    </svg><span>Careers</span></a>
                  <ul class="sidebar-submenu">
                    <li><a href="#">Banner Details</a></li>
                    <li><a href="#">Process</a></li>
                    <li><a href="#">Current Openings</a></li>
                    <li><a href="#">How to Apply</a></li>
                  </ul>
                </li>

                <li class="sidebar-list"> <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-gallery') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#fill-gallery') }}"></use>
                    </svg><span>Photo Gallery</span></a>
                  <ul class="sidebar-submenu">
                    <li><a href="#">Banner Details</a></li>
                    <li><a href="#">Gallery</a></li>
                  </ul>
                </li>

                <li class="sidebar-list"> <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon"> 
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#stroke-contact') }}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('admin/assets/svg/icon-sprite.svg#fill-contact') }}"></use>
                    </svg><span>Contact Us</span></a>
                  <ul class="sidebar-submenu">
                    <li><a href="#">Banner Details</a></li>
                    <li><a href="#">Contact Details</a></li>
                  </ul>
                </li>



              </ul>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
          </nav>
        </div>