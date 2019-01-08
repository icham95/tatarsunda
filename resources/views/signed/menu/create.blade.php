@extends('layouts.signed')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('create-menu') }}</div>

                <div class="card-body">
                    <div class="container">
                        <form action="/menu/store" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="name"> {{ __('name') }} </label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="Name" placeholder="Enter name">
                                @if ($errors->has('name'))
                                    <small id="name" class="form-text text-danger"> {{ $errors->first('name') }} </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="link"> {{ __('link') }} </label>
                                <textarea class="form-control" id="link" name="link" rows="3" placeholder="Enter link"></textarea>
                                @if ($errors->has('link'))
                                    <small id="link" class="form-text text-danger"> {{ $errors->first('link') }} </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="type">type</label>
                                <select name="type" class="form-control" id="type">
                                <option value="1">Menu bawah</option>
                                <option value="2">Menu Atas</option>
                                </select>
                            </div>


                            <button type="submit" class="btn btn-primary">Create</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
