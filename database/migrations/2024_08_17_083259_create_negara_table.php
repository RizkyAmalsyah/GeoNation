<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegaraTable extends Migration
{
    public function up()
    {
        Schema::create('negara', function (Blueprint $table) {
            $table->id('id_negara');
            $table->foreignId('id_kawasan')->constrained('kawasan', 'id_kawasan');
            $table->foreignId('id_direktorat')->constrained('direktorat', 'id_direktorat');
            $table->string('nama_negara', 100);
            $table->string('kode_negara', 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('negaras');
    }
}

