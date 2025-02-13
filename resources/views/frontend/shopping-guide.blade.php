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
    data-bg="{{ isset($guide->banner_image) ? asset('uploads/application/' . $guide->banner_image) : asset('img/bg/default-banner.jpg') }}"
    style="background-image: url({{ isset($guide->banner_image) ? asset('uploads/application/' . $guide->banner_image) : asset('img/bg/default-banner.jpg') }});">
    <div class="container">
        <div class="row">
        <div class="col">
            <div class="page-banner text-center">
            <h2>{{ $guide->banner_heading }}</h2>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('home.page') }}">Home</a></li>
                <li>{{ $guide->banner_heading }}</li>
            </ul>
            </div>
        </div>
        </div>
    </div>
    </div>

    <!--==================================================-->
    <div class="faqs-area shop-guide-second-sec">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12">
            <div class="shop-guide-second-left-sec">
                <div class="shop-guide-second-left-title">
                    <h3>{!! $guide->short_description  !!}</h3>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--==================================================-->

    <div class="shop-guide-process-area">
        <div class="container">
            <div class="row" id="shop-guide-second-row">
            <div class="col-lg-6">
                <div class="shop-guide-second-thumb">
                <img src="{{ asset('uploads/application/' . ($guide->image ?? 'default.jpg')) }}" alt="Shopping Guide">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shop-guide-second-process-left">
                <div class="shop-guide-second-title-sec">
                    <p>{!! $guide->detailed_description !!}</p>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!--==================================================-->
    <!-- End Echofy Process Area Home-Two -->
    <!--==================================================-->


    <div class="shop-guide-right-pro-sec">
        <div class="container">
            <div class="row">
            <div class="col-lg-12">
                <div class="shop-guid-right-title-sec">
                <h2>{{ $guide->section_heading }}</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product-slider tf-element-carousel normal-nav" data-slick-options='{
                    "slidesToShow": 4,
                    "slidesToScroll": 1,
                    "infinite": true,
                    "rows": 1,
                    "autoplay": true,
                    "arrows": false,
                    "prevArrow": {"buttonClass": "slick-btn slick-prev", "iconClass": "fa fa-angle-left" },
                    "nextArrow": {"buttonClass": "slick-btn slick-next", "iconClass": "fa fa-angle-right" }
                }' data-slick-responsive='[
                    {"breakpoint":1199, "settings": {"slidesToShow": 3}},
                    {"breakpoint":992, "settings": {"slidesToShow": 2}},
                    {"breakpoint":768, "settings": {"slidesToShow": 2}},
                    {"breakpoint":576, "settings": {"slidesToShow": 1, "arrows": false, "autoplay": true}}
                ]'>
                
                @php
                    $calculationImages = json_decode($guide->calculation_images, true) ?? [];
                    $calculationTitles = json_decode($guide->calculation_titles, true) ?? [];
                    $calculationDescriptions = json_decode($guide->calculation_descriptions, true) ?? [];
                @endphp

                @foreach ($calculationTitles as $index => $title)
                    <div class="col">
                    <div class="shop-guide-single-box-sec">
                        <img src="{{ asset('uploads/application/' . ($calculationImages[$index] ?? 'default.png')) }}" alt="Image">
                        <h3>{{ $title }}</h3>
                        <p>{{ $calculationDescriptions[$index] ?? '' }}</p>
                        <span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    </div>
                @endforeach

                </div>
            </div>
            <div class="col-lg-12">
                <p>{!! $guide->section_description !!}</p>
            </div>
            </div>
        </div>
    </div>



    <div class="indian-light-shopping-guide-sec">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="indian-light-shopping-guide-left-sec">
              <div class="ind-li-shop-guide-title-sec">
                <h3>Indian Shopping Guide for Lighting, Switches, Accessories, and Wires</h3>
                <p>Purchasing electrical products for your home, office, or commercial setup requires careful
                  consideration to ensure safety, durability, and aesthetics. The Indian market offers a plethora of
                  options across all categories.</p>
                <p>Comprehensive guide to help you make the best choices for lighting, switches, accessories, and wires.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="accordion india-commer-light-accordian-sec" id="faqAccordion">

              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button collapsed india-commer-light-accordian-head-sec" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                    aria-controls="collapseOne">
                    <img src="img/icon/lightbulb.png" alt="Lighting Icon"
                      class="commer-light-icon-accordian-sec">
                    Lighting
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                  data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    <div class="india-commer-light-accordian-content-sec">
                      <h3>Types of Lighting to Consider:</h3>
                      <ul class="in-commer-light-listing-sec">
                        <li><b>LED Lights:</b> Energy-efficient, long-lasting, and available in various forms like
                          bulbs, tubes, panel lights, and downlights.</li>
                        <li><b>Decorative Lighting:</b> Chandeliers, pendant lights, and wall-mounted fixtures for
                          aesthetic appeal.</li>
                        <li><b>Smart Lighting:</b> Wi-Fi-enabled and app-controlled solutions for mood lighting and
                          automation.</li>
                        <li><b>Outdoor Lighting:</b> Weatherproof lights, solar lamps, and floodlights for gardens,
                          driveways, and patios.</li>
                      </ul>
                      <h3 class="pt-20">Buying Tips:</h3>
                      <ul class="in-commer-light-listing-sec">
                        <li><b>Purpose:</b> Define the use case-ambient lighting for general illumination, task lighting
                          for specific activities, or accent lighting to highlight decor.</li>
                        <li><b>Colour Temperature:</b> Warm white (2700K-3000K) for cozy settings, cool white
                          (4000K-6500K) for workspaces.</li>
                        <li><b>Warranty:</b> Choose brands offering a warranty.</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed india-commer-light-accordian-head-sec" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                    aria-controls="collapseTwo">
                    <img src="img/icon/modular-switch-icon.png" alt="" class="commer-light-icon-accordian-sec"> Switches
                  </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                  data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    <div class="india-commer-light-accordian-content-sec">
                      <h3>Types of Switches Available:</h3>
                      <ul class="in-commer-light-listing-sec">
                        <li><b>Modular Switches:</b> Sleek, durable, and customizable for modern interiors.</li>
                        <li><b>Smart Switches:</b> IoT-enabled switches for automation, controlled via smartphone or
                          voice assistants.</li>
                        <li><b>Touch Switches:</b> Touch-sensitive panels for a premium feel.</li>
                        <li><b>Traditional Switches:</b> Basic and budget-friendly options for functional use.</li>
                      </ul>
                      <h3 class="pt-20">Buying Tips:</h3>
                      <ul class="in-commer-light-listing-sec">
                        <li><b>Safety:</b> Ensure switches are shockproof and fire-resistant. </li>
                        <li><b>Design:</b> Choose modular switches that blend seamlessly with your interiors.</li>
                        <li><b>Functionality:</b> Look for additional features like inbuilt USB charging ports or
                          indicator lights.</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="accordion india-commer-light-accordian-sec" id="faqAccordion">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                  <button class="accordion-button collapsed india-commer-light-accordian-head-sec" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                    aria-controls="collapseThree">
                    <img src="img/icon/accessories-icon.png" alt="" class="commer-light-icon-accordian-sec"> Accessories
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                  data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    <div class="india-commer-light-accordian-content-sec">
                      <h3>Types of Electrical Accessories:</h3>
                      <ul class="in-commer-light-listing-sec">
                        <li><b>Sockets and Plugs:</b> Universal sockets for compatibility with different plug types.
                        </li>
                        <li><b>Dimmers and Regulators:</b> For controlling light brightness or fan speed.</li>
                        <li><b>Extension Boards:</b> For multi-point connections in homes and offices.</li>
                        <li><b>Surge Protectors:</b> To safeguard electronic devices from voltage spikes.</li>
                        <li><b>Timers and Motion Sensors:</b> Ideal for energy-saving automation.</li>
                      </ul>
                      <h3 class="pt-20">Buying Tips:</h3>
                      <ul class="in-commer-light-listing-sec">
                        <li><b>Material Quality:</b> Ensure accessories are made from fire-retardant and durable
                          materials.</li>
                        <li><b>Features:</b> Consider multi-functional options.</li>
                        <li><b>Installation:</b> Choose products that are easy to install and maintain.</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                  <button class="accordion-button collapsed india-commer-light-accordian-head-sec" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                    aria-controls="collapseFour">
                    <img src="img/icon/wiring-icon.png" alt="" class="commer-light-icon-accordian-sec"> Wires
                  </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                  data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    <div class="india-commer-light-accordian-content-sec">
                      <h3>Types of Wires to Choose From:</h3>
                      <ul class="in-commer-light-listing-sec">
                        <li><b>PVC Insulated Wires:</b> For household wiring; affordable and durable.</li>
                        <li><b>FR (Flame Retardant) Wires:</b> Reduce fire risk and are ideal for high-load areas.</li>
                        <li><b>FRLS (Flame Retardant Low Smoke) Cables:</b> Safer option for commercial buildings.</li>
                        <li><b>LAN and Coaxial Cables:</b> For internet and entertainment systems.</li>
                      </ul>
                      <h3 class="pt-20">Buying Tips:</h3>
                      <ul class="in-commer-light-listing-sec">
                        <li><b>Copper vs. Aluminium:</b> Copper wires are more efficient and durable, although costlier.
                        </li>
                        <li><b>Gauge and Thickness:</b> Choose based on the electrical load requirements of your space.
                        </li>
                        <li><b>Brand and Certification:</b> Look for ISI-marked products from reputed brands for safety
                          and longevity.</li>
                        <li><b>Colour Coding:</b> Opt for wires with color-coded insulation for easy installation.</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

        @include('components.frontend.footer')

        @include('components.frontend.main-js')

</body>
</html>