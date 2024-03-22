@extends('layouts.master')


@section('content')
<div style="height: 7rem">

</div>
    <div class="row mb-0 justify-content-center text-center mt-5 mb-5">
     <div class="col-lg-4 mb-2">
      <h2 class="section-title-underline mb-0">
        <span>Event </span>
      </h2>
     </div>
    </div>

    <div class="container overflow-hidden">
        <div class="row gy-4 gy-lg-0">
          
            @foreach ($eventItem as $event)
            <div class="col-12 col-lg-4">
            <article>
                <div class="card border-0 pb-4">
                  <figure class="card-img-top m-0 overflow-hidden bsb-overlay-hover">
                    <a href="{{route('event.display', ['id' => $event->event_id])}}">
                        @if ($event->image_url)
                            <img class="img-fluid bsb-scale bsb-hover-scale-up" src="{{asset('storage/'. $event->image_url)}}" alt="">
                        @else
                            <img class="img-fluid " src="{{asset('assets/images/thumb.png')}}" alt="Image Description" />
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
                  <div class="card-body border bg-white p-4">
                    <div class="entry-header mb-3">
                      <h2 class="card-title entry-title h4 mb-0">
                        <a class="link-dark text-decoration-none" href="#!">{{$event->event_title}}</a>
                      </h2>
                    </div>
                  </div>
                </div>
              </article>
            </div>
                
             @endforeach

          </div>
        </div>
    </div>

@endsection