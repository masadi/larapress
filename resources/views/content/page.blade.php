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
@if($post)
{!! $post->content !!}
@else
<p>Belum ada informasi yang dapat ditampilkan</p>
@endif
@endsection
@section('entry-meta')
@if($post)
@include('panels/entry-meta', ['post' => $post])
@endif
@endsection
