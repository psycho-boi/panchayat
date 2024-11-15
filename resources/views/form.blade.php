@extends('layouts.master')


@section('content')
{{-- @dd($formItem) --}}

<div style="height: 7rem">

</div>
    <div class="row mb-0 justify-content-center text-center mt-5">
     <div class="col-lg-4 mb-2">
      <h2 class="section-title-underline mb-0">
        <span>Forms </span>
      </h2>
     </div>
    </div>

    <div class="container pb-2 pt-4 mt-4">
      <ul class="list-group">
        @foreach ($formItem as $item)
            <a target="_blank" href="{{ route('form.doc', ['form_url' => $item->docs_url]) }}"> <h5> <li class="list-group-item" style="color: rgb(53, 53, 236)">{{$item->forms_title}} </li> </h5>  </a>
        @endforeach
        
      </ul>
    </div>

@endsection

