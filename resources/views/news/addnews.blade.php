@extends('admin.master');

@section('content')

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