<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_induk');
            $table->string('location')->comment('tempat lahir');
            $table->date('date_of_birth')->comment('tanggal lahir');
            $table->tinyInteger('gender')->comment('1 = laki, 2 = wanita');
            $table->unsignedInteger('religion_id');
            $table->text('address')->nullabel();
            $table->string('the_village')->comment('kelurahan')->nullabel();
            $table->string('sub_district')->comment('kecamatan')->nullabel();
            $table->string('pkb')->comment('provinsi kabupaten kota');
            $table->string('zip_code')->comment('kode_pos');
            $table->string('job')->comment('');
            $table->string('graduates')->comment('lulusan sekolah');
            $table->string('contact')->comment('');
            $table->string('purpose')->comment('tujuan mendaftar');
            $table->string('reference')->comment('');
            $table->string('avatar')->default('default_avatar.jpg');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('religion_id')->references('id')->on('religions');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_users');
    }
}
