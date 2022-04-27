<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriRuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori_ruangan')->insert([
            'kode_kategori' => 'KLS',
            'nama_kategori' => 'Kelas',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('kategori_ruangan')->insert([
            'kode_kategori' => 'KTR',
            'nama_kategori' => 'Kantor',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('kategori_ruangan')->insert([
            'kode_kategori' => 'LAB',
            'nama_kategori' => 'Laboratorium',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
