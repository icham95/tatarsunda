@extends('layouts.signed')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                    @if (isset($_GET['key']))
                        @if ($_GET['key'] == 'confirmation')
                            {{ __('default.confirmation') }}
                        @elseif($_GET['key'] == 'active')
                            {{ __('default.active') }}
                        @elseif($_GET['key'] == 'all')
                            {{ __('default.all') }}
                        @else
                            Tatar Sunda
                        @endif
                    @endif
                </div>


                <div class="list-group">
                    @if ($users->count() < 1)
                        <div class="p-3"> {{ __('default.nothing_found') }} </div>
                    @endif
                    @foreach ($users as $user)
                        @if ($user->role != 1)
                        <div href="#" class="list-group-item flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><a href="{{ route('profile-user', ['id' => $user->id]) }}">{{ $user->name }}</a></h5>
                                <small> {{ $user->created_at }} </small>
                            </div>
                            <div class="d-flex w-100 justify-content-between">
                                <div></div>
                            </div>
                            <div style="margin-top:10px;">
                                @if (isset($_GET['key']))
                                    @if ($_GET['key'] == 'confirmation')
                                        <a href="{{ route('confirmation-yes-user', ['id' => $user->id]) }}" class="btn btn-success btn-sm"> {{ __('default.yes') }} </a>
                                    @endif
                                    @if ($_GET['key'] == 'active')
                                        <a href="{{ route('confirmation-no-user', ['id' => $user->id]) }}" class="btn btn-danger btn-sm"> {{ __('default.back_to_confirm') }} </a>
                                    @endif

                                @endif
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-8" style="margin-top:10px;">
            {{ $users->links() }}
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
