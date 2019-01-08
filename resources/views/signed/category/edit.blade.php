@extends('layouts.signed')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('edit-category') }}</div>

                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('update-category', ['id' => $category->id]) }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="name"> {{ __('name') }} </label>
                                <input type="text" value="{{ $category->name }}" class="form-control" id="name" name="name" aria-describedby="Name" placeholder="Enter name">
                                @if ($errors->has('name'))
                                    <small id="name" class="form-text text-danger"> {{ $errors->first('name') }} </small>
                                @endif
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
