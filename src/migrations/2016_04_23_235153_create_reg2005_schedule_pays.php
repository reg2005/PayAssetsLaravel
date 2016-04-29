<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReg2005SchedulePays extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('reg2005_schedule_pays', function (Blueprint $table) {

            $table->increments('id');

            $table->decimal('amount', 14, 8)->default(0)->comment = "Amount for Pay";

            $table->text('currency')->nullable()->comment = "USD, EUR, BTC, GOLD, RUB, KZT";

            $table->text('type')->nullable()->comment = "PM or QIWI or BTC";

            $table->text('destination')->comment = "Destination for Pay";

            $table->integer('request_id')->nullable();

            $table->integer('timeout')->nullable()->default(0);

            $table->text('item_of_expenditure')->nullable();

            $table->timestamp('money_send')->nullable();

            $table->text('send_from')->nullable();

            $table->text('send_transfer_id')->nullable();

            $table->boolean('disable')->default(0);

            $table->integer('error_pay')->nullable()->default(0);

            $table->text('comment')->nullable();


            $table->text('send_from_pm_wallet')->nullable();

            $table->text('send_to_pm_account_name')->nullable();



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
        Schema::drop('reg2005_schedule_pays');
    }

}
