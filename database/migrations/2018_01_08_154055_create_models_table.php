<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('models', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });


        Schema::table('equipments', function(Blueprint $table) {
          $table->integer('model_id')->unsigned();
          $table->foreign('model_id')->references('id')->on('models');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipments', function(Blueprint $table) {
              $table->dropForeign('equipments_model_id_foreign');
      		    $table->dropColumn('model_id');
        });

        Schema::dropIfExists('models');
    }
}
