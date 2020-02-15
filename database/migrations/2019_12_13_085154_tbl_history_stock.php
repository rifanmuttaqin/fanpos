<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblHistoryStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_history_stock', function (Blueprint $table) {
            $table->bigIncrements('id', 20);
            $table->unsignedBigInteger('variant_detail_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('stock_in');
            $table->integer('stock_out');
            $table->integer('current_stock');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            

            $table->foreign('variant_detail_id')
                ->references('id')
                ->on('tbl_variant_detail')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('tbl_product')
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
        Schema::dropIfExists('tbl_history_stock');
    }
}
