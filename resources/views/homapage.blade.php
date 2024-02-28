@extends('layouts.master')

@section('content')

       {{-- Slider --}}
       
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" >
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class=""></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2" class=""></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item">
        <img class="d-block carousel-img" src="{{asset('assets/images/slide1.jpeg')}}" data-holder-rendered="true">
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-heading">Village Panchayat Ghar</h5>
          <p></p>
        </div>
      </div>
      <div class="carousel-item active">
        <img class="d-block carousel-img" src="{{asset('assets/images/slide2.jpeg')}}" data-holder-rendered="true">
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-heading">Second slide label</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block carousel-img" src="{{asset('assets/images/slide3.jpeg')}}" data-holder-rendered="true">
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-heading">Third slide label</h5>
          <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block carousel-img" src="{{asset('assets/images/slide4.jpeg')}}" data-holder-rendered="true">
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-heading">Third slide label</h5>
          <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>




        {{-- <div class="hero-slide owl-carousel site-blocks-cover pb-0">
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
         </div> --}}

      
      <div class="container-fluid bg-danger p-0 m-0 pt-2">
        <div class="row justify-content-center text-white text-center">
          <marquee behavior="" direction="">  
            <p><strong>Timmings:  </strong>Monday to Friday 9AM TO 5PM & on Saturday 9AM TO 1PM</p>
          </marquee>
        </div>
      </div>


      {{-- sarpanch section...  --}}
         <div class="site-section mt-4" >
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
                    <h3 class="sarpanch-name">Devanand Vassant Parab</h3>
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
                    <p>
                      As the Sarpanch of Village Panchayat Pissurlem, it is a profound honour to hold this position of service. Our community is not only vibrant and continuously expanding but also resolute in its dedication to conserving our precious biodiversity, nurturing our unique village atmosphere, and safeguarding the rich heritage that defines our village.
                    </p>
                    <br>
                    <p>
                      At the very core of our identity lies a steadfast commitment to family values, which has been a cornerstone of our community for generations. Pissurlem stands adorned with its natural beauty, and our efforts to protect it are unwavering. Our village embraces the coexistence of nature and tradition, and it is this harmony that makes our home truly special.
                     </p>
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
                  <img class="card-img" src="{{asset('assets/images/skill.jpeg')}}" alt="Card image">
                  <div class="card-img-overlay overflow-hidden">
                    <div class="d-flex align-items-center">
                        <span class="bg-danger-gradiant badge overflow-hidden text-white px-3 py-1 font-weight-normal">Charity, Ngo</span>
                        <div class="ml-2">
                          <span class="ml-2">Feb 15, 2018</span>
                        </div>
                    </div>
                    <h5 class="card-title my-3 font-weight-normal bg-dark py-2">Skill Development Workshop</h5>
                    <p class="card-text">Lets make the  world a better place through technology.</p>
                  </div>
                </div>
              </div>
              <!-- Column -->
              <!-- Column -->
              <div class="col-md-4">
                <div class="card b-h-box position-relative font-14 border-0 mb-4">
                  <img class="card-img" src="{{asset('assets/images/plant.webp')}}" alt="Card image">
                  <div class="card-img-overlay overflow-hidden">
                    <div class="d-flex align-items-center">
                        <span class="bg-danger-gradiant badge overflow-hidden text-white px-3 py-1 font-weight-normal">Charity, Ngo</span>
                        <div class="ml-2">
                          <span class="ml-2">Feb 12, 2018</span>
                        </div>
                    </div>
                    <h5 class="card-title my-3 font-weight-normal bg-dark py-2">Plantation Drive</h5>
                    <p class="card-text">To the greener world!</p>
                  </div>
                </div>
              </div>
              <!-- Column -->
              <!-- Column -->
              <div class="col-md-4">
                <div class="card b-h-box position-relative font-14 border-0 mb-4">
                  <img class="card-img" src="{{asset('assets/images/voter.avif')}}" alt="Card image">
                  <div class="card-img-overlay overflow-hidden">
                    <div class="d-flex align-items-center">
                        <span class="bg-danger-gradiant badge overflow-hidden text-white px-3 py-1 font-weight-normal">Charity, Ngo</span>
                        <div class="ml-2">
                          <span class="ml-2">Feb 1, 2024</span>
                        </div>
                    </div>
                    <h5 class="card-title my-3 font-weight-normal bg-dark py-2">Voter Awareness Programme</h5>
                    <p class="card-text">Every vote  counts!</p>
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

                {{-- @dd($News); --}}
                @foreach ($News as $News)
                    <div class="box-news">
                      <a aria-label="LunarXP Wins Space Innovator of the Year Award" href="#">
                        <div class="row">
                          <div class="col-lg-3 col-4 pr-1">
                            <img alt="LunarXP Wins Space Innovator of the Year Award" class="img-fluid" src="{{asset('assets/images/house.jpg')}}">
                          </div>
                          <div class="col-lg-9 col-8 news-heading">
                            <h4>{{$News->title}}</h4>
                            <p>{{$News->created_at->format('M d, Y')}}</p>
                          </div>
                        </div>
                      </a>
                    </div>
                @endforeach
                
  
            
        
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
                        <img src="{{asset('assets/images/agriculture.jpg')}}" class="img-fluid" alt="Astronaut Leadership Training Canceled">
                      </div>
                      <div class="col-lg-9 col-8 pl-xl-4 pr-xl-0 news-heading">
                        <h4>Agricltural Workshop</h4>
                        <p>Feb 15, 2024</p>
                      </div>
                    </div>
                  </a>
                </div>  
                <div class="box-news box-news--alerts">
                  <a aria-label="Astronaut Leadership Training Canceled" href="#">
                    <div class="row">
                      <div class="col-lg-3 col-4 pr-1">
                        <img src="{{asset('assets/images/health.jpg')}}" class="img-fluid" alt="Astronaut Leadership Training Canceled">
                      </div>
                      <div class="col-lg-9 col-8 pl-xl-4 pr-xl-0 news-heading">
                        <h4>Health&Sanitation Workshop</h4>
                        <p>Feb 2, 2024</p>
                      </div>
                    </div>
                  </a>
                </div>  
                <div class="box-news box-news--alerts">
                  <a aria-label="Astronaut Leadership Training Canceled" href="#">
                    <div class="row">
                      <div class="col-lg-3 col-4 pr-1">
                        <img src="{{asset('assets/images/woman.jpg')}}" class="img-fluid" alt="Astronaut Leadership Training Canceled">
                      </div>
                      <div class="col-lg-9 col-8 pl-xl-4 pr-xl-0 news-heading">
                        <h4>Women Empowerment Workshop</h4>
                        <p>Jan 28, 2024</p>
                      </div>
                    </div>
                  </a>
                </div>  
                
                @foreach ($Workshop as $Workshop)
                  <div class="box-news box-news--alerts">
                  <a aria-label="Astronaut Leadership Training Canceled" href="#">
                    <div class="row">
                      <div class="col-lg-3 col-4 pr-1">
                        <img src="{{asset('assets/images/hero_1.jpg')}}" class="img-fluid" alt="Astronaut Leadership Training Canceled">
                      </div>
                      <div class="col-lg-9 col-8 pl-xl-4 pr-xl-0 news-heading">
                        <h4>{{$Workshop->title}}</h4>
                        <p>{{$Workshop->created_at->format('M d, Y')}}</p>
                      </div>
                    </div>
                  </a>
                  </div>    
                @endforeach
        
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
          <img src="{{asset('assets/images/ambulance.webp')}}" class="card-img-top" alt="Card Image">
          <div class="card-body d-flex flex-column align-items-center">
          <h3 class="card-title ">Ambulance</h3>
          <p class="card-text mb-4"></p>
          <a href="#" class="btn btn-primary text-white mt-auto align-self-start">Book now</a>
          </div>
          </div>
          </div>
          
          <div class="col-lg-4 mb-3 d-flex align-items-stretch">
          <div class="card">
          <img src="{{asset('assets/images/hall.webp')}}" class="card-img-top" alt="Card Image">
          <div class="card-body d-flex flex-column align-items-center">
          <h3 class="card-title">Auditorium</h3>
          <p class="card-text mb-4"></p>
          <a href="#" class="btn btn-primary text-white mt-auto align-self-start">Book now</a>
          </div>
          </div>
          </div>
          
          <div class="col-lg-4 mb-3 d-flex align-items-stretch">
          <div class="card">
          <img src="{{asset('assets/images/ground.webp')}}" class="card-img-top" alt="Card Image">
          <div class="card-body d-flex flex-column align-items-center">
          <h3 class="card-title">Football Ground </h3>
          <p class="card-text mb-4"></p>
          <a href="#" class="btn btn-primary text-white mt-auto align-self-start">Book now</a>
          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mb-0 justify-content-end text-center">
       <div class="col-lg-4 mb-0">
         <h5 class="mb-0 ">
           <a href="#" class="underline"><span>view all</span></a>
         </h5>
       </div>
    </div>
          </section>
@endsection