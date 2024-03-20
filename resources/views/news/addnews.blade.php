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



<form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="news_title">News Title:</label>
    <input type="text" name="news_title">
    <label for="news_content">News Content:</label>
    <textarea name="news_content"></textarea>
    <label for="news_photo">News Photo:</label>
    <input type="file" name="news_photo">
    <!-- Similar inputs for other sections (workshop, event, notice) -->
    <button type="submit">Submit</button>
</form>


@endsection