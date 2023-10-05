<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('group_days', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->enum('day',
                [
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                    'Saturday',
                    'Sunday'
                ]);

            $table->time('from_time');
            $table->time('to_time');
            $table->timestamps();
            $table->foreign('group_id')
                ->references('id')
                ->on('groups')
                ->onDelete('CASCADE');

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('group_days');
    }
};
