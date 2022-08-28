<?php

namespace App\Http\Livewire\Artikel;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
Use App\Models\Comment;

class PostComments extends Component
{
    use LivewireAlert;
    public $post;
    public $user_id;
    public $author;
    public $author_email;
    public $author_url;
    public $author_ip;
    public $content;
    public $comments;
    public $parent;

    protected $rules = [
        'author' => 'required',
        'author_email' => 'required|email',
        'author_url' => 'nullable|url',
        'content' => 'required'
    ];

    protected $messages = [
        'author.required' => 'Nama tidak boleh kosong',
        'author_email.required' => 'Email tidak boleh kosong.',
        'author_email.email' => 'Email tidak valid.',
        'content.required' => 'Komentar tidak boleh kosong.',
        'author_url.url' => 'URL tidak valid',
    ];

    public function render()
    {
        if(auth()->user()){
            $this->user_id = auth()->user()->id;
            $this->author = auth()->user()->name;
            $this->author_email = auth()->user()->email;
            $this->author_url = auth()->user()->url;
        }
        return view('livewire.artikel.post-comments');
    }
    public function mount(){
        $this->comments = $this->post->comments()->where(function($query){
            $query->where('approved', 1);
            if(auth()->user()){
                $query->orWhere('user_id', auth()->user()->id);
                $query->whereNull('parent');
            }
        })->get();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function store(){
        $this->validate();
        $a = Comment::create([
            'user_id' => $this->user_id,
            'post_id' => $this->post->id,
            'author' => $this->author,
            'author_email' => $this->author_email,
            'author_url' => $this->author_url,
            'author_ip' => $this->author_ip,
            'content' => $this->content,
            'parent' => $this->parent,
        ]);
        $this->reset(['user_id', 'author', 'author_email', 'author_url', 'content']);
        $this->flash('success', 'Komentar berhasil ditambahkan', [], '/post/'.$this->post->slug);
    }
    public function getID($id){
        $this->parent = $id;
    }
}
