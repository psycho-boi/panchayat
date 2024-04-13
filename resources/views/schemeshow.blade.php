
@extends('layouts.master') <!-- Assuming you have a layout setup -->

@section('content')
 
   <div class="row mb-0 justify-content-center text-center mt-5 mb-5"> 
    <div class="col-lg-4 mb-2">
     <h2 class="section-title-underline mb-0">
       <span> </span>
     </h2>
    </div>
   </div>

   <div class="container">
    <div class="scheme-details ">
        <!-- Display the main image -->
        <div class="scheme-details">
            <!-- Display the main image -->
            @if ($mainImage)
            <div class="row justify-content-center align-items-center text-center">
                <div class="col-12">
                    <img src="{{ asset( 'storage/' . $mainImage->url) }}" alt="Main Image" style="width: 100%">
                </div>
            </div>
            @endif
            
            <!-- Title and description -->
            <div class="row">
                <div class="col">
                    <h2 class="sub-heading">{{ $scheme->title }}</h2>
                    <p class="">{{ $scheme->description }}</p>

                    <p class="mt-5">Eligibility:</p>
                    <p>{{$scheme->eligibility}}</p>
                </div>
            </div>

            @php
                $i=1;
            @endphp

         @if ($docs->isNotEmpty())  
         <h3 class="pt-t mt-5">Attachment</h3>  
            @foreach ($docs as $docs)
                <a href="{{ route('scheme.doc', ['scheme_doc_url' => $docs->url]) }}">
                <p>Attachment {{$i++}}</p>
                </a>
            @endforeach
        @endif
            
            <!-- Display other related images -->
            @if ($images->isNotEmpty())
            <div class="related-images">
                <h2>Additional Images</h2>
                <div class="row">
                    @foreach ($images as $image)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <img src="{{ asset('storage/' . $image->url) }}" alt="Related Image" class="img-fluid mb-3">
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

</div>
@endsection
