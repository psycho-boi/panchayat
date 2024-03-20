@extends('layouts.master')


@section('content')
<div style="height: 7rem">

</div>
    <div class="row mb-0 justify-content-center text-center mt-5">
     <div class="col-lg-4 mb-2">
      <h2 class="section-title-underline mb-0">
        <span>Forms </span>
      </h2>
     </div>
    </div>

    <div class="container pb-5">
      <ul class="list-group">
        @foreach ($formItem as $item)
            <a href=""> <h3> <li class="list-group-item" style="color: blue">{{$item->forms_title}} </li> </h3>  </a>
        @endforeach

          {{-- <a href=""> <h3> <li class="list-group-item" style="color: blue">Form number 1 </li> </h3>  </a>
          <a href=""> <h3> <li class="list-group-item" style="color: blue">Form number 2 </li> </h3>  </a>
          <a href=""> <h3> <li class="list-group-item" style="color: blue">Form number 3 </li> </h3>  </a>
          <a href=""> <h3> <li class="list-group-item" style="color: blue">Form number 4 </li> </h3>  </a>
          <a href=""> <h3> <li class="list-group-item" style="color: blue">Form number 5 </li> </h3>  </a> --}}
         
        
      </ul>
    </div>

@endsection