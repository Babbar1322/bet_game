<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('user_uid')->nullable();
            $table->string('user_name')->nullable();
            $table->string('level')->nullable();
            $table->string('descripiton')->nullable();
            $table->integer('from_uid')->nullable();
            $table->string('type')->nullable();
            $table->boolean('debit')->default(0);
            $table->boolean('credit')->default(0);
            $table->float('balance');
            $table->boolean('wallet_type')->default(0);
            $table->boolean('is_exchanged')->default(0);
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
        Schema::dropIfExists('wallets');
    }
}
