<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('fasilitas')->insert([
            'kode_fasilitas' => 'AC',
            'nama_fasilitas' => 'Air Conditioner',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('fasilitas')->insert([
            'kode_fasilitas' => 'Kursi',
            'nama_fasilitas' => 'Kusrsi Kayu',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('fasilitas')->insert([
            'kode_fasilitas' => 'Kursi LP',
            'nama_fasilitas' => 'Kusrsi Lipat',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
