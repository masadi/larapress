<div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" data-bs-backdrop="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Detil {{($pengguna) ? $pengguna->name : ''}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($pengguna)
                <table class="table table-bordered">
                    <tr>
                        <td>Nama</td>
                        <td>{{$pengguna->name}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{$pengguna->email}}</td>
                    </tr>
                    <tr>
                        <td>Terakhir Login</td>
                        <td>{{$pengguna->login_terakhir}}</td>
                    </tr>
                </table>
                <h4>Hak Akses yang Dimiliki</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tahun Pelajaran</th>
                            <th>Hak Akses</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i=0; $i<count ($pengguna->rolesTeams) ; $i++)
                        <tr>
                            <td> {{ $pengguna->rolesTeams[$i]->display_name }}</td>
                            <td> {{ $pengguna->roles[$i]->display_name }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-danger" title="Hapus Akses" wire:click="hapusAkses('{{$pengguna->user_id}}', {{$pengguna->roles[$i]->id}})">
                                    <i class=" fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
                <h4>Tambah Hak Akses di Tahun Pelajaran {{session('tahun-ajaran')}}</h4>
                @foreach ($roles as $item)
                <div class="form-check mb-1">
                    <input class="form-check-input" type="checkbox" wire:model.lazy="akses.{{$item->id}}" id="{{$item->name}}" value="{{$item->id}}">
                    <label class="form-check-label" for="{{$item->name}}">
                        {{$item->display_name}}
                    </label>
                </div>
                @endforeach
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" wire:click.prevent="update()">Simpan</button>
            </div>
        </div>
    </div>
</div>