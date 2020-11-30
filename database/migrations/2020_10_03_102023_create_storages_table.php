<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->bigInteger('total_space');
            $table->bigInteger('used_space');
            $table->string('type');
            $table->string('path');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('storages',function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('storages');
        Schema::table('storages', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
