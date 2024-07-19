<?php
// database/migrations/<timestamp>_create_mahasiswas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 25);
            $table->string('nip', 12)->unique();
            $table->string('universitas');
            $table->text('keterangan')->nullable();
            $table->timestamps(); // Tambahkan timestamps() untuk created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('mahasiswas');
    }
}
