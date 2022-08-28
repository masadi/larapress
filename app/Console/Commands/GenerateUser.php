<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use App\Models\Team;
use App\Models\Semester;
use App\Models\Tahun_ajaran;

class GenerateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:user';

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
        for($start = 2010;$start <= 2022; $start++){
            $this->info('Tahun Ajaran '.$start.' selesai dibuat');
            $tahun_ajaran = Tahun_ajaran::updateOrCreate(
                [
                    'tahun_ajaran_id' => $start,
                ],
                [
                    'nama' => $start.'/'.($start + 1),
                    'periode_aktif' => ($start == 2022) ? 1 : 0,
                ]
            );
            $u=1;
            for($i=$u;$i<=2;$i++){
                $this->info('Semester '.$start.$i.' selesai dibuat');
                $periode = ($i == 1) ? 'Ganjil' : 'Genap';
                $semester = Semester::updateOrCreate(
                    [
                        'semester_id' => $start.$i,
                    ],
                    [
                        'tahun_ajaran_id' => $start,
                        'nama' => $start.'/'.($start + 1) .' '.$periode,
                        'semester' => $i,
                        'periode_aktif' => ($start == 2022 && $i == 1) ? 1 : 0,
                    ]
                );
            }
            Team::updateOrCreate(
                [
                'name' => 'tahun-ajaran-'.$start,
                ],
                [
                    'display_name' => $tahun_ajaran->nama,
                    'description' => $tahun_ajaran->nama,
                ]
            );
        }
        $user = User::updateOrCreate(
            [
                'name' => 'Administrator',
                'email' => 'admin@darulkaromah.sch.id',
            ],
            [
                'password' => bcrypt('12345678'),
            ]
        );
        $role = Role::where('name', 'administrator')->first();
        $teams = Team::all();
        foreach($teams as $team){
            $user->attachRole($role, $team);
        }
    }
}
