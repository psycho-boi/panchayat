@extends('layouts.master')


@section('content')
<div style="height: 7rem">

</div>
    <div class="row mb-0 justify-content-center text-center mt-5 mb-5">
     <div class="col-lg-4 mb-2">
      <h2 class="section-title-underline mb-0">
        <span>Schemes </span>
      </h2>
     </div>
    </div>




    <div class="container pb-5">
        {{-- <div class="panel panel-default"> --}}
            {{-- <div class="panel-heading">
                <h3 class="panel-title"></h3>
            </div>    --}}
            <ul class="list-group">

                @php
                    $i=1
                @endphp

                @foreach ($schemeItem as $scheme)
                <li class="list-group-item mt-4">
                    <div class="row " >
                        <div class="toggle col-1 col-sm-2" id="dropdown-detail-{{$i}}" data-toggle="detail-{{$i}}">
                            <button type="button" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="col-10 col-sm-10">
                            <a href="{{route('scheme.display', ['id' => $scheme->scheme_id])}}">
                            <h4>
                            {{$scheme->scheme_title}}
                            </h4>
                            </a>
                        </div>
                        <div class="col-xs-2"><i class="fa fa-chevron-down pull-right"></i></div>
                    </div>
                    <div id="detail-{{$i}}">
                        <hr></hr>
                        <div class="container">
                            <div class="fluid-row">
                                <div class="col-lg-1 col-sm-12" style="color: rgb(87, 82, 82)">
                                    Elibility:
                                </div>
                                <div class="col_lg-10 col-sm-12" style="color: rgb(87, 82, 82)">
                                   {{$scheme->scheme_eligibility}} 
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                @php
                    $i++
                @endphp
                @endforeach
                  
            </ul>
        {{-- </div> --}}
    </div>

    
    


   
    
   
<script>
    $(document).ready(function() {
        $('[id^=detail-]').hide();
        $('.toggle').click(function() {
            $input = $( this );
            $target = $('#'+$input.attr('data-toggle'));
            $target.slideToggle();
        });
    });
</script>
@endsection