<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->integer('note_type')->comment('1=>Todays corner, 2=>Notes');
            $table->foreignId('subject_id')->nullable()
            ->constrained('subjects')
            ->onDelete('cascade');
            $table->foreignId('topic_id')->nullable()
            ->constrained('topics')
            ->onDelete('cascade');
            $table->string('title');
            $table->longText('description');
            $table->longText('pdf')->nullable();
            $table->longText('image')->nullable();
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
        Schema::dropIfExists('notes');
    }
}