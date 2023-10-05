<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_lesson_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_lesson_id');
            $table->boolean('finished')->default(false);
            $table->float('percentage')->default(0)->nullable();
            $table->unsignedInteger('last_chapter_finished')->default(0);
            $table->unsignedInteger('last_page_finished')->default(0);
            $table->timestamps();

            $table->foreign('student_lesson_id')
                ->references('id')
                ->on('student_lessons')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_lesson_reviews');
    }
};
