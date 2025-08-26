<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {Schema::create('monitoring', function (Blueprint $table) {
    $table->id();
    $table->date('tanggal_monitoring');
    $table->unsignedBigInteger('id_inovasi');
    $table->string('keterangan');
    $table->string('nilai_monitoring');
    $table->string('status');
    $table->timestamp('created_at')->useCurrent();
    $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
});
    }

    public function down()
    {
        Schema::dropIfExists('monitoring');
    }
};
