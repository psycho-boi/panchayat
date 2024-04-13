@extends('admin.master')

@section('content')
<!-- Check for success message -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


<div class="container pt-4 ">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-0 justify-content-center text-center">
                          <h2 class="section-title-underline ">
                            <span>Edit facilities</span>
                          </h2>
                    </div>
                </div>

                <div class="card-body">
        <form id="edit-facilities-form" method="POST" action="{{ route('facilities.update', $facilities->facility_id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group row mb-4">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control "  name="facilities_title" value="{{ $facilities->title  }}" required autocomplete="name" autofocus>
                </div>

            </div>

            <div class="form-group row mb-4">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                <div class="col-md-6">
                    <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="facilities_content" required>{{ $facilities->description }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="images" class="col-md-4 col-form-label text-md-right">{{ __('Images') }}</label>
                <div class="col-md-6">
                    <input id="images" type="file" class="form-control-file" name="facilities_photos[]" multiple >
                    <ul id="image-list"></u>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update facilities</button>
        </form>
    </div>
</div>
</div>
</div>
</div>
    <div class="container">
            <div id="photos-container" class="py-5 my-5">
                @if ($facilitiesImages)
                <h3 style="color: rgb(54, 53, 53)">Images</h3>
                <div id="photo-container" class="mt-3"></div>
                <div class="row">
                    @foreach ($facilitiesImages as $image)
                    <div class="photo-section col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="photo-item position-relative">
                            <img src="{{ asset(str_replace('public/', 'storage/', $image->url)) }}" alt="facilities Photo" class="img-thumbnail">
                            <button type="button" class="btn btn-danger btn-sm deactivate-photo position-absolute top-50 start-50 translate-middle" data-id="{{ $image->image_id }}">Delete</button>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        
    </div>
    
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            function photoMessage(message, isSuccess) {
                var alertClass = isSuccess ? 'alert-success' : 'alert-danger';
                var messageHtml = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
                                    message +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                        '<span aria-hidden="true">&times;</span>' +
                                    '</button>' +
                                  '</div>';

                $('#photo-container').html(messageHtml);
            }
            function docMessage(message, isSuccess) {
                var alertClass = isSuccess ? 'alert-success' : 'alert-danger';
                var messageHtml = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
                                    message +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                        '<span aria-hidden="true">&times;</span>' +
                                    '</button>' +
                                  '</div>';

                $('#doc-container').html(messageHtml);
            }

            



            // Deactivate photo
                $(document).on('click', '.deactivate-photo', function() {
                    var photoId = $(this).data('id');
                    var photoItem = $(this).closest('.photo-item');
                
                    // Display confirmation popup
                    if (confirm("Are you sure you want to deactivate this photo?")) {
                        $.ajax({
                            url: "{{ route('photos.deactivate', 'xxx') }}".replace('xxx', photoId),
                            type: 'PUT',
                            data: {
                                '_token': "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                photoItem.closest('.photo-section').remove();
                                photoItem.remove();
                                photoMessage(response, true);
                                
                            },
                            error: function(xhr) {
                                photoMessage('An error occurred while deactivating the photo.', false);
                            }
                        });
                    }
                });
                

                // Deactivate document
                $(document).on('click', '.deactivate-doc', function() {
                    var docId = $(this).data('id');
                    var docItem = $(this).closest('.doc-item');
                
                    // Display confirmation popup
                    if (confirm("Are you sure you want to deactivate this document?")) {
                        $.ajax({
                            url: "{{ route('docs.deactivate', 'xxx') }}".replace('xxx', docId),
                            type: 'PUT',
                            data: {
                                '_token': "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                docItem.remove();
                                docMessage(response, true);
                            },
                            error: function(xhr) {
                                docMessage('An error occurred while deactivating the document.', false);
                            }
                        });
                    }
                });

        });
    </script>
@endsection            