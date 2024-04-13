@extends('admin.master');

@section('content')

<!-- Check for success message -->
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


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-0 justify-content-center text-center">
                          <h2 class="section-title-underline ">
                            <span>Add Event</span>
                          </h2>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" class="user-input" action="{{ route('event.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"  name="event_title" value="{{ old('event_title') }}" required autocomplete="name" autofocus>

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
                                <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="event_content" required>{{ old('event_content') }}</textarea>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"  name="event_location" value="{{ old('event_location') }}" required autocomplete="name" autofocus>

                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="start_datetime" class="col-md-4 col-form-label text-md-right">{{ __('Start Date and Time') }}</label>

                            <div class="col-md-6">
                                <input id="start_datetime" type="datetime-local" class="form-control @error('start_datetime') is-invalid @enderror" name="start_datetime" value="{{ old('start_datetime') }}" required>
                            </div>
                        </div>

                        <!-- End Date and Time -->
                        <div class="form-group row">
                            <label for="end_datetime" class="col-md-4 col-form-label text-md-right">{{ __('End Date and Time') }}</label>

                            <div class="col-md-6">
                                <input id="end_datetime" type="datetime-local" class="form-control @error('end_datetime') is-invalid @enderror" name="end_datetime" value="{{ old('end_datetime') }}" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="images" class="col-md-4 col-form-label text-md-right">{{ __('Images') }}</label>

                            <div class="col-md-6">
                                <input id="images" type="file" class="form-control-file @error('images') is-invalid @enderror" name="event_photos[]" multiple >
                                {{-- <ul id="image-list"></ul> --}}

                                @error('images')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pdfs" class="col-md-4 col-form-label text-md-right">{{ __('Docs') }}</label>

                            <div class="col-md-6">
                                <input id="pdfs" type="file" class="form-control-file @error('pdfs') is-invalid @enderror" name="event_doc[]" multiple accept="application/pdf">

                                @error('pdfs')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

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