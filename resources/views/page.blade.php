@extends('layouts.welcome')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div>
                <h3>
                    @if ($category == 'adat-istiadat')
                        {{ __('default.adat-istiadat') }}
                    @elseif ($category == 'direktori-usaha')
                        {{ __('default.direktori-usaha') }}
                    @elseif ($category == 'info-jabar')
                        {{ __('default.info-jabar') }}
                    @elseif ($category == 'kuliner')
                        {{ __('default.kuliner') }}
                    @elseif ($category == 'museum')
                        {{ __('default.meseum') }}
                    @elseif ($category == 'pariwisata')
                        {{ __('default.pariwisata') }}
                    @elseif ($category == 'sanggar-dan-organisasi')
                        {{ __('default.sanggar-dan-organisasi') }}
                    @elseif ($category == 'seni-budaya')
                        {{ __('default.seni-budaya') }}
                    @elseif ($category == 'tokoh')
                        {{ __('default.tokoh') }}
                    @endif
                </h3>
            </div>

            <div class="content" id="content">
                @if (count($items) < 1)
                    <h5>Belum ada postingan.</h5>
                @endif
                @foreach ($items as $item)
                    <div class="media mb-4" id="content-real">
                        {{-- <div class="simage"> --}}
                        @php
                            preg_match('/(<img[^>]+>)/i', $item->content, $matches);
                            if (isset($matches[0])) {
                                $img = $matches[0];
                            } else {
                                $img = null;
                            }

                            if($img) {
                                echo $img;
                                // else goes here
                            } else {
                            }
                        @endphp
                        {{-- </div> --}}
                        <div class="media-body">
                            <h5 class="mt-0">
                                <a href="{{ route('article', ['id' => $item->id]) }}" style="color:black;">{{ $item->title }}</a>
                            </h5>
                            <p><small class="text-muted">{{ $item->created_at->diffForHumans() }}</small></p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        <div class="col-md-8">
            {{ $items->links() }}
        </div>
    </div>
</div>

<script>

</script>
@endsection

@section('addon')
{{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
<script>
    let content = document.getElementById('content');
    content.querySelectorAll('img').forEach((v) => {
        let contentReal = document.getElementById('content-real');
        v.src = v.src.replace('category/', '');
        v.width = '150';
        v.height = '100';
        v.classList.add('mr-3')
        v.style.borderRadius = '20px 0px'
    })
</script>

@endsection
