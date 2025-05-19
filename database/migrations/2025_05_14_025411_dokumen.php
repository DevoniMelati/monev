<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dokumen', function (Blueprint $table) {
         $table->id();
         $table->string('nama_file'); // ← ini contoh kolom yang mungkin ada
         $table->unsignedBigInteger('id_inovasi');
         $table->string('unggah_file');
         $table->date('tanggal_upload');
         $table->timestamps();
});
    }

    public function down()
    {
        Schema::dropIfExists('tb_dokumen');
    }
};
