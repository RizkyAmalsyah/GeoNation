<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKawasanTable extends Migration
{
    public function up()
    {
      Schema::create('kawasan', function (Blueprint $table) {
        $table->id('id_kawasan');
        $table->foreignId('id_direktorat')->constrained('direktorat', 'id_direktorat');  // Merujuk ke kolom id_direktorat
        $table->string('nama_kawasan', 100);
        $table->timestamps();
    });
    }

    public function down()
    {
        Schema::dropIfExists('kawasans');
    }
}

