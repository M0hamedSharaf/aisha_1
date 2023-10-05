<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class QuraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $subject = Subject::firstOrCreate([
            'name' => 'القرآن الكريم'
        ], []);

        $chapters = chapterQuran();
        $chaptersarray = [];

        foreach ($chapters as  $chapter) {

            $chaptersarray[] = [
                'title' => $chapter['surah_ar'],
                'subject_id' => $subject->id,
                'chapters_count' => $chapter['surah_count'],
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