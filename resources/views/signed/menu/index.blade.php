@extends('layouts.signed')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('menu') }}
                </div>


                <div class="list-group">
                    @foreach ($menus as $menu)
                        <div href="#" class="list-group-item flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $menu->name }}</h5>
                                <small> {{ $menu->created_at }} </small>
                            </div>
                            <div class="d-flex w-100 justify-content-between">
                                <small> <a href="{{ $menu->link }}">{{ $menu->link }}</a></small>
                                <small> {{ __('by') }} {{ $menu->user->name }}</small>
                            </div>
                            <small><i> type :
                            @if ($menu->type == 1)
                                menu bawah
                            @else
                                menu atas
                            @endif
                            </i></small>
                            <div style="margin-top:10px;">
                                <a href="{{ route('edit-menu', ['id' => $menu->id]) }}" class="btn btn-success btn-sm"> {{ __('edit') }} </a>
                                <a onclick="deletePrompt(event, '{{$menu->name}}', 'r')" href="{{ route('delete-menu', ['id' => $menu->id]) }}" class="btn btn-danger btn-sm"> {{ __('delete') }} </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-8" style="margin-top:10px;">
            {{ $menus->links() }}
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
