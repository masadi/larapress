<div wire:ignore.self class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="pembelajaranModal" tabindex="-1" aria-labelledby="pembelajaranModalLabel" aria-hidden="true" data-bs-backdrop="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pembelajaranModalLabel">Pembelajaran di Rombel {{$kelas}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Mata Pelajaran</th>
                            <th class="text-center">Guru Mata Pelajaran</th>
                            <th class="text-center">Kelompok Mapel</th>
                            <th class="text-center">Nomor Urut</th>
                            <th class="text-center">KKM</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data_pembelajaran as $pembelajaran)
                        <tr>
                            <td>{{$pembelajaran->nama_mata_pelajaran}}</td>
                            <td>{{$pembelajaran->ptk->nama}}</td>
                            <td>{{$pembelajaran->kelompok_id}}</td>
                            <td>{{$pembelajaran->no_urut}}</td>
                            <td>{{$pembelajaran->kkm}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="5">Tidak ada data untuk ditampilkan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" wire:click.prevent="store()">Simpan</button>
            </div>
        </div>
    </div>
</div>