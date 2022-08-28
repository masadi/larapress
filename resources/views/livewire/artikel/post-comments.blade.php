<div>
    <div class="blog-comments">
        <h4 class="comments-count">{{$comments->count()}} Komentar</h4>
        @forelse ($comments as $comment)
        <div id="comment-{{$loop->iteration}}" class="comment">
            <div class="d-flex">
              <div class="comment-img"><img src="{{ ($comment->user) ? $comment->user->profile_photo_url : 'https://www.gravatar.com/avatar/'.md5($comment->author_email) }}" alt=""></div>
              <div>
                <h5><a href="{{$comment->author_url}}" target="_blank">{{ $comment->author }}</a> <a href="#form-komentar" wire:click="getID({{$comment->id}})" class="reply"><i class="bi bi-reply-fill"></i> Balas</a></h5>
                <time datetime="{{$comment->created_at->format('Y-m-d')}}">{{$comment->created_at->translatedFormat('d F Y')}} @if(!$comment->approved) <span class="text-danger"><i>Komentar menunggu persetujuan Admin</i></span> @endif</time>
                {!! $comment->content !!}
              </div>
            </div>
            @include('livewire.artikel.balasan', ['comments' => $comment->comments])
        </div><!-- End comment #{{$loop->iteration}} -->
        @empty
        <div class="comment">
            <p>Belum ada komentar. Jadilah komentator pertama!</p>
        </div>
        @endforelse
        <div class="reply-form" id="form-komentar">
            <h4>Tinggalkan komentar</h4>
            <p>Berkomentarlah dengan bijak! <br>Tanda <span>*</span> wajib diisi</p>
            <form wire:ignore.self wire:submit.prevent="store">
                <input type="hidden" wire:model="parent">
                <input type="hidden" wire:model="user_id">
                @if(!auth()->user())
                <div class="row mb-2">
                    <div class="col-md-6 form-group">
                        <input type="text" class="form-control" placeholder="Nama*" wire:model="author">
                        @error('author') <span class="alert alert-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <input type="email" class="form-control" placeholder="Email*" wire:model="author_email">
                        @error('author_email') <span class="alert alert-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col form-group">
                    <input type="text" class="form-control" placeholder="Website" wire:model="author_url">
                    @error('author_url') <span class="alert alert-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                @endif
                <div class="row mb-2">
                    <div class="col form-group">
                    <textarea class="form-control" placeholder="Komentar*" wire:model="content"></textarea>
                    @error('content') <span class="alert alert-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Komentar</button>
            </form>
        </div>
    </div>
</div>
