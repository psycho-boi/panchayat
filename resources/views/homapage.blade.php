@extends('layouts.master')

@section('title', 'VP Pissurlem')

@section('content')



       {{-- Slider --}}
       
  {{-- <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" >
   


    <ol class="carousel-indicators">
      @foreach($sliderItem as $key => $sliderol)
          <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" class="{{$loop->first ? 'active' : ''}}"></li>
      @endforeach
  </ol>
  


    <div class="carousel-inner">
      
      @foreach ($sliderItem as $slider)
          <div class="carousel-item active">
            <img class="d-block carousel-img" src="{{asset(''. $slider->image_url)}}" data-holder-rendered="true">
            <div class="carousel-caption d-none d-md-block">
              <h5 class="carousel-heading">{{$slider->slider_title}}</h5>
              <p></p>
            </div>
          </div>
      @endforeach
      
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div> --}}





      
      



      <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($sliderItem as $key => $sliderol)
                <li data-target="#carouselExampleCaptions" data-slide-to="{{$key}}" class="{{$loop->first ? 'active' : ''}}"></li>
            @endforeach
        </ol>
      
        <div class="carousel-inner">
          
            @foreach ($sliderItem as $key => $slider)
                <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                    <img class="d-block carousel-img" src="{{asset(''. $slider->image_url)}}" data-holder-rendered="true">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="carousel-heading">{{$slider->slider_title}}</h5>
                        <p></p>
                    </div>
                </div>
            @endforeach
          
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
            <div class="row align-items-center justify-content-center">
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
                  <div class="feature-1-content pt-5 mt-5">
                    <h2>Know more</h2>
                    <p><a href="{{route('staff.list')}}" class="btn btn-primary px-4 rounded-0">view</a></p>
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
            
            
          
           <div class="row mt-2">
              @foreach ($eventItem as $event)
              <!-- Column -->
              <div class="col-md-4">
                <div class="card b-h-box position-relative font-14 border-0 mb-4 ">
                  <a href="{{route('event.display', ['id' => $event->event_id])}}">

                  @if ($event->image_url)
                  <img  class="card-img" src="{{asset('storage/' . $event->image_url)}}" alt="Card image">
                  @else
                  <img class="card-img" src="{{asset('assets/images/thumb.png')}}" alt="Card image">
                  @endif

                  <div cla ss="card-img-overlay overflow-hidden">
                    <div class="d-flex align-items-center">
                        {{-- <span class="bg-danger-gradiant badge overflow-hidden text-white px-3 py-1 font-weight-normal">Charity, Ngo</span> --}}
                        {{-- <div class="ml-2">
                          <span class="ml-2">Feb 15, 2018</span>
                        </div> --}}
                    </div>
                    <h3 class=" my-3  py-2" style=" color:rgb(49, 49, 49)">{{$event->event_title}}</h3>
                    {{-- <p class="card-text">Lets make the  world a better place through technology.</p> --}}
                  </div>
                 </a>
                </div>
              </div> 
              @endforeach
              <!-- Column -->
            </div>

            <div class="row mb-0 justify-content-end text-center">
              <div class="col-lg-4 mb-0">
                <h5 class="mb-0 ">
                  <a href="{{route('event.list')}}" class="underline"><span>view all</span></a>
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
                @foreach ($newsItem as $news)
                    <div class="box-news pt-3">
                      <a aria-label="LunarXP Wins Space Innovator of the Year Award" href="{{route('news.display', ['id' => $news->news_id])}}">
                        <div class="row">
                          <div class="col-lg-3 col-4 pr-1 align-item-center justify-content-center text-center">
                            {{-- <img alt="LunarXP Wins Space Innovator of the Year Award" class="img-fluid" src="{{asset('assets/images/house.jpg')}}"> --}}
                            @if($news->url)
                                <img style="height: 5rem;object-fit: cover" class="img-fluid" src="{{asset('storage/'. $news->url)}}" alt="no image found">
                            @else
                                <img class="img-fluid" src="{{asset('assets/images/thumb.png')}}" alt="no image found">
                            @endif 
                          </div>
                          <div class="col-lg-9 col-8 news-heading">
                            <h4>{{$news->news_title}}</h4>

                            <p>{{$news->created_at}}</p> 
                          </div>
                        </div>
                      </a>
                    </div>
                @endforeach
                
  
            
        
                <div class="col-lg-9 offset-lg-3 col-md-8 offset-md-4 col-7 offset-4">
                  <a href="{{route('news.list')}}" class="view">View All</a>
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

                {{-- <div class="box-news box-news--alerts">
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
                </div>   --}}
              
                @foreach ($workshopItem as $workshop)
                  <div class="box-news box-news--alerts pt-3">
                  <a aria-label="Astronaut Leadership Training Canceled" href="{{route('workshop.display', ['id' => $workshop->workshop_id])}}">
                    <div class="row align-item-center ">
                      <div class="col-lg-3 col-4 pr-1 justify-content-center text-center">
                        <img style="height: 5rem;object-fit: cover" src="{{asset('storage/' . $workshop->image_url)}}" class="img-fluid" alt="Astronaut Leadership Training Canceled">
                      </div>
                      <div class="col-lg-9 col-8 pl-xl-4 pr-xl-0 news-heading">
                        <h4>{{$workshop->workshop_title}}</h4>
                        <p>{{$workshop->created_at}}</p>
                      </div>
                    </div>
                  </a> 
                  </div>    
                @endforeach
        
                <div class="col-lg-10 offset-lg-2 col-md-8 offset-md-4 col-7 offset-4">
                  <a href="{{route('workshop.list')}}" class="view">View All</a>
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

            <div class="container overflow-hidden">
              <div class="row gy-4 gy-lg-0">
                
                  @foreach ($facilitiesItem as $facilities)
                  <div class="col-12 col-lg-4">
                  <article>
                      <div class="card border-0  align-item-center justify-content-center text-center">
                        <figure class="card-img-top m-0 overflow-hidden bsb-overlay-hover">
                          <a href="{{route('facilities.display', ['id' => $facilities->facility_id])}}">
                              @if ($facilities->image_url)
                                  <img style="height: 10rem;object-fit: cover" class="img-fluid bsb-scale bsb-hover-scale-up" src="{{asset( $facilities->image_url)}}" alt="">
                              @else
                                  <img style="height: 10rem;object-fit: cover" class="img-fluid " src="{{asset('assets/images/thumb.png')}}" alt="Image Description" />
                              @endif
                          </a>
                          <figcaption>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-eye text-white bsb-hover-fadeInLeft" viewBox="0 0 16 16">
                              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                              <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                            </svg>
                            <h4 class="h6 text-white bsb-hover-fadeInRight mt-2">Read More</h4>
                          </figcaption>
                        </figure>
                        <div class="card-body border bg-white ">
                          <div class="entry-header ">
                            <h2 class="card-title entry-title h4 mb-0">
                              <a class="link-dark text-decoration-none" href="#!">{{$facilities->facilities_title}}</a>
                            </h2>
                          </div>
                        </div>
                      </div>
                    </article>
                  </div>
                      
                   @endforeach
      
                </div>
              </div>
          
    <div class="row mb-0 justify-content-end text-center">
       <div class="col-lg-4 mb-0">
         <h5 class="mb-0 ">
           <a href="{{route('facilities.list')}}" class="underline"><span>view all</span></a>
         </h5>
       </div>
    </div>
          </section>
@endsection

