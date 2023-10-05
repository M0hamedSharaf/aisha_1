<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class TgweedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subject = Subject::firstOrCreate([
            'name' => 'المنهج المفيد لمراكز تعليم الجويد'
        ], []);

        $chapters = chapterTgweed();
        $chaptersarray = [];

        foreach ($chapters as  $chapter) {

            $chaptersarray[] = [
                'title' => $chapter['lesson_ar'],
                'subject_id' => $subject->id,
                'chapters_count' => $chapter['num_pages'],
                'from_page' => $chapter['from_page'],
                'to_page' => $chapter['to_page'],
            ];
        }
        Lesson::upsert(
            $chaptersarray,
            ['title', 'subject_id']
        );
    }
}