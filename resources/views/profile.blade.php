@extends('layouts.signed')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @auth
                @if (Auth()->user()->role == 1)
                    @if ($user->active == 0)
                        <a href="{{ route('confirmation-yes-user', ['id' => $user->id]) }}" class="mb-3 btn btn-primary"> Aktifkan User </a>
                    @endif
                @endif
            @endauth
            <div class="card">
                <div class="card-header d-flex">
                    <div class="flex-fill">
                        {{ __('profile') }}
                    </div>
                    <div class="flex-fill text-right">
                        @guest

                        @else
                            @if (auth()->user()->id == $user->id)
                                <a href="{{ route('pdf-user', ['id' => $user->id]) }}"
                                    class="btn btn-primary btn-sm">
                                    PDF
                                </a>
                            @endif
                        @endguest
                    </div>
                </div>

                <div class="card-body">
                    @if (is_null(!auth()->user()))
                        <a href="{{ route('edit-user', ['id' => $user->id]) }}" class="btn btn-primary"> {{ __('edit') }} </a>
                    @endif
                    <div style="text-align:center;">
                        <img class="img-fluid mb-3" style="width:200px;" src="{{ $user->detail->avatar }}" alt="">
                    </div>
                    <div style="text-align:center;">
                        <div class="mb-2">
                            <div><b>{{ __('default.name') }}</b></div>
                            {{ $user->name }}
                        </div>
                        <div class="mb-2">
                            <div><b>{{ __('default.location_date_of_birth') }}</b></div>
                            {{ $user->detail->date_of_birth }}
                        </div>
                        <div class="mb-2">
                            <div><b>{{ __('default.gender') }}</b></div>
                            @if ($user->detail->gender == 1)
                                {{ __('default.man') }}
                            @else
                                {{ __('default.woman') }}
                            @endif
                        </div>
                        <div class="mb-2">
                            <div><b>{{ __('default.religion') }}</b></div>
                            {{ $user->detail->religion->name }}
                        </div>
                        <div class="mb-2">
                            <div><b>{{ __('default.address') }}</b></div>
                            {{ $user->detail->address }}
                        </div>
                        <div class="mb-2">
                            <div><b>{{ __('default.the_village') }}</b></div>
                            {{ $user->detail->the_village }}
                        </div>
                        <div class="mb-2">
                            <div><b>{{ __('default.sub_district') }}</b></div>
                            {{ $user->detail->sub_district }}
                        </div>
                        <div class="mb-2">
                            <div><b>{{ __('default.pkb') }}</b></div>
                            {{ $user->detail->pkb }}
                        </div>
                        <div class="mb-2">
                            <div><b>{{ __('default.zip_code') }}</b></div>
                            {{ $user->detail->zip_code }}
                        </div>
                        <div class="mb-2">
                            <div><b>{{ __('default.job') }}</b></div>
                            {{ $user->detail->job }}
                        </div>
                        <div class="mb-2">
                            <div><b>{{ __('default.graduates') }}</b></div>
                            {{ $user->detail->graduates }}
                        </div>
                        <div class="mb-2">
                            <div><b>{{ __('default.contact') }}</b></div>
                            {{ $user->detail->contact }}
                        </div>
                        <div class="mb-2">
                            <div><b>{{ __('default.joined_at') }}</b></div>
                            {{ $user->created_at->diffForHumans() }}
                        </div>
                    </div>
                    {{-- <div style="text-align:center;">
                        <h4>article</h4>
                        @foreach ($user->articles as $article)
                            {{ $article->title }}
                        @endforeach
                    </div> --}}
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    {{ __('article') }}
                </div>
            </div>

            @foreach ($articles as $item)
                <div class="card text-center mt-3">
                    <div class="card-header">
                        @foreach ($item->article_categories as $category)
                            {{ $category->category->name }},
                        @endforeach
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('article', ['id' => $item->id]) }}">
                                {{ $item->title }}
                            </a>
                        </h5>
                    </div>
                    <div class="card-footer text-muted">
                        {{ $item->created_at->diffForHumans() }}
                    </div>
                </div>
            @endforeach

            <div class="mt-3">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
