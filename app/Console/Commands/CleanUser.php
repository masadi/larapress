<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Semester;

class CleanUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::whereRoleIs(['ptk', 'pd'], 'tahun-ajaran-'.$this->getSemester()->tahun_ajaran_id)->whereNull('ptk_id')->whereNull('peserta_didik_id')->delete();
        dd($user);
    }
    private function getSemester(){
        $semester = Semester::where('periode_aktif', 1)->first();
        return $semester;
    }
}
