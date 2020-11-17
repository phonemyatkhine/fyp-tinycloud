<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoredDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stored_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('folder_id');
            $table->string('name');
            $table->string('path');
            $table->integer('size');
            $table->string('type');
            $table->timestamps();
            $table->softDeletes();

        });
        Schema::table('stored_data', function (Blueprint $table){
            $table->foreign('folder_id')->references('id')->on('folders')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stored_data');
        Schema::table('stored_data', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
