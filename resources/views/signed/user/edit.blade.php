@extends('layouts.signed')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('edit-user') }}</div>

                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('update-user', ['id' => $user->id]) }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="name"> {{ __('name') }} </label>
                                <input type="text" value="{{ $user->name }}" class="form-control" id="name" name="name" aria-describedby="Name" placeholder="Enter name">
                                @if ($errors->has('name'))
                                    <small id="name" class="form-text text-danger"> {{ $errors->first('name') }} </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email"> {{ __('email') }} </label>
                                <input type="text" value="{{ $user->email }}" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Enter email">
                                @if ($errors->has('email'))
                                    <small id="email" class="form-text text-danger"> {{ $errors->first('email') }} </small>
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
