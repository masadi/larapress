<h2 class="entry-title">
  <a href="{{route('page', ['page' => $post->slug])}}">{{$post->title}}</a>
</h2>

<div class="entry-meta">
  <ul>
    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="{{route('page', ['page' => $post->slug])}}">{{$post->user->name}}</a></li>
    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{route('page', ['page' => $post->slug])}}"><time datetime="{{$post->created_at->format('Y-m-d')}}">{{$post->created_at->translatedFormat('d F Y')}}</time></a></li>
  </ul>
</div> 