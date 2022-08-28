@forelse ($comments as $comment)
<div id="comment-reply-1" class="comment comment-reply">
    <div class="d-flex">
        <div class="comment-img"><img src="{{ ($comment->user) ? $comment->user->profile_photo_url : 'https://www.gravatar.com/avatar/'.md5($comment->author_email) }}" alt=""></div>
        <div>
          <h5><a href="{{$comment->author_url}}" target="_blank">{{ $comment->author }}</a> <a href="#form-komentar" wire:click="getID({{$comment->id}})" class="reply"><i class="bi bi-reply-fill"></i> Balas</a></h5>
          <time datetime="{{$comment->created_at->format('Y-m-d')}}">{{$comment->created_at->translatedFormat('d F Y')}} @if(!$comment->approved) <span class="text-danger"><i>Komentar menunggu persetujuan Admin</i></span> @endif</time>
          {!! $comment->content !!}
        </div>
    </div>
    @include('livewire.artikel.balasan', ['comments' => $comment->comments])
</div><!-- End comment reply #{{$loop->iteration}} -->
@endforeach