<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaterkitController extends Controller
{
    // home
    public function dashboard()
    {
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"]
        ];
        return view('content.dashboard', ['breadcrumbs' => $breadcrumbs]);
    }
    public function artikel(Request $request)
    {
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => "Semua Artikel"]
        ];
        $title = "Semua Artikel";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.artikel.artikel', ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => 'artikel.semua-artikel']);
    }
    public function tambah_artikel(Request $request)
    {
        $title = "Tambah Artikel";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.artikel.tambah-artikel', ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => 'artikel.tambah-artikel']);
    }
    public function komentar(Request $request)
    {
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => "Semua Komentar"]
        ];
        $title = "Semua Komentar";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.artikel.komentar', ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => 'artikel.komentar']);
    }
    public function halaman(Request $request)
    {
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => "Semua Halaman"]
        ];
        $title = "Semua Halaman";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.halaman.halaman', ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => 'halaman.semua-halaman']);
    }
    public function tambah_halaman(Request $request)
    {
        $title = "Tambah Halaman";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.halaman.tambah-halaman', ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => 'halaman.tambah-halaman']);
    }
    public function referensi(Request $request){
        $function = str_replace('-', '_', $request->route('laman'));
        $function = 'ref_'.$function;
        if(method_exists($this, $function)){
            return $this->{$function}($request->route()->getName(), $request->route('laman'));
        } else {
            abort(403, 'method '.$function. ' tidak ditemukan');
        }
    }
    public function administrasi(Request $request){
        $function = str_replace('-', '_', $request->route('laman'));
        $function = 'adm_'.$function;
        if(method_exists($this, $function)){
            return $this->{$function}($request->route()->getName(), $request->route('laman'));
        } else {
            abort(403, 'method '.$function. ' tidak ditemukan');
        }
    }
    public function administrasi_add(Request $request){
        $function = str_replace('-', '_', $request->route('laman'));
        $function = 'adm_add_'.$function;
        if(method_exists($this, $function)){
            return $this->{$function}($request->route()->getName(), $request->route('laman'));
        } else {
            abort(403, 'method '.$function. ' tidak ditemukan');
        }
    }
    public function keuangan(Request $request){
        $function = str_replace('-', '_', $request->route('laman'));
        $function = 'keu_'.$function;
        if(method_exists($this, $function)){
            return $this->{$function}($request->route()->getName(), $request->route('laman'));
        } else {
            abort(403, 'method '.$function. ' tidak ditemukan');
        }
    }
    public function kinerja_guru(Request $request){
        $function = str_replace('-', '_', $request->route('laman'));
        $function = 'kg_'.$function;
        if(method_exists($this, $function)){
            return $this->{$function}($request->route()->getName(), $request->route('laman'));
        } else {
            abort(403, 'method '.$function. ' tidak ditemukan');
        }
    }
    public function ref_yayasan($folder, $laman){
        $title = "Data Yayasan";
        $laman = 'data-yayasan';
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function ref_tahun_ajaran($folder, $laman){
        $title = "Referensi Tahun Ajaran";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function ref_semester($folder, $laman){
        $title = "Referensi Semester";
        $laman = 'data-semester';
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function ref_mata_pelajaran($folder, $laman){
        $title = "Referensi Mata Pelajaran";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function ref_sekolah($folder, $laman){
        $title = "Data Sekolah";
        $laman = 'data-sekolah';
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman, 'tombol_add' => 1]);
    }
    public function ref_tenaga_pendidik($folder, $laman){
        $title = "Data Pendidik & Tendik";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function ref_peserta_didik($folder, $laman){
        $title = "Data Peserta Didik";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function ref_rombongan_belajar($folder, $laman){
        $title = "Data Rombongan Belajar";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function ref_jadwal_mengajar($folder, $laman){
        $title = "Data Jadwal Mengajar";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function ref_ekstrakurikuler($folder, $laman){
        $title = "Data Ekstrakurikuler";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function ref_kegiatan($folder, $laman){
        $title = "Data Kegiatan";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function adm_surat_keluar($folder, $laman){
        $title = "Data Surat Keluar";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman, 'tombol_add' => [
            'link' => route('administrasi.add', ['laman' => $laman])]
        ]);
    }
    public function adm_add_surat_keluar($folder, $laman){
        $title = "Tambah Surat Keluar";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function adm_surat_masuk($folder, $laman){
        $title = "Data Surat Masuk";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function adm_surat_keputusan($folder, $laman){
        $title = "Data Surat Keputusan";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function adm_buku_induk($folder, $laman){
        $title = "Data Buku Induk";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function keu_tabungan($folder, $laman){
        $title = "Data Tabungan";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function keu_iuran_kegiatan($folder, $laman){
        $title = "Data Iuran Kegiatan";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function keu_dana_amal($folder, $laman){
        $title = "Dana Amal";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function kg_jurnal_mengajar($folder, $laman){
        $title = "Data Tabungan";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function kg_absensi_siswa($folder, $laman){
        $title = "Data Absensi Siswa";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function kg_rencana_penilaian($folder, $laman){
        $title = "Data Rencana Penilaian";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function kg_penilaian($folder, $laman){
        $title = "Data Penilaian";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function kg_rekap_nilai($folder, $laman){
        $title = "Rekapitulasi Nilai";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function kg_cetak_rapor($folder, $laman){
        $title = "Data Cetak Rapor";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.'.$folder.'.'.$laman, ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => $folder.'.'.$laman]);
    }
    public function users(Request $request){
        $title = "Data Pengguna";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.users', ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'tombol_add' => 1]);
    }
}
