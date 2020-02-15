<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            
            $table->bigIncrements('id', 20);
            $table->string('nama_product');
            $table->string('sku')->nullable();
            $table->integer('berat')->nullable();
            $table->double('volume')->nullable();
            $table->tinyInteger('has_varian');
            $table->tinyInteger('has_grosir');
            $table->date('exp')->nullable();
            $table->string('merek')->nullable();
            $table->longText('deskripsi')->nullable();

            // Foreign key 
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->unsignedBigInteger('satuan_id')->nullable();

            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('satuan_id')
                ->references('id')
                ->on('tbl_satuan')
                ->onDelete('set null');

            $table->foreign('kategori_id')
                ->references('id')
                ->on('tbl_kategori')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_product');
    }
}
