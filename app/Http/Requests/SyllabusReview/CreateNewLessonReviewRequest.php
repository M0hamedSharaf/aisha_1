<?php

namespace App\Http\Requests\SyllabusReview;

use App\Http\Requests\ApiRequest;
use App\Models\StudentLesson;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Admin\Syllabus\LessThanLessonPagesNumberRule;
use App\Rules\Admin\Syllabus\LessThanLessonChaptersCountRule;

class CreateNewLessonReviewRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $studentLesson = StudentLesson::firstOrCreate([
            'group_id' => request('group_id'),
            'lesson_id' => request('lesson_id'),
            'student_id' => request('student_id')
        ],[
            
        ]);
        // $studentLesson = StudentLesson::findOrFail(request('student_lesson_id'))->load('lesson');
        return [
            'from_chapter' => [
                'required',
                'numeric',
                new LessThanLessonChaptersCountRule($studentLesson)
            ],
            'to_chapter' => [
                'required',
                'numeric',
                'gte:from_chapter',
                new LessThanLessonChaptersCountRule($studentLesson)
            ],
            'from_page' => [
                'required',
                'numeric',
                new LessThanLessonPagesNumberRule($studentLesson)
            ],
            'to_page' => [
                'required',
                'numeric',
                'gte:from_page',
                new LessThanLessonPagesNumberRule($studentLesson)
            ]
        ];
    }
}
