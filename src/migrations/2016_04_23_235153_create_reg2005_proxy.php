<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReg2005Proxy extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasTable('reg2005_proxys')) {

            Schema::create('reg2005_proxys', function (Blueprint $table) {
                $table->increments('id');

                $table->text('ip');

                $table->boolean('active');

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
        Schema::drop('reg2005_proxys');
    }

}
