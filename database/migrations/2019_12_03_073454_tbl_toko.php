<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblToko extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_toko', function (Blueprint $table) {
            $table->bigIncrements('id', 20);
            $table->string('nama_toko');
            $table->string('npwp')->nullable();
            $table->string('alamat_toko');
            $table->string('nomor_telfon');
            $table->string('email');
            $table->string('fax')->nullable();
            $table->string('website')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('logo_url')->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_toko');
    }
}
