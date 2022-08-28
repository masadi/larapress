<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wilayah;
use File;

class WilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = ['mst_wilayah_1', 'mst_wilayah_2', 'mst_wilayah_3', 'mst_wilayah_4'];
        foreach($files as $file){
            $json = File::get('database/data/'.$file.'.json');
            $data = json_decode($json);
            foreach($data as $obj){
                $mst_kode_wilayah = trim($obj->mst_kode_wilayah);
                Wilayah::updateOrCreate(
                    [
                        'kode_wilayah' => $obj->kode_wilayah,
                    ],
                    [
                        'nama' => $obj->nama,
                        'id_level_wilayah' => $obj->id_level_wilayah,
                        'mst_kode_wilayah' => ($mst_kode_wilayah != '000000') ? $obj->mst_kode_wilayah : NULL,
                    ]
                );
            }
        }
    }
}
