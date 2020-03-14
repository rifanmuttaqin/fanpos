<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblDiskonProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_diskon_product', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->unsignedBigInteger('diskon_id');
            $table->unsignedBigInteger('variant_detail_id');

            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('variant_detail_id')
            ->references('id')
            ->on('tbl_variant_detail')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('diskon_id')
            ->references('id')
            ->on('tbl_diskon')
            ->onUpdate('cascade')
            ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_diskon_product');
    }
}
