@extends('layouts.signed')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                        <img class="img-fluid mb-3" style="width:200px;" src="{{ asset('uploads/images/' . $user->detail->avatar) }}" alt="">
                    </div>
                    <div style="text-align:center;">
                        <div class="mb-2">
                            <div><b>{{ __('default.name') }}</b></div>
                            {{ $user->name }}
                        </div>
                        <div class="mb-2">
                            <div><b>{{ __('default.email') }}</b></div>
                            {{ $user->email }}
                        </div>
                        <div class="mb-2">
                            <div><b>{{ __('default.role') }}</b></div>
                            @if ($user->role == 0)
                                not define
                            @endif
                            @if ($user->role == 1)
                                admin
                            @endif
                            @if ($user->role == 2)
                                regist
                            @endif
                        </div>
                        <div class="mb-2">
                            <div><b>{{ __('default.joined_at') }}</b></div>
                            {{ $user->created_at->diffForHumans() }}
                        </div>
                        <div class="mb-2">
                            <div><b>{{ __('default.active') }}</b></div>
                            @if ($user->active == 1)
                                {{ __('default.yes') }}
                            @else
                                {{ __('default.no') }}
                            @endif
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
