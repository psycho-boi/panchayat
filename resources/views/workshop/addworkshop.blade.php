@extends('admin.master');

@section('content')

<form action="{{ route('workshop.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="ws_title">Workshop Title:</label>
    <input type="text" name="ws_title">
    <label for="ws_content">Workshop Content:</label>
    <textarea name="ws_content"></textarea>
    <label for="ws_content">Workshop Location:</label>
    <input type="text" name="ws_location">
    <label for="ws_photo">Workshop Photo:</label>
    <input type="file" name="ws_photos[]" id="ws_photos" class="form-control-file" multiple>
    <label for="ws_photo">Workshop Doc:</label>
    <input type="file" name="ws_doc">

    <button type="submit">Submit</button>
</form>


@endsection 