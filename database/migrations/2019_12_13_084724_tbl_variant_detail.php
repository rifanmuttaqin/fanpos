<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblVariantDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_variant_detail', function (Blueprint $table) {
            $table->bigIncrements('id', 20);
            $table->unsignedBigInteger('variant_id');
            $table->string('option')->nullable();
            $table->char('variant_code',9)->unique();
            $table->double('harga_jual');
            $table->double('harga_beli');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('variant_id')
                ->references('id')
                ->on('tbl_variant')
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
        Schema::dropIfExists('tbl_variant_detail');
    }
}
