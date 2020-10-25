<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoragePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('storage_id');
            $table->foreignId('package_id');
            $table->date('updated_date');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('storage_packages', function(Blueprint $table) {
            $table->foreign('storage_id')->references('id')->on('storages')->onUpdate('cascade');
            $table->foreign('package_id')->references('id')->on('packages')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_storage_infos');
        Schema::table('storage_packages', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
