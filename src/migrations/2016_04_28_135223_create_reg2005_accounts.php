<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReg2005Accounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasTable('reg2005_accounts')) {
            //
            Schema::create('reg2005_accounts', function (Blueprint $table) {
                $table->increments('id');
                $table->text('login')->nullable();
                $table->text('password')->nullable();
                $table->text('protocol')->nullable();
                $table->text('address')->nullable();

                $table->decimal('USD', 10)->nullable()->default(0);
                $table->decimal('RUB', 10)->nullable()->default(0);
                $table->decimal('BTC', 14, 8)->nullable()->default(0);
                $table->decimal('EUR', 10)->nullable()->default(0);
                $table->decimal('KZT', 10)->nullable()->default(0);
                $table->decimal('GOLD', 10)->nullable()->default(0);

                $table->decimal('in_turnover_current_monthly', 10)->nullable()->default(0);
                $table->decimal('out_turnover_current_monthly', 10)->nullable()->default(0);

                $table->integer('no_active')->default(0);
                $table->integer('error_out_pays')->default(0);
                $table->text('type')->nullable();
                $table->text('site')->nullable();

                $table->integer('upd_history')->nullable()->default(0);

                $table->timestamp('last_history')->default('2016-01-01 00:00:00');
                $table->timestamp('last_use');
                $table->timestamps();
            });

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reg2005_accounts');
    }
}
