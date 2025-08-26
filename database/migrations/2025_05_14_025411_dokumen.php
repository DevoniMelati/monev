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
         $table->unsignedBigInteger('id_inovasi');
         $table->string('nama_file');
         $table->string('unggah_file');
         $table->date('tanggal_upload');
         $table->timestamp('created_at')->useCurrent();
         $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
});
    }

    public function down()
    {
        Schema::dropIfExists('tb_dokumen');
    }
};
