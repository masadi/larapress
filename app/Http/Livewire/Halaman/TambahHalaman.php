<?php

namespace App\Http\Livewire\Halaman;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Post;
use App\Models\Category;
use App\Models\Post_category;
use Carbon\Carbon;
use Image;
use Storage;

class TambahHalaman extends Component
{
    use LivewireAlert, WithFileUploads;
    public $title;
    public $content;
    public $cats = [];
    public $kategori;
    public $showDiv = false;
    public $gambar;
    public function getListeners()
    {
        return [
            'gambar'
        ];
    }
    public function render()
    {
        return view('livewire.halaman.tambah-halaman', [
            'categories' => Category::get()
        ]);
    }
    public function tambahKategori()
    {
        $this->showDiv =! $this->showDiv;
    }
    public function store(){
        $post = Post::create([
            'user_id' => auth()->user()->id,
            'title' => $this->title,
            'content' => $this->content,
            'type' => 'page',
        ]);
        if($this->gambar){
            $post->addImage($this->gambar);
        }
        if($this->kategori){
            $categori = Category::updateOrCreate(
                ['name' => $this->kategori]
            );
            Post_category::create([
                'category_id' => $categori->id,
                'post_id' => $post->id
            ]);
        }
        foreach($this->cats as $cats){
            Post_category::create([
                'category_id' => $cats,
                'post_id' => $post->id
            ]);
        }
        $this->flash('success', 'Halaman berhasil disimpan', [], '/halaman');
    }
    public function gambar($file){
        if(!Storage::exists('public/images')) {
			Storage::makeDirectory('public/images', 0775, true); //creates directory
		}
        $file = file_get_contents($file);
        $extension = $this->getImageMimeType($file);
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $extension;
		//UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
		Image::make($file)->save($this->image_path() . '/' . $fileName);
        foreach ($this->image_dimension() as $row) {
            if(!Storage::exists('public/images/'.$row)) {
                Storage::makeDirectory('public/images/'.$row, 0775, true); //creates directory
            }
            $canvas = Image::canvas($row, $row);
            $resizeImage  = Image::make($file)->resize($row, $row, function($constraint) {
                $constraint->aspectRatio();
            });
            //MEMASUKAN IMAGE YANG TELAH DIRESIZE KE DALAM CANVAS
			$canvas->insert($resizeImage, 'center');
			//SIMPAN IMAGE KE DALAM MASING-MASING FOLDER (DIMENSI)
			$canvas->save($this->image_path() . '/' . $row . '/' . $fileName);
        }
        $this->emit('image_url', ['data' => asset('storage/images/'.$fileName)]);
    }
    public function image_path(){
        return storage_path('app/public/images');
    }
    public function image_dimension(){
        return ['245', '300', '500'];
    }
    public function getBytesFromHexString($hexdata)
    {
      for($count = 0; $count < strlen($hexdata); $count+=2)
        $bytes[] = chr(hexdec(substr($hexdata, $count, 2)));
    
      return implode($bytes);
    }
    
    public function getImageMimeType($imagedata)
    {
      $imagemimetypes = array( 
        "jpeg" => "FFD8", 
        "png" => "89504E470D0A1A0A", 
        "gif" => "474946",
        "bmp" => "424D", 
        "tiff" => "4949",
        "tiff" => "4D4D"
      );
    
      foreach ($imagemimetypes as $mime => $hexbytes)
      {
        $bytes = $this->getBytesFromHexString($hexbytes);
        if (substr($imagedata, 0, strlen($bytes)) == $bytes)
          return $mime;
      }
    
      return NULL;
    }

}
