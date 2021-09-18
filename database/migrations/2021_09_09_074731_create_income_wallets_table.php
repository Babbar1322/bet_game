<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_wallets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('user_uid')->nullable();
            $table->string('user_name')->nullable();
            $table->string('level')->nullable();
            $table->string('description')->nullable();
            $table->integer('from_uid')->nullable();
            $table->string('type')->nullable();
            $table->boolean('credit')->default(0);
            $table->float('balance');
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
        Schema::dropIfExists('income_wallets');
    }
}
