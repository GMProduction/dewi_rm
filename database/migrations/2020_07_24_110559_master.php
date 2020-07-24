<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Master extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spesialis', function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('pasien_profil', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('nama');
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['L', 'P'])->default('L');
            $table->text('alamat');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('dokter_profil', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('nama');
            $table->bigInteger('spesialis_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('spesialis_id')->references('id')->on('spesialis');
        });

        Schema::create('admin_profil', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('nama');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('diagnosa', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dokter_id')->unsigned();
            $table->bigInteger('pasien_id')->unsigned();
            $table->text('diagnosa');
            $table->timestamps();
            $table->foreign('dokter_id')->references('id')->on('users');
            $table->foreign('pasien_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasien_profil');
    }
}
