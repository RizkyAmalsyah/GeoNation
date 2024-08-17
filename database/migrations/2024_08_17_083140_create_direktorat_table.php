<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirektoratTable extends Migration
{
    public function up()
    {
        Schema::create('direktorat', function (Blueprint $table) {
            $table->id('id_direktorat');
            $table->string('nama_direktorat', 100);
            $table->timestamps(); // akan membuat kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('direktorats');
    }
}
