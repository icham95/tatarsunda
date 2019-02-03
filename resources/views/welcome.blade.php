@extends('layouts.welcome')

@section('content')
<div class="d-flex">
    <div class="flex-grow mt-3">

        <div class="d-flex">
            <div class="flex-grow" style="width:34%;">
                <div class="sheader">
                    {{ __('default.kuliner') }}
                </div>
                <div class="sbody d-flex flex-wrap mt-3">
                    @foreach ($kuliners as $kuliner)

                        <div class="card mb-3 border-0">
                            <div class="simage">
                            @php
                                preg_match('/(<img[^>]+>)/i', $kuliner->content, $matches);
                                if (isset($matches[0])) {
                                    $img = $matches[0];
                                } else {
                                    $img = null;
                                }
                                if($img) {
                                    echo $img;
                                } else {
                                    // else goes here
                                }
                            @endphp
                            </div>
                            <div class="scontent">
                                <h5 class="card-title"><a href="{{ route('article', ['id' => $kuliner->id]) }}"> {{ $kuliner->title }} </a></h5>
                                <p class="card-text"><small class="text-muted">{{ $kuliner->created_at->diffForHumans() }}</small></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex-grow" style="width:33%;">
                <div class="sheader">
                    {{ __('default.tokoh') }}
                </div>
                <div class="sbody d-flex flex-wrap mt-3">
                    @foreach ($tokohs as $tokoh)

                        <div class="card mb-3 border-0">
                            <div class="simage">
                            @php
                                preg_match('/(<img[^>]+>)/i', $tokoh->content, $matches);
                                if (isset($matches[0])) {
                                    $img = $matches[0];
                                } else {
                                    $img = null;
                                }
                                if($img) {
                                    echo $img;
                                } else {
                                    // else goes here
                                }
                            @endphp
                            </div>
                            <div class="scontent">
                                <h5 class="card-title"><a href="{{ route('article', ['id' => $tokoh->id]) }}"> {{ $tokoh->title }} </a></h5>
                                <p class="card-text"><small class="text-muted">{{ $tokoh->created_at->diffForHumans() }}</small></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex-grow" style="width:33%;">
                <div class="sheader">
                    {{ __('default.adat-istiadat') }}
                </div>
                <div class="sbody d-flex flex-wrap mt-3">
                    @foreach ($ais as $ai)

                        <div class="card mb-3 border-0">
                            <div class="simage">
                            @php
                                preg_match('/(<img[^>]+>)/i', $ai->content, $matches);
                                if (isset($matches[0])) {
                                    $img = $matches[0];
                                } else {
                                    $img = null;
                                }
                                if($img) {
                                    echo $img;
                                } else {
                                    // else goes here
                                }
                            @endphp
                            </div>
                            <div class="scontent">
                                <h5 class="card-title"><a href="{{ route('article', ['id' => $ai->id]) }}"> {{ $ai->title }} </a></h5>
                                <p class="card-text"><small class="text-muted">{{ $ai->created_at->diffForHumans() }}</small></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="d-flex">
            <div class="flex-grow" style="width:34%;">
                <div class="sheader">
                    {{ __('default.pariwisata') }}
                </div>
                <div class="sbody d-flex flex-wrap mt-3">
                    @foreach ($pariwisatas as $pariwisata)

                        <div class="card mb-3 border-0">
                            <div class="simage">
                            @php
                                preg_match('/(<img[^>]+>)/i', $pariwisata->content, $matches);
                                if (isset($matches[0])) {
                                    $img = $matches[0];
                                } else {
                                    $img = null;
                                }
                                if($img) {
                                    echo $img;
                                } else {
                                    // else goes here
                                }
                            @endphp
                            </div>
                            <div class="scontent">
                                <h5 class="card-title"><a href="{{ route('article', ['id' => $pariwisata->id]) }}"> {{ $pariwisata->title }} </a></h5>
                                <p class="card-text"><small class="text-muted">{{ $pariwisata->created_at->diffForHumans() }}</small></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex-grow" style="width:33%;">
                <div class="sheader">
                    {{ __('default.info-jabar') }}
                </div>
                <div class="sbody d-flex flex-wrap mt-3">
                    @foreach ($ijs as $ij)

                        <div class="card mb-3 border-0">
                            <div class="simage">
                            @php
                                preg_match('/(<img[^>]+>)/i', $ij->content, $matches);
                                if (isset($matches[0])) {
                                    $img = $matches[0];
                                } else {
                                    $img = null;
                                }
                                if($img) {
                                    echo $img;
                                } else {
                                    // else goes here
                                }
                            @endphp
                            </div>
                            <div class="scontent">
                                <h5 class="card-title"><a href="{{ route('article', ['id' => $ij->id]) }}"> {{ $ij->title }} </a></h5>
                                <p class="card-text"><small class="text-muted">{{ $ij->created_at->diffForHumans() }}</small></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex-grow" style="width:33%;">
                <div class="sheader">
                    {{ __('default.direktori-usaha') }}
                </div>
                <div class="sbody d-flex flex-wrap mt-3">
                    @foreach ($dus as $du)

                        <div class="card mb-3 border-0">
                            <div class="simage">
                            @php
                                preg_match('/(<img[^>]+>)/i', $du->content, $matches);
                                if (isset($matches[0])) {
                                    $img = $matches[0];
                                } else {
                                    $img = null;
                                }
                                if($img) {
                                    echo $img;
                                } else {
                                    // else goes here
                                }
                            @endphp
                            </div>
                            <div class="scontent">
                                <h5 class="card-title"><a href="{{ route('article', ['id' => $du->id]) }}"> {{ $du->title }} </a></h5>
                                <p class="card-text"><small class="text-muted">{{ $du->created_at->diffForHumans() }}</small></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="d-flex">
            <div class="flex-grow" style="width:34%;">
                <div class="sheader">
                    {{ __('default.meseum') }}
                </div>
                <div class="sbody d-flex flex-wrap mt-3">
                    @foreach ($meseums as $meseum)

                        <div class="card mb-3 border-0">
                            <div class="simage">
                            @php
                                preg_match('/(<img[^>]+>)/i', $meseum->content, $matches);
                                if (isset($matches[0])) {
                                    $img = $matches[0];
                                } else {
                                    $img = null;
                                }
                                if($img) {
                                    echo $img;
                                } else {
                                    // else goes here
                                }
                            @endphp
                            </div>
                            <div class="scontent">
                                <h5 class="card-title"><a href="{{ route('article', ['id' => $meseum->id]) }}"> {{ $meseum->title }} </a></h5>
                                <p class="card-text"><small class="text-muted">{{ $meseum->created_at->diffForHumans() }}</small></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex-grow" style="width:33%;">
                <div class="sheader">
                    {{ __('default.sanggar-dan-organisasi') }}
                </div>
                <div class="sbody d-flex flex-wrap mt-3">
                    @foreach ($sdos as $sdo)

                        <div class="card mb-3 border-0">
                            <div class="simage">
                            @php
                                preg_match('/(<img[^>]+>)/i', $sdo->content, $matches);
                                if (isset($matches[0])) {
                                    $img = $matches[0];
                                } else {
                                    $img = null;
                                }
                                if($img) {
                                    echo $img;
                                } else {
                                    // else goes here
                                }
                            @endphp
                            </div>
                            <div class="scontent">
                                <h5 class="card-title"><a href="{{ route('article', ['id' => $sdo->id]) }}"> {{ $sdo->title }} </a></h5>
                                <p class="card-text"><small class="text-muted">{{ $sdo->created_at->diffForHumans() }}</small></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
