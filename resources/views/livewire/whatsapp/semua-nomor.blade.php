<div>
    <div class="card">
        <div class="card-body">
            @include('components.navigasi-table')
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Judul</th>
                        <th class="text-center">Penulis</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">Tag</th>
                        <th class="text-center"><i class="fa-solid fa-message"></i></th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($collection->count())
                        @foreach($collection as $item)
                        <tr>
                            <td class="align-top"><a href="{{route('baca_artikel', ['slug' => $item->slug])}}" target="_blank" title="Lihat artikel">{{$item->title}}</a></td>
                            <td class="align-top">{{$item->user->name}}</td>
                            <td class="align-top">{{$item->category->pluck('name')->implode(', ')}}</td>
                            <td class="align-top">{{$item->tag->pluck('name')->implode(', ')}}</td>
                            <td class="text-center align-top">{{$item->comments_count}}</td>
                            <td class="text-center align-top">
                                <div class="btn-group dropstart">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Aksi
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="btnGroupDrop1">
                                        <li><a class="dropdown-item" wire:click="getID('{{$item->id}}')" title="Lihat Detil"><i class="fas fa-eye"></i> Detil</a></li>
                                        <li><a class="dropdown-item" wire:click="getID('{{$item->id}}')" title="Edit Data"><i class="fas fa-pencil"></i> Edit</a></li>
                                        <li><a class="dropdown-item" wire:click="getID('{{$item->id}}')" title="Hapus Data"><i class="fas fa-trash"></i> Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td class="text-center" colspan="7">Tidak ada data untuk ditampilkan</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="row justify-content-between mt-2">
                <div class="col-6">
                    @if($collection->count())
                    <p>Menampilkan {{ $collection->firstItem() }} sampai {{ $collection->firstItem() + $collection->count() - 1 }} dari {{ $collection->total() }} data</p>
                    @endif
                </div>
                <div class="col-6">
                    {{ $collection->onEachSide(1)->links('components.custom-pagination-links-view') }}
                </div>
            </div>
        </div>
    </div>
    @include('components.loader')
</div>
