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
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->boolean('is_favorite')->default(0)->comment('fav of admin');
            $table->boolean('is_approved')->default(0)->comment('approval by admin');
            $table->string('rejection_comment')->nullable()->comment('why not approved');
            $table->boolean('has_admin_answered')->default(0)->comment('answered by admin');
            $table->string('title');
            $table->foreignId('subject_id')->nullable()->constrained('subjects')->onDelete('cascade');
            $table->foreignId('topic_id')->nullable()->constrained('topics')->onDelete('cascade');
            $table->longText('details');
            $table->longText('photo')->nullable();
            $table->bigInteger('upvotes')->default(0)->comment('total likes');
            $table->bigInteger('downvotes')->default(0)->comment('total dislikes');
            $table->longText('tags')->nullable();
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
        Schema::dropIfExists('questions');
    }
}