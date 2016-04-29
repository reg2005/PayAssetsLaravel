<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReg2005ExchangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg2005_exchanges', function (Blueprint $table) {

            $table->increments('id');

            $table->text('Name')->nullable();
            $table->text('Currency')->nullable();
            $table->decimal('Rate', 10, 4)->nullable()->default(0);
            $table->decimal('Ask', 10, 4)->nullable()->default(0);
            $table->decimal('Bid', 10, 4)->nullable()->default(0);
            $table->text('-id')->nullable();

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
        Schema::drop('reg2005_exchanges');
    }
}
