<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyComptesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_comptes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transfer_id')->nullable();
            $table->unsignedBigInteger('receiver_id')->nullable();
            $table->bigInteger('previous_balances')->default(0);
            $table->bigInteger('amounts')->default(0);
            $table->bigInteger('balances')->default(0);
            $table->timestamps();

            $table->foreign('transfer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_comptes');
    }
}
