<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('call_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('calls', function (Blueprint $table) {
            
            $table->increments('id');

            $table->integer('subject_id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('approver_id')->unsigned()->nullable();
            $table->foreign('approver_id')->references('id')->on('users');

            $table->date('date');            

            $table->string('status');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('call_subjects');
        Schema::dropIfExists('calls');
    }
}
