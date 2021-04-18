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
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->boolean('is_approved')->default(0)->comment('approval by admin');
            $table->string('rejection_comment')->nullable()->comment('why not approved');
            $table->boolean('is_correct_marked')->default(0);
            $table->foreignId('question_id')->nullable()->constrained('questions')->onDelete('cascade');
            $table->longText('answer');
            $table->longText('photo')->nullable();
            $table->bigInteger('upvotes')->default(0)->comment('total likes');
            $table->bigInteger('downvotes')->default(0)->comment('total dislikes');
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
        Schema::dropIfExists('answers');
    }
}