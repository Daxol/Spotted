<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_complaints', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('declarant_id');
            $table->integer('receiver_id');
            $table->mediumText('content');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('type')->default(0);
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
        Schema::dropIfExists('user_complaints');
    }
}
