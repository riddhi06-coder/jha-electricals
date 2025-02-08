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
     data-bg="{{ isset($residential) && $residential->banner_image ? asset('uploads/application/' . $residential->banner_image) : asset('uploads/application/default-banner.webp') }}"
     style="background-image: url('{{ isset($residential) && $residential->banner_image ? asset('uploads/application/' . $residential->banner_image) : asset('uploads/application/default-banner.webp') }}');">

        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-banner text-center">
                        <h2>{{ $residential->banner_heading }}</h2>
                        <ul class="page-breadcrumb">
                            <li><a href="{{ route('home.page') }}">Home</a></li>
                            <li><a href="#">Application Area</a></li>
                            <li>{{ $residential->banner_heading }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="residential-lighting-one-sec post-install-train-one-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="post-install-train-image-sec">
                        <img src="{{ isset($residential) && $residential->image ? asset('uploads/application/' . $residential->image) : asset('img/default-image.png') }}" 
                            alt="Residential Lighting">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="post-install-tra-content-sec">
                        <p>{!! $residential->detailed_description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="residential-lighting-two-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="resi-light-second-title-sec">
                        <h3>{{ $residential->section_heading }}</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                @php
                    $calculationImages = json_decode($residential->calculation_images, true) ?? [];
                    $calculationTitles = json_decode($residential->calculation_titles, true) ?? [];
                    $calculationDescriptions = json_decode($residential->calculation_descriptions, true) ?? [];
                @endphp

                @foreach ($calculationTitles as $index => $title)
                    <div class="col-lg-4">
                        <div class="resi-light-three-col-sec">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <div class="resi-light-icon-sec">
                                        <img src="{{ asset('uploads/application/' . ($calculationImages[$index] ?? 'default.png')) }}" 
                                            alt="Switch Icon">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="resi-light-content-sec">
                                        <h3>{{ $title }}</h3>
                                        <p>{{ $calculationDescriptions[$index] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="resi-light-third-sec">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="resi-light-thrid-content-sec">
                        @if($residential_partB)
                            <div class="resi-light-third-listing-sec">
                                <ul>
                                    <li>{!! $residential_partB->detailed_description !!}</li>
                                </ul>
                            </div>
                        @else
                            <p>No data available for this section.</p>
                        @endif
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="resi-light-third-img-sec">
                        @if($residential_partB && $residential_partB->image)
                            <img src="{{ asset('uploads/services/' . $residential_partB->image) }}" alt="Residential Image">
                        @else
                            <img src="{{ asset('img/resi-light-img-2.webp') }}" alt="Default Image">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>




   <div class="resi-light-four-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pit-foo-slider-title-sec">
                    <h2>{{ $residential_partB->section_heading }}</h2>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="product-slider tf-element-carousel normal-nav" 
                    data-slick-options='{
                        "slidesToShow": 4,
                        "slidesToScroll": 1,
                        "infinite": true,
                        "rows": 1,
                        "autoplay": true,
                        "arrows": true,
                        "prevArrow": {"buttonClass": "slick-btn slick-prev", "iconClass": "fa fa-angle-left" },
                        "nextArrow": {"buttonClass": "slick-btn slick-next", "iconClass": "fa fa-angle-right" }
                    }' 
                    data-slick-responsive='[
                        {"breakpoint":1199, "settings": {"slidesToShow": 3}},
                        {"breakpoint":992, "settings": {"slidesToShow": 2}},
                        {"breakpoint":768, "settings": {"slidesToShow": 2}},
                        {"breakpoint":576, "settings": {"slidesToShow": 1, "arrows": false, "autoplay": true}}
                    ]'>

                    @if ($residential_partB)
                        @php
                            $titles = json_decode($residential_partB->calculation_titles ?? '[]', true);
                            $descriptions = json_decode($residential_partB->calculation_descriptions ?? '[]', true);
                            $images = json_decode($residential_partB->calculation_images ?? '[]', true);
                        @endphp


                        @foreach ($titles as $index => $title)
                            <div class="col">
                                <div class="resi-light-single-box-sec">
                                    <img src="{{ asset('uploads/services/' . ($images[$index] ?? 'default.png')) }}" alt="Image">
                                    <h3>{{ $title }}</h3>
                                    <p>{{ $descriptions[$index] ?? '' }}</p>
                                    <span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>

            <div class="col-lg-12">
                <p>{{ $residential_partB->section_description ?? 'As the Indian residential market continues to evolve, we can expect to see further advancements in lighting, switches, accessories, and wiring technologies, driven by innovation, sustainability, and consumer preferences.' }}</p>
            </div>
        </div>
    </div>
</div>



    <div class="india-resi-light-sec">
      <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="india-resi-light-left-sec">
                    <div class="india-resi-light-title-sec">
                        <h1>Overview of each category:</h1>
                        <p>India's residential lighting, switches, accessories, and wiring sectors form a critical part of the country's infrastructure, reflecting rapid technological advancements, growing urbanization, and increasing consumer awareness of energy efficiency and aesthetics.</p>
                    </div>
                </div>
            </div>
            
          <div class="col-lg-6">
            <div class="accordion india-resi-light-accordian-sec" id="faqAccordion">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button collapsed india-resi-light-accordian-head-sec" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                    aria-controls="collapseOne">
                    <img src="img/icon/residential-light-icon.png" alt="" class="resi-light-icon-accordian-sec"> Residential Lighting
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                  data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    <div class="india-resi-light-accordian-content-sec">
                      <h3>Types of Lighting:</h3>
                      <ul class="in-resi-light-listing-sec">
                        <li><b>Ambient Lighting:</b> Provides overall illumination, commonly achieved through LED bulbs,
                          tube lights, and panel lights.</li>
                        <li><b>Task Lighting:</b> Focused light for specific tasks like reading or cooking, including
                          desk lamps, under-cabinet lighting, and spotlights.</li>
                        <li><b>Accent Lighting:</b> Highlights architectural or decorative elements using recessed
                          lights, strip lights, or wall-mounted fixtures.</li>
                        <li><b>Smart Lighting:</b> App-controlled and voice-enabled lighting solutions like Philips Hue
                          and Wipro Smart Lights have gained popularity.</li>
                      </ul>
                      <h3 class="pt-20">Trends in Lighting:</h3>
                      <ul class="in-resi-light-listing-sec">
                        <li><b>Energy Efficiency:</b> LED lighting has largely replaced traditional incandescent and CFL
                          bulbs due to its lower energy consumption and longer lifespan.</li>
                        <li><b>Smart Solutions:</b> Integration of IoT (Internet of Things) for customizable lighting
                          based on mood, time, or activity.</li>
                        <li><b>Aesthetic Appeal:</b> Decorative chandeliers, pendant lights, and innovative designs
                          cater to diverse consumer preferences.</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed india-resi-light-accordian-head-sec" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <img src="img/icon/modular-switch-icon.png" alt="" class="resi-light-icon-accordian-sec"> Switches
                  </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                  data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    <div class="india-resi-light-accordian-content-sec">
                      <h3>Types of Residential Switches:</h3>
                      <ul class="in-resi-light-listing-sec">
                        <li><b>Modular Switches:</b> Sleek, customizable, and available in a range of finishes like glass, metal, and wood.</li>
                        <li><b>Smart Switches:</b> Wi-Fi-enabled switches controlled through smartphones or voice assistants.</li>
                        <li><b>Touch Switches:</b> Modern alternatives offering touch-based operation with minimalistic designs.</li>
                      </ul>
                      <h3 class="pt-20">Key Features:</h3>
                      <ul class="in-resi-light-listing-sec">
                        <li><b>Energy Efficiency:</b> Shockproof and fire-retardant materials are standard in high-quality switches.</li>
                        <li><b>Customization:</b> Manufacturers like Havells, Legrand, and Anchor provide options for personalized configurations to match interior themes.</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="accordion india-resi-light-accordian-sec" id="faqAccordion">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                  <button class="accordion-button collapsed india-resi-light-accordian-head-sec" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <img src="img/icon/accessories-icon.png" alt="" class="resi-light-icon-accordian-sec"> Accessories
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                  data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    <div class="india-resi-light-accordian-content-sec">
                      <h3>Common Residential Electrical Accessories:</h3>
                      <ul class="in-resi-light-listing-sec">
                        <li><b>Top & Plugs:</b> Modular and universal top & plugs that accommodate various plug types.</li>
                        <li><b>USB Charging Ports:</b> Integrated into switch panels for convenience.</li>
                        <li><b>Dimmers:</b> Allow brightness adjustment to suit different needs.</li>
                        <li><b>Regulator and Motion Sensors:</b> Enhance energy efficiency and automation.</li>
                      </ul>
                      <h3 class="pt-20">Aesthetic and Functional Innovations:</h3>
                      <ul class="in-resi-light-listing-sec">
                        <li>Sleek designs with soft-touch materials.</li>
                        <li>Multi-functional units combining switches, top & plugs, and USB ports in one frame.</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                  <button class="accordion-button collapsed india-resi-light-accordian-head-sec" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <img src="img/icon/wiring-icon.png" alt="" class="resi-light-icon-accordian-sec"> Wiring
                  </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                  data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    <div class="india-resi-light-accordian-content-sec">
                      <h3>Types of Residential Wiring:</h3>
                      <ul class="in-resi-light-listing-sec">
                        <li><b>Concealed Wiring:</b> Popular in modern homes for its clean and aesthetic appearance.</li>
                        <li><b>PVC Insulated Wires:</b> Commonly used for durability, flexibility, and insulation.</li>
                        <li><b>Low-Smoke Halogen-Free (LSHF) Cables:</b> Preferred for safety in case of fire.</li>
                      </ul>
                      <h3 class="pt-20">Key Features in Wiring:</h3>
                      <ul class="in-resi-light-listing-sec">
                        <li><b>Copper Wires:</b> High conductivity and durability make them a preferred choice.</li>
                        <li><b>Energy-Efficient Wires:</b> Designed to reduce energy loss during transmission.</li>
                        <li><b>Color-Coded Insulation:</b> Ensures easier installation and maintenance.</li>
                      </ul>
                      <h3 class="pt-20">Advancements:</h3>
                      <ul class="in-resi-light-listing-sec">
                        <li><b>Eco-Friendly Wiring:</b> Use of recyclable and sustainable materials.</li>
                        <li><b>Smart Cables:</b> Compatible with home automation systems.</li>
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