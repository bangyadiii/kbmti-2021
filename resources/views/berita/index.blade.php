@extends('layouts.app')

@section('title', 'Berita')

@section('content')
<section class="berita__top">
    @if ($tag)
        @include('layouts.heading', ['text' => "Berita tagged #$tag"])
    @else
        @include('layouts.heading', ['text' => 'Berita'])
    @endif
    <div class="berita__break"></div>
    @include('layouts.search', ['name' => 'searchBerita', 'text' => 'Cari Berita...'])
</section>
<section class="berita__content">

    <section class="berita__content">
        <div class="container">
            <div class="row">
                @foreach($articles as $article)
                    @include('layouts.news', [
                        'bureau' => $article->bureau,
                        'date' => DateTime::createFromFormat('Y-m-d', explode(" ", $article->updated_at)[0])->format('l, d F Y'),
                        'title' => $article->name,
                        'url' => url(env("ASSET_URL", "") . "/berita/show/$article->id"),
                        'url' => route('guest.berita.show', [ 'beritum' => $article->id ])
                    ])
                @endforeach
            {{-- @if (empty($tag))
            @else
                @foreach($articles as $article)
                    @if ($article->tag_id == $tagId)
                        @include('layouts.news', [
                            'bureau' => $article->bureau,
                            'date' => DateTime::createFromFormat('Y-m-d', explode(" ", $article->updated_at)[0])->format('l, d F Y'),
                            'title' => $article->name,
                            'url' => url(env("ASSET_URL", "") . "/berita/show/$article->id")
                        ])
                    @endif
                @endforeach
            @endif --}}

            </div>
        </div>
    </section>

</section>
<section class="berita__paginator">
    <hr class="berita__hr">
    {{-- @if (empty($tag)) --}}
        {{ $links }}
    {{-- @endif --}}
</section>
@endsection

@section('custom-script')
<script>
    $(function() {
        $('.berita__card').hover(function() {
            $('.berita__card-overlay').fadeIn(500);
        }, function() {
            $('.berita__card-overlay').fadeOut(0);
        });
    });
</script>
@endsection
