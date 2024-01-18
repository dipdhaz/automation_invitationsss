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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('nomor_paspor');
            $table->string('nama_lengkap');
            $table->char('jenis_kelamin', 1); // Assuming 'L' or 'P' for gender
            $table->string('alamat');
            $table->string('tahapan');
            $table->string('tps');
            $table->string('desa_kelurahan');
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
        Schema::dropIfExists('users');
    }
};
