@extends('layouts.master')

@section('content')

    <h2>THIS IS THE HOMEPAGE</h2>
        <div class="hero-slide owl-carousel site-blocks-cover">
           <div class="intro-section" style="background-image: url('{{asset('assets/images/hero_1.jpg')}}');">
             <div class="container">
               <div class="row align-items-center">
                 <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
                   <h1>Academics University</h1>
                 </div>
               </div>
             </div>
           </div>
       
           <div class="intro-section" style="background-image: url('{{asset('assets/images/+.jpg')}}');">
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
            <div class="row mb-5 justify-content-center text-center">
              <div class="col-lg-4 mb-5">
                <h2 class="section-title-underline mb-5">
                  <span>Why Academics Works</span>
                </h2>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 border-right">
    
                <div class="feature-1">
                  {{-- <div class="icon-wrapper bg-primary">
                    <span class="flaticon-mortarboard text-white"></span>
                  </div> --}}
                  <div class="feature-1-content">
                    {{-- <h2>Personalize Learning</h2> --}}
                    <img src="{{asset('assets/images/sarpanch.webp')}}" class="img-fluid rounded" alt="">
                    <h3>Name of sarpanch</h3>
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

@endsection