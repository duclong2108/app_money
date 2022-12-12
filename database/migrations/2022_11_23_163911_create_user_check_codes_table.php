<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCheckCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_check_codes', function (Blueprint $table) {
            $table->id();
            $table->text('task_id')->nullable();
            $table->text('user_id')->nullable();
            $table->text('code')->nullable();
            $table->integer('check')->default(0);
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
        Schema::dropIfExists('user_check_codes');
    }
}
