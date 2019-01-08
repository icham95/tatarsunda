@extends('layouts.signed')

@section('content')

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8" style="margin-bottom:10px;">
            <div class="card">
                <div class="card-header d-flex">
                    <div class="flex-fill">

                    </div>
                    <div class="flex-fill" style="text-align:right;">
                        <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            {{ __('default.helper') }}
                        </a>
                    </div>
                </div>

                <div class="card-body collapse" id="collapseExample">
                    <form action="" method="">
                        <input type="hidden" name="key"
                            value="{{ isset($_GET['key']) ? $_GET['key'] : '' }}">
                        <input type="hidden" name="sort" value="{{ $_GET['sort'] }}">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" name="search"
                                    value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}"
                                    class="form-control form-control-sm"
                                    placeholder="{{ __('default.search') }}">
                                <div class="input-group-prepend">
                                    <button class="btn btn-sm btn-outline-secondary"
                                        type="input">
                                        {{ __('default.search') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div>
                                {{ __('default.sort') }}
                            </div>
                            @if (isset($_GET['search']))
                                <a href="{{ request()->fullUrlWithQuery(["sort"=>"asc", 'search' => $_GET['search']]) }}" class="btn btn-sm btn-primary">ASC</a>
                                <a href="{{ request()->fullUrlWithQuery(["sort"=>"desc", 'search' => $_GET['search']]) }}" class="btn btn-sm btn-primary">DESC</a>
                            @else
                                <a href="{{ request()->fullUrlWithQuery(["sort"=>"asc"]) }}" class="btn btn-sm btn-primary">ASC</a>
                                <a href="{{ request()->fullUrlWithQuery(["sort"=>"desc"]) }}" class="btn btn-sm btn-primary">DESC</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                    <div class="flex-fill">
                    @if (isset($_GET['search']))
                        {{ __('default.search') }}
                    @endif
                    @if (isset($_GET['key']))
                        @if ($_GET['key'] == 'draft')
                            {{ __('default.draft') }}
                        @elseif($_GET['key'] == 'rejected')
                            {{ __('default.rejected') }}
                        @elseif($_GET['key'] == 'send')
                            {{ __('default.send') }}
                        @elseif($_GET['key'] == 'published')
                            {{ __('default.published') }}
                        @elseif($_GET['key'] == 'all')
                            {{ __('default.all_article') }}
                        @elseif($_GET['key'] == 'confirmation')
                            {{ __('default.confirmation') }}
                        @elseif($_GET['key'] == 'publish')
                            {{ __('default.publish') }}
                        @else
                            {{ __('default.article') }}
                        @endif
                    @else
                        {{ __('default.article') }}
                    @endif
                    @if (isset($_GET['search']))
                        : {{ $_GET['search'] }}
                    @endif
                    </div>
                    <div class="flex-fill" style="text-align:right;">
                        @if (isset($_GET['search']))
                            @if ($_GET['key'] == 'draft')
                                <a href="{{ route('index-article') . '?sort=desc&key=draft' }}"
                                    class="btn btn-sm btn-primary">
                                    {{ __('default.draft') }}
                                </a>
                            @elseif($_GET['key'] == 'rejected')
                                <a href="{{ route('index-article') . '?sort=desc&key=rejected' }}"
                                    class="btn btn-sm btn-primary">
                                    {{ __('default.rejected') }}
                                </a>
                            @elseif($_GET['key'] == 'send')
                                <a href="{{ route('index-article') . '?sort=desc&key=send' }}"
                                    class="btn btn-sm btn-primary">
                                    {{ __('default.send') }}
                                </a>
                            @elseif($_GET['key'] == 'published')
                                <a href="{{ route('index-article') . '?sort=desc&key=published' }}"
                                    class="btn btn-sm btn-primary">
                                    {{ __('default.published') }}
                                </a>
                            @elseif($_GET['key'] == 'all')
                                <a href="{{ route('index-article') . '?sort=desc&key=all' }}"
                                    class="btn btn-sm btn-primary">
                                    {{ __('default.all_article') }}
                                </a>
                            @elseif($_GET['key'] == 'confirmation')
                                <a href="{{ route('index-article') . '?sort=desc&key=confirmation' }}"
                                    class="btn btn-sm btn-primary">
                                    {{ __('default.confirmation') }}
                                </a>
                            @elseif($_GET['key'] == 'publish')
                                <a href="{{ route('index-article') . '?sort=desc&key=publish' }}"
                                    class="btn btn-sm btn-primary">
                                    {{ __('default.publish') }}
                                </a>
                            @else
                                <a href="{{ route('index-article') }}"
                                    class="btn btn-sm btn-primary">
                                    {{ __('default.article') }}
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="list-group">
                    @if ($articles->count() < 1)
                    <div class="card-body">
                        {{ __('default.nothing_found') }}
                    </div>
                    @endif
                    @foreach ($articles as $article)
                        <div href="#" class="list-group-item flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $article->title }}</h5>
                                <small> {{ $article->created_at }} </small>
                            </div>
                            <div class="d-flex w-100 justify-content-between">
                                <div>  </div>
                                <small> {{ __('default.by') }} {{ $article->user->name }}</small>
                            </div>
                            <small><i>
                            @if ($article->status == 1)
                                {{ __('default.published') }}
                            @endif
                            @if ($article->status == 2)
                                {{ __('default.confirmation') }}
                            @endif
                            @if ($article->status == 3)
                                {{ __('default.rejected') }}
                            @endif
                            @if ($article->status == 4)
                                @if (auth()->user()->role == 1)
                                    {{ __('default.confirmation') }}
                                @else
                                    {{ __('default.send') }}
                                @endif
                            @endif
                            @if ($article->status == 5)
                                {{ __('default.draft') }}
                            @endif
                            </i></small>
                            <div>
                                @foreach ($article->article_categories as $item)
                                    {{ $item->category->name }} |
                                @endforeach
                            </div>
                            <div style="margin-top:10px;">
                                @if (auth()->user()->role == 1)
                                    @if ($article->status != 1 && $article->status != 3 && $article->status != 5)
                                        <a href="{{ route('publish-article', ['id' => $article->id]) }}" class="btn btn-primary btn-sm"> {{ __('default.publish') }} </a>
                                        <a href="{{ route('reject-article', ['id' => $article->id]) }}" class="btn btn-danger btn-sm"> {{ __('default.reject') }} </a>
                                    @endif
                                @endif

                                @if (isset($_GET['key']))
                                    @if ($_GET['key'] == 'publish' || $_GET['key'] == 'not_approved')
                                        <a href="{{ route('confirm-article', ['id' => $article->id]) }}" class="btn btn-danger btn-sm"> {{ __('default.back_to_confirm') }} </a>
                                    @endif

                                    @if ($_GET['key'] == 'rejected')
                                        <a href="{{ route('confirm-article', ['id' => $article->id]) }}" class="btn btn-primary btn-sm"> {{ __('default.send_back') }} </a>
                                    @endif

                                @endif

                                @if ($article->created_by == auth()->user()->id)
                                    <a href="{{ route('edit-article', ['id' => $article->id]) }}" class="btn btn-success btn-sm"> {{ __('default.edit') }} </a>
                                    <a onclick="deletePrompt(event, '{{$article->title}}', 'r')" href="{{ route('delete-article', ['id' => $article->id]) }}" class="btn btn-danger btn-sm"> {{ __('default.delete') }} </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-8" style="margin-top:10px;">
            @if (isset($_GET['key']))
                @if (isset($_GET['search']))
                    {{ $articles->appends([
                        'key' => $_GET['key'],
                        'search' => $_GET['search'],
                        'sort' => $_GET['sort']
                    ])->links() }}
                @else
                    {{ $articles->appends([
                        'key' => $_GET['key'],
                        'sort' => $_GET['sort']
                    ])->links() }}
                @endif
            @else
                {{ $articles->appends([
                    'sort' => $_GET['sort']
                ])->links() }}
            @endif
        </div>

    </div>
</div>

<script>
function deletePrompt(e, title, location) {
    let m = confirm('delete, ' + title + ' ?')
    if (m) {

    } else {
        e.preventDefault();
    }
}
</script>

@endsection
