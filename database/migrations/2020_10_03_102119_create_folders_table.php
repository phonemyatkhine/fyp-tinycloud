<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('storage_id');
            $table->string('name');
            $table->string('path');
            $table->string('privacy');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('folders', function (Blueprint $table){
            $table->foreign('storage_id')->references('id')->on('storages')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folders');
        Schema::table('folders', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
