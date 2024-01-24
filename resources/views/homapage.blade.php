@extends('layouts.master')

@section('content')


        <div class="hero-slide owl-carousel site-blocks-cover pb-3">
           <div class="intro-section" style="background-image: url('{{asset('assets/images/hero_1.jpg')}}');">
             <div class="container">
               <div class="row align-items-center">
                 <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
                   <h1>Academics University</h1>
                 </div>
               </div>
             </div>
           </div>
       
           <div class="intro-section" style="background-image: url('{{asset('assets/images/course_1.jpg')}}');">
             <div class="container">
               <div class="row align-items-center">
                 <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
                   <h1>You Can Learn Anything</h1>
                 </div>
               </div>
             </div>
           </div>
         </div>



      {{-- sarpanch section...  --}}
         <div class="site-section" >
          <div class="container">
            {{-- <div class="row mb-0 justify-content-center text-center">
              <div class="col-lg-4 mb-2">
                <h2 class="section-title-underline mb-5">
                  <span>Why Academics Works</span>
                </h2>
              </div>
            </div> --}}
            <div class="row">
              <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 border-right">
    
                <div class="feature-1">
                  {{-- <div class="icon-wrapper bg-primary">
                    <span class="flaticon-mortarboard text-white"></span>
                  </div> --}}
                  <div class="feature-1-content">
                    {{-- <h2>Personalize Learning</h2> --}}
                    <img src="{{asset('assets/images/sarpanch.webp')}}" class="img-fluid rounded" alt="">
                    <h3 class="sarpanch-name">Name of sarpanch</h3>
                    <h5>Sarpanch </h5>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 mb-4 mb-lg-0 border-right">
                <div class="feature-1">
                  {{-- <div class="icon-wrapper bg-primary">
                    <span class="flaticon-school-material text-white"></span>
                  </div> --}}
                  <div class="feature-1-content">
                    <h2>Sarpanch Message</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
                  </div>
                </div> 
              </div>
              <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 " >
                <div class="feature-1 ">
                  {{-- <div class="icon-wrapper bg-primary">
                    <span class="flaticon-library text-white"></span>
                  </div> --}}
                  <div class="feature-1-content pt-5 mt-5">
                    <h2>Know more</h2>
                    <p><a href="#" class="btn btn-primary px-4 rounded-0">view</a></p>
                  </div>
                </div> 
              </div>
            </div>
          </div>
        </div>



        {{-- Event Carousel --}}
        <div class="site-section blog-home5 py-5">
          <div class="container">
            <!-- Row  -->
            <div class="row mb-0 justify-content-center text-center">
              <div class="col-lg-4 mb-2">
                <h2 class="section-title-underline mb-0">
                  <span>Events</span>
                </h2>
              </div>
            </div>
            
            <!-- Row  -->
            <div class="row mt-2">
              <!-- Column -->
              <div class="col-md-4">
                <div class="card b-h-box position-relative font-14 border-0 mb-4">
                  <img class="card-img" src="https://www.wrappixel.com/demos/ui-kit/wrapkit/assets/images/blog/blog-home/img9.jpg" alt="Card image">
                  <div class="card-img-overlay overflow-hidden">
                    <div class="d-flex align-items-center">
                        <span class="bg-danger-gradiant badge overflow-hidden text-white px-3 py-1 font-weight-normal">Charity, Ngo</span>
                        <div class="ml-2">
                          <span class="ml-2">Feb 18, 2018</span>
                        </div>
                    </div>
                    <h5 class="card-title my-3 font-weight-normal">Help out the people who really need it on time.</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod...</p>
                  </div>
                </div>
              </div>
              <!-- Column -->
              <!-- Column -->
              <div class="col-md-4">
                <div class="card b-h-box position-relative font-14 border-0 mb-4">
                  <img class="card-img" src="https://www.wrappixel.com/demos/ui-kit/wrapkit/assets/images/blog/blog-home/img10.jpg" alt="Card image">
                  <div class="card-img-overlay overflow-hidden">
                    <div class="d-flex align-items-center">
                        <span class="bg-danger-gradiant badge overflow-hidden text-white px-3 py-1 font-weight-normal">Charity, Ngo</span>
                        <div class="ml-2">
                          <span class="ml-2">Feb 18, 2018</span>
                        </div>
                    </div>
                    <h5 class="card-title my-3 font-weight-normal">Help out the people who really need it on time.</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod...</p>
                  </div>
                </div>
              </div>
              <!-- Column -->
              <!-- Column -->
              <div class="col-md-4">
                <div class="card b-h-box position-relative font-14 border-0 mb-4">
                  <img class="card-img" src="https://www.wrappixel.com/demos/ui-kit/wrapkit/assets/images/blog/blog-home/img11.jpg" alt="Card image">
                  <div class="card-img-overlay overflow-hidden">
                    <div class="d-flex align-items-center">
                        <span class="bg-danger-gradiant badge overflow-hidden text-white px-3 py-1 font-weight-normal">Charity, Ngo</span>
                        <div class="ml-2">
                          <span class="ml-2">Feb 18, 2018</span>
                        </div>
                    </div>
                    <h5 class="card-title my-3 font-weight-normal">Help out the people who really need it on time.</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod...</p>
                  </div>
                </div>
              </div>
              <!-- Column -->
              <!-- Column -->
              <div class="col-md-4">
                <div class="card b-h-box position-relative font-14 border-0 mb-4">
                  <img class="card-img" src="https://www.wrappixel.com/demos/ui-kit/wrapkit/assets/images/blog/blog-home/img11.jpg" alt="Card image">
                  <div class="card-img-overlay overflow-hidden">
                    <div class="d-flex align-items-center">
                        <span class="bg-danger-gradiant badge overflow-hidden text-white px-3 py-1 font-weight-normal">Charity, Ngo</span>
                        <div class="ml-2">
                          <span class="ml-2">Feb 18, 2018</span>
                        </div>
                    </div>
                    <h5 class="card-title my-3 font-weight-normal">Help out the people who really need it on time.</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod...</p>
                  </div>
                </div>
              </div>
              <!-- Column -->
              <!-- Column -->
              <div class="col-md-4">
                <div class="card b-h-box position-relative font-14 border-0 mb-4">
                  <img class="card-img" src="https://www.wrappixel.com/demos/ui-kit/wrapkit/assets/images/blog/blog-home/img11.jpg" alt="Card image">
                  <div class="card-img-overlay overflow-hidden">
                    <div class="d-flex align-items-center">
                        <span class="bg-danger-gradiant badge overflow-hidden text-white px-3 py-1 font-weight-normal">Charity, Ngo</span>
                        <div class="ml-2">
                          <span class="ml-2">Feb 18, 2018</span>
                        </div>
                    </div>
                    <h5 class="card-title my-3 font-weight-normal">Help out the people who really need it on time.</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod...</p>
                  </div>
                </div>
              </div>
              <!-- Column -->
              <!-- Column -->
              <div class="col-md-4">
                <div class="card b-h-box position-relative font-14 border-0 mb-4">
                  <img class="card-img" src="https://www.wrappixel.com/demos/ui-kit/wrapkit/assets/images/blog/blog-home/img11.jpg" alt="Card image">
                  <div class="card-img-overlay overflow-hidden">
                    <div class="d-flex align-items-center">
                        <span class="bg-danger-gradiant badge overflow-hidden text-white px-3 py-1 font-weight-normal">Charity, Ngo</span>
                        <div class="ml-2">
                          <span class="ml-2">Feb 18, 2018</span>
                        </div>
                    </div>
                    <h5 class="card-title my-3 font-weight-normal">Help out the people who really need it on time.</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod...</p>
                  </div>
                </div>
              </div>
              <!-- Column -->
            </div>
            <div class="row mb-0 justify-content-end text-center">
              <div class="col-lg-4 mb-0">
                <h5 class="mb-0 ">
                  <a href="#" class="underline"><span>view all</span></a>
                </h5>
              </div>
            </div>
          </div>
        </div>



        {{-- News Section --}}

        <section class="section section--background section--news mt-5 mb-5">
          <div class="container">
            <div class="row">
        
              <!-- News Section -->
              <div class="col-lg-6 col-12">
                {{-- <h2 class="h1 mt-xl-n1 mb-4 mb-md-5 pb-2">News</h2> --}}
                <div class="row mb-0 justify-content-center text-center">
                  <div class="col-lg-4 mb-2">
                    <h2 class="section-title-underline mb-5">
                      <span>News</span>
                    </h2>
                  </div>
                </div>
        
                <div class="box-news">
                  <a aria-label="LunarXP Wins Space Innovator of the Year Award" href="#">
                    <div class="row">
                      <div class="col-lg-3 col-4 pr-1">
                        <img alt="LunarXP Wins Space Innovator of the Year Award" class="img-fluid" src="{{asset('assets/images/hero_1.jpg')}}">
                      </div>
                      <div class="col-lg-9 col-8 news-heading">
                        <h2 >LunarXP Wins Space Innovator of the Year Award</h2>
                        <p>April 24, 2020</p>
                      </div>
                    </div>
                  </a>
                </div>
        
                <div class="box-news">
                  <a aria-label="New Spending Bill Expands Funding for Space Exploration" href="#">
                    <div class="row">
                      <div class="col-lg-3 col-4 pr-1">
                        <img alt="New Spending Bill Expands Funding for Space Exploration News Image" class="img-fluid" src="{{asset('assets/images/hero_1.jpg')}}">
                      </div>
                      <div class="col-lg-9 col-8 news-heading">
                        <h2>New Spending Bill Expands Funding for Space Exploration</h2>
                        <p>April 6, 2020 2:35 pm</p>
                      </div>
                    </div>
                  </a>
                </div>
        
                <div class="box-news">
                  <a aria-label="LunarXP Sets Target for First Mars Landing in 2030" href="#">
                    <div class="row">
                      <div class="col-lg-3 col-4 pr-1">
                        <img alt="LunarXP Sets Target for First Mars Landing in 2030 News Image" class="img-fluid" src="{{asset('assets/images/hero_1.jpg')}}">
                      </div>
                      <div class="col-lg-9 col-8 news-heading">
                        <h2 >LunarXP Sets Target for First Mars Landing in 2030</h2>
                        <p>March 20, 2020</p>
                      </div>
                    </div>
                  </a>
                </div>
        
                <div class="col-lg-9 offset-lg-3 col-md-8 offset-md-4 col-7 offset-4">
                  <a href="#" class="view">View All</a>
                </div>
              </div>
        
              <!-- End of News Section -->
        
              <!-- Alerts Section -->
              <div class="col-lg-6 col-12 pr-xl-0 mt-5 mt-lg-0">
                {{-- <h2 class="h1 mt-xl-n1 mb-4 mb-md-5 pb-2">workshop</h2> --}}
                <div class="row mb-0 justify-content-center text-center">
                  <div class="col-lg-4 mb-2">
                    <h2 class="section-title-underline mb-5">
                      <span>Workshop</span>
                    </h2>
                  </div>
                </div>
        
                <div class="box-news box-news--alerts">
                  <a aria-label="Astronaut Leadership Training Canceled" href="#">
                    <div class="row">
                      <div class="col-lg-3 col-4 pr-1">
                        <img src="{{asset('assets/images/hero_1.jpg')}}" class="img-fluid" alt="Astronaut Leadership Training Canceled">
                      </div>
                      <div class="col-lg-9 col-8 pl-xl-4 pr-xl-0 news-heading">
                        <h2>Astronaut Leadership Training Canceled</h2>
                        <p>April 20, 2020 2:46 pm</p>
                      </div>
                    </div>
                  </a>
                </div>
        
                <div class="box-news box-news--alerts">
                  <a aria-label="Habitat Offerings to Include New Hydroponics Lab" href="#">
                    <div class="row">
                      <div class="col-lg-3 col-4 pr-1">
                        <img src="{{asset('assets/images/hero_1.jpg')}}" class="img-fluid" alt="Habitat Offerings to Include New Hydroponics Lab">
                      </div>
                      <div class="col-lg-9 col-8 pl-xl-4 pr-xl-0 news-heading">
                        <h2>Habitat Offerings to Include New Hydroponics Lab</h2>
                        <p>March 20, 2020 2:45 pm</p>
                      </div>
                    </div>
                  </a>
                </div>
        
                <div class="box-news box-news--alerts">
                  <a aria-label="Lunar XPlorer transportation Delays" href="#">
                    <div class="row">
                      <div class="col-lg-3 col-4 pr-1">
                        <img src="{{asset('assets/images/hero_1.jpg')}}" class="img-fluid" alt="NLunar XPlorer transportation Delays">
                      </div>
                      <div class="col-lg-9 col-8 pl-xl-4 pr-xl-0 news-heading">
                        <h2>Lunar XPlorer transportation Delays</h2>
                        <p>February 20, 2020 2:44 pm</p>
                      </div>
                    </div>
                  </a>
                </div>
        
                <div class="col-lg-10 offset-lg-2 col-md-8 offset-md-4 col-7 offset-4">
                  <a href="#" class="view">View All</a>
                </div>
              </div>
              <!-- End of Alerts Section -->
            </div>
          </div>
        </section>


        {{-- Services  --}}
        <section class="bg-light pt-5 pb-5 shadow-sm">
          <div class="container">
            <div class="row mb-0 justify-content-center text-center">
              <div class="col-lg-4 mb-2">
                <h2 class="section-title-underline mb-0">
                  <span>Facilities</span>
                </h2>
              </div>
            </div>

          <div class="row pt-5">
            
          <div class="row">
          <div class="col-lg-4 mb-3 d-flex align-items-stretch">
          <div class="card">
          <img src="https://i.postimg.cc/28PqLLQC/dotonburi-canal-osaka-japan-700.jpg" class="card-img-top" alt="Card Image">
          <div class="card-body d-flex flex-column">
          <h5 class="card-title">Dōtonbori Canal</h5>
          <p class="card-text mb-4">Is a manmade waterway dug in the early 1600's and now displays many landmark commercial locals and vivid neon signs.</p>
          <a href="#" class="btn btn-primary text-white mt-auto align-self-start">Book now</a>
          </div>
          </div>
          </div>
          
          <div class="col-lg-4 mb-3 d-flex align-items-stretch">
          <div class="card">
          <img src="https://i.postimg.cc/4xVY64PV/porto-timoni-double-beach-corfu-greece-700.jpg" class="card-img-top" alt="Card Image">
          <div class="card-body d-flex flex-column">
          <h5 class="card-title">Porto Timoni Double Beach</h5>
          <p class="card-text mb-4">Near Afionas village, on the west coast of Corfu island. The two beaches form two unique bays. The turquoise color of the sea contrasts to the high green hills surrounding it.</p>
          <a href="#" class="btn btn-primary text-white mt-auto align-self-start">Book now</a>
          </div>
          </div>
          </div>
          
          <div class="col-lg-4 mb-3 d-flex align-items-stretch">
          <div class="card">
          <img src="https://i.postimg.cc/TYyLPJWk/tritons-fountain-valletta-malta-700.jpg" class="card-img-top" alt="Card Image">
          <div class="card-body d-flex flex-column">
          <h5 class="card-title">Tritons Fountain</h5>
          <p class="card-text mb-4">Located just outside the City Gate of Valletta, Malta. It consists of three bronze Tritons holding up a large basin, balanced on a concentric base built out of concrete and clad in travertine slabs.</p>
          <a href="#" class="btn btn-primary text-white mt-auto align-self-start">Book now</a>
          </div>
          </div>
          </div>
          </div>
          <div class="col-lg-10 offset-lg-2 col-md-8 offset-md-4 col-7 offset-4">
            <a href="#" class="view">View All</a>
          </div>
          </div>
          </section>
@endsection