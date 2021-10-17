<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('info');
            $table->text('question');
            $table->text('question_video')->nullable();
            $table->string('category');
            $table->string('visibility');
            $table->string('option_type')->nullable();
            $table->string('edit_by')->default(0);
            $table->string('status');
            $table->bigInteger('user_id');
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
        Schema::dropIfExists('polls');
    }
}
