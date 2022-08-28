<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Http\Request;

class LoginSuccessful
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        /*if($this->request->semester){
            $semester = Semester::with(['tahun_ajaran'])->find($this->request->semester);
        } else {
            $semester = Semester::with(['tahun_ajaran'])->where('periode_aktif', 1)->first();
        }
        $this->request->session()->put('semester_id', $semester->semester_id);
        $this->request->session()->put('semester', $semester->nama);
        $this->request->session()->put('tahun_ajaran_id', $semester->tahun_ajaran->tahun_ajaran_id);
        $this->request->session()->put('tahun_ajaran', $semester->tahun_ajaran->nama);
        $this->request->session()->put('tahun-ajaran', 'tahun-ajaran-'.$semester->tahun_ajaran_id);*/
        $this->request->session()->put('theme', 'light');
    }
}
