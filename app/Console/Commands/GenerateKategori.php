<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;

class GenerateKategori extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:kategori';

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
        $cats = ['Yayasan', 'PAUD', 'SD Islam', 'SMP Islam', 'SMA Islam', 'Raudhlatul Athfal', 'MDTA Awwaliyah', 'MDTA Wustha', 'MDTA Ulya', 'Pondok Pesantren'];
        foreach($cats as $cat){
            Category::updateOrCreate([
                'name' => $cat,
            ]);
        }
    }
}
