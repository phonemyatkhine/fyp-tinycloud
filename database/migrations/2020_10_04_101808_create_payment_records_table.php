<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_details_id');
            $table->foreignId('package_id');
            $table->float('amount');
            $table->date('paid_date');
            $table->timestamps();
        });
        Schema::table('payment_records', function (Blueprint $table) {
            $table->foreign('payment_details_id')->references('id')->on('payment_details')->onUpdate('cascade');
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
        Schema::dropIfExists('payment_records');
    }
}
