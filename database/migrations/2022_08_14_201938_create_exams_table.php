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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('lesson_from');
            $table->unsignedBigInteger('lesson_to');
            $table->timestamps();

            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('CASCADE');

            $table->foreign('group_id')
                ->references('id')
                ->on('groups')
                ->onDelete('CASCADE');

            $table->foreign('lesson_from')
                ->references('id')
                ->on('lessons')
                ->onDelete('CASCADE');

            $table->foreign('lesson_to')
                ->references('id')
                ->on('lessons')
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
        Schema::dropIfExists('exams');
    }
};
