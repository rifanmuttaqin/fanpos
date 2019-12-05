<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class TokoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_toko')->insert([
            'nama_toko' 	=> 'FanPos',
            'npwp' 			=> '',
            'alamat_toko' 	=> 'Alamat Toko',
            'nomor_telfon' 	=> 'Nomor Telfon',
            'email' 		=> 'Example@Example.com',
            'fax' 			=> '',
            'website' 		=> '',
            'kode_pos' 		=> '',
            'logo_url' 		=> ''
        ]);
    }
}
