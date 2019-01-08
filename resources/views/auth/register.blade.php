@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('default.register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('default.name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="{{ __('default.name') }}" autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_induk" class="col-md-4 col-form-label text-md-right">
                                {{__('default.no_induk')}}
                            </label>

                            <div class="col-md-6">
                                <input id="no_induk" type="text" class="form-control{{ $errors->has('no_induk') ? ' is-invalid' : '' }}"
                                    name="no_induk" value="{{ old('no_induk') }}"  placeholder="{{__('default.no_induk')}}">

                                @if ($errors->has('no_induk'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('no_induk') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">
                                {{ __('default.location_date_of_birth') }}
                            </label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="location" type="text" name="location" aria-label="{{ __('default.location') }}"
                                        class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}"
                                        value="{{ old('location') }}"
                                        placeholder="location">
                                    <input id="date_of_birth" type="date" name="date_of_birth" aria-label="{{ __('default.date_of_birth') }}"
                                        class="form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}"
                                        value="{{ old('date_of_birth') }}"
                                        placeholder="{{ __('default.date_of_birth') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">
                                {{ __('default.gender') }}
                            </label>

                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" checked type="radio" name="gender" id="radio-pria" value="1">
                                    <label class="form-check-label" for="radio-pria">{{ __('default.man') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="radio-wanita" value="2">
                                    <label class="form-check-label" for="radio-wanita">{{ __('default.woman') }}</label>
                                </div>

                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="religion" class="col-md-4 col-form-label text-md-right">
                                {{ __('default.religion') }}
                            </label>

                            <div class="col-md-6">
                                <select name="religion" class="form-control{{ $errors->has('religion') ? ' is-invalid' : '' }}"
                                    class="form-control" id="religion">
                                    @foreach ($religions as $religion)
                                        <option value="{{ $religion->id }}">{{ $religion->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('religion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('religion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">
                                {{ __('default.address') }}
                            </label>

                            <div class="col-md-6">
                                <textarea name="address" id="address"
                                    class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('default.address') }}">{{ old('location') }}</textarea>

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="the_village" class="col-md-4 col-form-label text-md-right">
                                {{ __('default.the_village') }}
                            </label>

                            <div class="col-md-6">
                                <input id="the_village" type="text"
                                    class="form-control{{ $errors->has('the_village') ? ' is-invalid' : '' }}"
                                    name="the_village" value="{{ old('the_village') }}" placeholder="{{ __('default.the_village') }}">

                                @if ($errors->has('the_village'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('the_village') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sub_district" class="col-md-4 col-form-label text-md-right">
                                {{ __('default.sub_district') }}
                            </label>

                            <div class="col-md-6">
                                <input id="sub_district" type="text"
                                    class="form-control{{ $errors->has('sub_district') ? ' is-invalid' : '' }}"
                                    name="sub_district" value="{{ old('sub_district') }}" placeholder="{{__('default.sub_district')}}">

                                @if ($errors->has('sub_district'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sub_district') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pkb" class="col-md-4 col-form-label text-md-right">
                                {{ __('default.pkb') }}
                            </label>

                            <div class="col-md-6">
                                <input id="pkb" type="text"
                                    class="form-control{{ $errors->has('pkb') ? ' is-invalid' : '' }}"
                                    name="pkb" value="{{ old('pkb') }}" placeholder="{{ __('default.pkb_example') }}">

                                @if ($errors->has('pkb'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pkb') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="zip_code" class="col-md-4 col-form-label text-md-right">
                                {{ __('default.zip_code') }}
                            </label>

                            <div class="col-md-6">
                                <input id="zip_code" type="text"
                                    class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}"
                                    name="zip_code" value="{{ old('zip_code') }}" placeholder="{{ __('default.kode pos') }}">

                                @if ($errors->has('zip_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('zip_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="job" class="col-md-4 col-form-label text-md-right">
                                {{ __('default.job') }}
                            </label>

                            <div class="col-md-6">
                                <input id="job" type="text"
                                    class="form-control{{ $errors->has('job') ? ' is-invalid' : '' }}"
                                    name="job" value="{{ old('job') }}" placeholder="{{ __('default.job') }}">

                                @if ($errors->has('job'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('job') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="graduates" class="col-md-4 col-form-label text-md-right">
                                {{ __('default.graduates') }}
                            </label>

                            <div class="col-md-6">
                                <input id="graduates" type="text"
                                    class="form-control{{ $errors->has('graduates') ? ' is-invalid' : '' }}"
                                    name="graduates" value="{{ old('graduates') }}" placeholder="{{ __('default.graduates') }}">

                                @if ($errors->has('graduates'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('graduates') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact" class="col-md-4 col-form-label text-md-right">
                                {{ __('default.contact') }}
                            </label>

                            <div class="col-md-6">
                                <input id="contact" type="text"
                                    class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}"
                                    name="contact" value="{{ old('contact') }}" placeholder="{{ __('default.contact') }}">

                                @if ($errors->has('contact'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="purpose" class="col-md-4 col-form-label text-md-right">
                                {{ __('default.purpose') }}
                            </label>

                            <div class="col-md-6">
                                <input id="purpose" type="text"
                                    class="form-control{{ $errors->has('purpose') ? ' is-invalid' : '' }}"
                                    name="purpose" value="{{ old('purpose') }}" placeholder="{{ __('default.purpose') }}">

                                @if ($errors->has('purpose'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('purpose') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="reference" class="col-md-4 col-form-label text-md-right">
                                {{ __('default.reference') }}
                            </label>

                            <div class="col-md-6">
                                <input id="reference" type="text"
                                    class="form-control{{ $errors->has('reference') ? ' is-invalid' : '' }}"
                                    name="reference" value="{{ old('reference') }}" placeholder="{{ __('default.reference') }}">

                                @if ($errors->has('reference'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('reference') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('default.E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('default.Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="password" name="password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('default.Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="konfirmasi password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleFormControlFile1" class="col-md-4 col-form-label text-md-right">{{ __('default.avatar') }}</label>
                            <div class="col-md-6">
                                <input type="file" name="avatar" class="form-control-file" id="exampleFormControlFile1">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('default.register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
