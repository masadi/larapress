<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class FrontController extends Controller
{
    public function index(){
        return view('content.home', [
            'title' => 'Halaman Utama',
            'posts' => Post::orderBy('created_at', 'DESC')->where('type', 'post')->take(3)->get(),
        ]);
    }
    public function cari(Request $request){
        $cari = ucwords($request->s);
        $title = 'Hasil pencarian '. $cari;
        return view('content.artikel.search', [
            'title' => $title,
            'posts' => Post::orderBy('created_at', 'DESC')->where('type', 'post')->where('title', 'LIKE', '%'.$request->s.'%')->paginate(2),
            'cari' => ucwords($request->s),
        ]);
    }
    public function post_kategori(Request $request){
        $kategori = Category::where('slug', $request->route('slug'))->first();
        $title = 'Semua artikel dibawah kategori '. $kategori->name;
        return view('content.artikel.post-kategori', [
            'title' => $title,
            'posts' => Post::orderBy('created_at', 'DESC')->where('type', 'post')->whereHas('category', function($query){
                $query->where('slug', request()->route('slug'));
            })->paginate(2),
        ]);
    }
    public function post_tag(Request $request){
        $kategori = Tag::where('slug', $request->route('slug'))->first();
        $title = 'Semua artikel dibawah kategori '. $kategori->name;
        return view('content.artikel.post-kategori', [
            'title' => $title,
            'posts' => Post::orderBy('created_at', 'DESC')->where('type', 'post')->whereHas('tag', function($query){
                $query->where('slug', request()->route('slug'));
            })->paginate(2),
        ]);
    }
    public function page(Request $request){
        $title = $request->route('page');
        $title = str_replace('-', ' ', $title);
        $title = ucwords($title);
        $title = str_replace('Paud', 'PAUD', $title);
        $title = str_replace('Sd', 'SD', $title);
        $title = str_replace('Smp', 'SMP', $title);
        $title = str_replace('Sma', 'SMA', $title);
        $title = str_replace('Mdta', 'MDTA', $title);
        $post = Post::where('slug', $request->route('page'))->first();
        return view('content.page', [
            'title' => $title,
            'post' => $post
        ]);
    }
    public function artikel(Request $request){
        $post = Post::where('slug', $request->route('slug'))->first();
        return view('content.artikel.baca', [
            'post' => $post
        ]);
    }
}
