<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('que_content');
            $table->string('slug');
            $table->date('que_date');
            $table->time('que_time');
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger( 'updated_by')->nullable();
            $table->timestamps();
            $table->foreign('category_id')
                ->references('id')->on('categories')
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
        Schema::dropIfExists('questions');
    }
}
