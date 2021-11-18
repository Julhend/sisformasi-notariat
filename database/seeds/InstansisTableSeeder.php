<?php

use Illuminate\Database\Seeder;

class InstansisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $instansi = \App\Instansi::create([
            'nama' => 'instansi',
            'alamat' => 'Tanjungpinang',
            'pimpinan' => 'default',
            'email' => 'default@gmail.com',
            'file' => 'uploads/logo/download.png'
           ]);
    }
}
