<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HakMilikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('hak_milik')->insert([
            'kode_hak' => 'FISKOM',
            'nama_hak' => 'Fakultas Sains dan Komputer',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('hak_milik')->insert([
            'kode_hak' => 'FAK',
            'nama_hak' => 'Fakultas Agama Kristen',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('hak_milik')->insert([
            'kode_hak' => 'FEBI',
            'nama_hak' => 'Fakultas Ekonomi dan Bisnis',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
