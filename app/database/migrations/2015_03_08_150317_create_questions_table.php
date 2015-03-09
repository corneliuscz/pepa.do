<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('questions', function(Blueprint $table)
    {
      $table->increments('id');
      $table->string('asker')->nullable();
      $table->text('question');
      $table->tinyInteger('qstatus');
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
    Schema::drop('questions');
  }

}
