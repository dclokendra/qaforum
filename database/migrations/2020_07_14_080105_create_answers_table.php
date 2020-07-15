<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->text('ans_content');
            $table->string('slug');
            $table->date('ans_date');
            $table->time('ans_time');
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger( 'updated_by')->nullable();
            $table->timestamps();
            $table->foreign('question_id')
                ->references('id')->on('questions')
                ->onUpdate('cascade');
            $table->foreign('created_by')
                ->references('id')->on('visitors')
                ->onUpdate('cascade');
            $table->foreign('updated_by')
                ->references('id')->on('visitors')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
