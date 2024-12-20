@extends('admin.master');

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


<!-- Check for any validation errors -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Check for error message -->
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif



{{-- <form action="{{ route('nenews.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="news_title">News Title:</label>
    <input type="text" name="news_title">
    <label for="news_content">News Content:</label>
    <textarea name="news_content"></textarea>
    <label for="news_photo">News Photo:</label>
    <input type="file" name="news_photo">
    <!-- Similar inputs for other sections (workshop, event, notice) -->
    <button type="submit">Submit</button>
</form> --}}



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-0 justify-content-center text-center">
                          <h2 class="section-title-underline ">
                            <span>Add News</span>
                          </h2>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" class="user-input" action="{{ route('news.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"  name="news_title" value="{{ old('news_title') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="news_content" required>{{ old('news_content') }}</textarea>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="images" class="col-md-4 col-form-label text-md-right">{{ __('Images') }}</label>

                            <div class="col-md-6">
                                {{-- <input id="images" type="file" class="form-control-file @error('images') is-invalid @enderror" name="news_photos[]" multiple > --}}
                                <input id="images" type="file" class="form-control-file @error('images') is-invalid @enderror" name="news_photos[]" multiple >

                                <ul id="image-list"></ul>
{{-- 
                                @error('images')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label for="pdfs" class="col-md-4 col-form-label text-md-right">{{ __('Docs') }}</label>

                            <div class="col-md-6">
                                <input id="pdfs" type="file" class="form-control-file @error('pdfs') is-invalid @enderror" name="news_doc[]" multiple accept="application/pdf">

                                @error('pdfs')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection