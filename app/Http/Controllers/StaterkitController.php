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
    public function nomor_whatsapp(Request $request)
    {
        $title = "Nomor Whatsapp";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.general', ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => 'whatsapp.semua-nomor']);
    }
    public function pesan_masuk(Request $request)
    {
        $title = "Pesan Masuk";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.general', ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => 'whatsapp.pesan-masuk']);
    }
    public function campaign_message()
    {
        $title = "Campaign";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.general', ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => 'whatsapp.campaign']);
    }
    public function auto_reply()
    {
        $title = "Auto Reply";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.general', ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'laman' => 'whatsapp.auto-reply']);
    }
    public function users(Request $request){
        $title = "Data Pengguna";
        $breadcrumbs = [
            ['link' => "home", 'name' => "Beranda"], ['name' => $title]
        ];
        return view('content.users', ['breadcrumbs' => $breadcrumbs, 'title' => $title, 'tombol_add' => 1]);
    }
}
