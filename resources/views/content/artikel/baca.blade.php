@extends('layouts/frontLayoutMaster')

@section('title', $post->title)
@section('breadcrumbs')
<section class="breadcrumbs">
    <div class="container">
      <ol>
        <li><a href="{{url('/')}}">Beranda</a></li>
        @if($post->category->count())
        {{$post->category->pluck('name')->implode('</li><li>')}}
        @endif
      </ol>
      <h2>{{$post->title}}</h2>
    </div>
</section><!-- End Breadcrumbs -->
@endsection
@section('entry-meta')
    <div class="entry-img">
        <img src="{{first_image($post)}}" alt="{{$post->title}}" class="img-fluid">
    </div>
    <h2 class="entry-title">
        <a href="{{route('baca_artikel', ['slug' => $post->slug])}}">{{$post->title}}</a>
    </h2>
    <div class="entry-meta">
        <ul>
        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="{{route('baca_artikel', ['slug' => $post->slug])}}">{{$post->user->name}}</a></li>
        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{route('baca_artikel', ['slug' => $post->slug])}}"><time datetime="{{$post->created_at->format('Y-m-d')}}">{{$post->created_at->translatedFormat('d F Y')}}</time></a></li>
        <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="{{route('baca_artikel', ['slug' => $post->slug])}}">{{$post->comments->count()}} Komentar</a></li>
        </ul>
    </div>
@endsection
@section('content')
{{first_image($post)}}
{!! $post->content !!}
@endsection
@section('entry-footer')
<div class="entry-footer">
    @if($post->category->count())
    <i class="bi bi-folder"></i>
    <ul class="cats">
        @foreach ($post->category as $category)
        <li><a href="{{$category->slug}}">{{$category->name}}</a></li>
        @endforeach
    </ul>
    @endif
    @if($post->tag->count())
    <i class="bi bi-tags"></i>
    <ul class="tags">
        @foreach ($post->tag as $tag)
        <li><a href="{{$tag->slug}}">{{$tag->name}}</a></li>
        @endforeach
    </ul>
    @endif
</div>
@endsection
@section('blog-author')
    <div class="blog-author d-flex align-items-center">
        <img src="{{ $post->user->profile_photo_url }}" class="rounded-circle float-left" alt="{{$post->user->name}}">
        <div>
        <h4>{{$post->user->name}}</h4>
        <div class="social-links">
            <a href="https://twitters.com/#"><i class="bi bi-twitter"></i></a>
            <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
            <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
        </div>
        <p>{{$post->user->bio}}</p>
        </div>
  </div><!-- End blog author bio -->
@endsection
@section('comments')
@livewire('artikel.post-comments', ['post' => $post], key($post->id))
@endsection
