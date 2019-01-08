@extends('layouts.signed')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('category') }}
                </div>


                <div class="list-group">
                    @foreach ($categories as $category)
                        <div href="#" class="list-group-item flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $category->name }}</h5>
                                <small> {{ $category->created_at }} </small>
                            </div>
                            <div class="d-flex w-100 justify-content-between">
                                <div></div>
                                <small> {{ __('by') }} {{ $category->user->name }}</small>
                            </div>
                            <div style="margin-top:10px;">
                                <a href="{{ route('edit-category', ['id' => $category->id]) }}" class="btn btn-success btn-sm"> {{ __('edit') }} </a>
                                <a onclick="deletePrompt(event, '{{$category->name}}', 'r')" href="{{ route('delete-category', ['id' => $category->id]) }}" class="btn btn-danger btn-sm"> {{ __('delete') }} </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


        <div class="col-md-8" style="margin-top:10px;">
            {{ $categories->links() }}
        </div>

    </div>
</div>

<script>
function deletePrompt(e, name, location) {
    let m = confirm('delete, ' + name + ' ?')
    if (m) {

    } else {
        e.preventDefault();
    }
}
</script>

@endsection
