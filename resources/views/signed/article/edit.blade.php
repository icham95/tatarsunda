@extends('layouts.signed')

@section('texteditor')
<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('update-article') }}</div>

                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('update-article', ['id' => $article->id]) }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="title"> {{ __('title') }} </label>
                                <input type="text" value="{{ $article->title }}" class="form-control" id="title" name="title" aria-describedby="title" placeholder="Enter title">
                                @if ($errors->has('title'))
                                    <small id="title" class="form-text text-danger"> {{ $errors->first('title') }} </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="content"> {{ __('content') }} </label>
                                <textarea class="form-control" id="content" name="content" rows="3" placeholder="Enter content">{!! $article->content !!}</textarea>
                                @if ($errors->has('content'))
                                    <small id="content" class="form-text text-danger"> {{ $errors->first('content') }} </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for=""> {{ __('default.categories') }} </label>
                                <div>
                                    @foreach ($categories as $category)
                                        <div class="form-check form-check-inline">
                                            <input type="radio" name="categories[]" class="form-check-input"
                                            value="{{ $category->id }}" id="check{{ $category->id }}">
                                            <label class="form-check-label" for="check{{ $category->id }}">
                                                {{ $category->name }}
                                            </label>
                                         </div>
                                    @endforeach
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('texteditor_run')
<script>
  tinymce.init({
    document_base_url : "{!! url('/') !!}",
    selector: '#content',
    height: 300,
    plugins: 'image code fullscreen',
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | fullscreen",
    // enable title field in the Image dialog
    image_title: true,
    // enable automatic uploads of images represented by blob or data URIs
    automatic_uploads: true,
    // URL of our upload handler (for more details check: https://www.tinymce.com/docs/configure/file-image-upload/#images_upload_url)
    images_upload_url: '/article/upload-image',
    // images_upload_base_path: '/uploads/images',
    // here we add custom filepicker only to Image dialog
    file_picker_types: 'image',
    // and here's our custom image picker
    file_picker_callback: function(cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        // Note: In modern browsers input[type="file"] is functional without
        // even adding it to the DOM, but that might not be the case in some older
        // or quirky browsers like IE, so you might want to add it to the DOM
        // just in case, and visually hide it. And do not forget do remove it
        // once you do not need it anymore.

        input.onchange = function() {
        var file = this.files[0];

        var reader = new FileReader();
        reader.onload = function () {
            // Note: Now we need to register the blob in TinyMCEs image blob
            // registry. In the next release this part hopefully won't be
            // necessary, as we are looking to handle it internally.
            var id = 'blobid' + (new Date()).getTime();
            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(',')[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);

            // call the callback and populate the Title field with the file name
            cb(blobInfo.blobUri(), { title: file.name });
        };
        reader.readAsDataURL(file);
        };

        input.click();
    }
  });
</script>
@endsection
