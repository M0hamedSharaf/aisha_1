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
        Schema::create('syllabi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_lesson_id');
            $table->unsignedInteger('from_chapter')->default(0);
            $table->unsignedInteger('to_chapter')->default(0);
            $table->unsignedInteger('from_page')->default(0);
            $table->unsignedInteger('to_page')->default(0);
            $table->boolean('finished')->default(false);
            $table->enum('rate',[
                'excellent', 'very good', 'good', 'fail'
            ])->nullable();
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
        Schema::dropIfExists('syllabi');
    }
};
