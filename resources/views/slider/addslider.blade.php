@extends('admin.master');

@section('content')

<form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="slider_title">Slider Title:</label>
    <input type="text" name="slider_title">
    <label for="slider_content">slider Content:</label>
    <textarea name="slider_content"></textarea>
    <label for="slider_photo">slider Photo:</label>
    <input type="file" name="slider_photo">
    <!-- Similar inputs for other sections (workshop, event, notice) -->
    <button type="submit">Submit</button>
</form>


@endsection