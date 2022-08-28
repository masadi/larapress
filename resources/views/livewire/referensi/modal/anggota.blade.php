<div wire:ignore.self class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="anggotaModal" tabindex="-1" aria-labelledby="anggotaModalLabel" aria-hidden="true" data-bs-backdrop="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="anggotaModalLabel">Anggota Rombel {{$kelas}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">no</th>
                            <th>Nama</th>
                            <th class="text-center">NISN</th>
                            <th>Tempat, Tanggal Lahir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($anggota_rombel as $anggota)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td>{{$anggota->nama}}</td>
                            <td class="text-center">{{$anggota->nisn}}</td>
                            <td>{{$anggota->tetala}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="4">Tidak ada data untuk ditampilkan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>