<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionlikedislikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionlikedislikes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()
            ->constrained('users')
            ->onDelete('cascade');
            $table->foreignId('question_id')->nullable()
            ->constrained('questions')
            ->onDelete('cascade');
            $table->boolean('upordown')->comment('Up or Down Vote, 1 means Upvote');
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
        Schema::dropIfExists('questionlikedislikes');
    }
}