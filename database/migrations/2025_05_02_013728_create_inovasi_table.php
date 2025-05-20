<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inovasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('url');
            $table->string('uraian_inovasi');
            $table->string('basis_inovasi');

            // Foreign key harus unsignedBigInteger
            $table->unsignedBigInteger('id_tipe_lisensi_inovasi');
            $table->unsignedBigInteger('id_jenis_inovasi');

            $table->string('unit_pengembang');
            $table->string('unit_operasional_teknologi');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inovasi');
    }
};
