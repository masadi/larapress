<div class="sidebar">

  <h3 class="sidebar-title">Cari Informasi</h3>
  <div class="sidebar-item search-form">
    <form action="{{route('cari')}}">
      <input type="text" name="s">
      <button type="submit"><i class="bi bi-search"></i></button>
    </form>
  </div><!-- End sidebar search formn-->

  <h3 class="sidebar-title">Kategori</h3>
  <div class="sidebar-item categories">
    <ul>
      @foreach (categories() as $category)
      <li><a href="{{route('kategori', ['slug' => $category->slug])}}">{{$category->name}} <span>({{$category->posts_count}})</span></a></li>
      @endforeach
    </ul>
  </div><!-- End sidebar categories-->

  <h3 class="sidebar-title">Artikel Terbaru</h3>
  <div class="sidebar-item recent-posts">
    @forelse (recent_post() as $post)
    <div class="post-item clearfix">
      <img src="{{first_image($post)}}" alt="">
      <h4><a href="{{route('baca_artikel', ['slug' => $post->slug])}}">{{$post->title}}</a></h4>
      <time datetime="{{$post->created_at->format('Y-m-d')}}">{{$post->created_at->translatedFormat('d F Y')}}</time>
    </div>
    @empty
    <div class="post-item clearfix">
      Tidak ada artikel untuk ditampilkan
    </div>
    @endforelse
  </div><!-- End sidebar recent posts-->

  <h3 class="sidebar-title">Tags</h3>
  <div class="sidebar-item tags">
    <ul>
      @foreach (tags() as $tag)
      <li><a href="{{route('tag', ['slug' => $tag->slug])}}">{{$tag->name}}</a></li>
      @endforeach
    </ul>
  </div><!-- End sidebar tags-->

</div><!-- End sidebar -->