<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('title', 255);
            $table->text('message');
            $table->boolean('notify')->default(false);
            $table->enum('type', [1, 2, 3])->default(1);
            $table->boolean('priority')->default(false);
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('user_id');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('messages');
    }
}
