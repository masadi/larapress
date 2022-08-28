@extends('layouts/frontLayoutMaster')

@section('title', $title)
@section('breadcrumbs')
<section class="breadcrumbs">
    <div class="container">
      <ol>
        <li><a href="{{url('/')}}">Beranda</a></li>
        <li>{{$title}}</li>
      </ol>
      <h2>{{$title}}</h2>
    </div>
</section><!-- End Breadcrumbs -->
@endsection
@section('content')
@forelse ($posts as $post)
<article class="entry">
  <div class="entry-img">
    <img src="{{first_image($post)}}" alt="{{$post->title}}" class="img-fluid mx-auto d-block">
  </div>
  <h2 class="entry-title">
      <a href="{{$post->slug}}">{{$post->title}}</a>
  </h2>
  <div class="entry-meta">
      <ul>
      <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="{{$post->slug}}">{{$post->user->name}}</a></li>
      <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{$post->slug}}"><time datetime="{{$post->created_at->format('Y-m-d')}}">{{$post->created_at->translatedFormat('d F Y')}}</time></a></li>
      <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="{{$post->slug}}">{{$post->comments->count()}} Komentar</a></li>
      </ul>
  </div>
  <div class="entry-content">
    <p>{{Str::limit(strip_tags($post->content), 100)}}</p>
    <div class="read-more">
      <a href="{{route('baca_artikel', ['slug' => $post->slug])}}">Selengkapnya &raquo;</a>
    </div>
  </div>
</article>
@empty
<article class="entry">
  <h1>Pencarian {{$cari}} tidak ditemukan</h1>
</article>
@endforelse
<div class="blog-pagination d-flex justify-content-center">
  {!! $posts->links() !!}
</div>
@endsection
