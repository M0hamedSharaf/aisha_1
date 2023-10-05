<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QaidaNooraniahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subject = Subject::firstOrCreate([
            'name' => 'القاعدة النورنية'
        ], []);

        $chapters = chapterQaidaNooraniah();
        $chaptersarray = [];

        foreach ($chapters as  $chapter) {

            $chaptersarray[] = [
                'title' => $chapter['lesson_ar'],
                'subject_id' => $subject->id,
                'chapters_count' => $chapter['number_of_squares'],
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