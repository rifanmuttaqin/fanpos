<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblStockProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_stock_product', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('variant_id');
            $table->unsignedBigInteger('variant_detail_id');
            $table->integer('stock');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('product_id')
            ->references('id')
            ->on('tbl_product')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->foreign('variant_id')
            ->references('id')
            ->on('tbl_variant')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('variant_detail_id')
            ->references('id')
            ->on('tbl_variant_detail')
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
        Schema::dropIfExists('tbl_stock_product');
    }
}
