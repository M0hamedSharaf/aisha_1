<?php

namespace App\Http\Requests\syllabus;

use App\Http\Requests\ApiRequest;
use App\Models\StudentLesson;
use App\Rules\Admin\Syllabus\LessThanLessonChaptersCountRule;
use App\Rules\Admin\Syllabus\LessThanLessonPagesNumberRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateNewLessonRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "group_id" =>         [ 'required',Rule::exists('groups','id')],
            "lesson_id" =>        [ "required",Rule::exists('lessons','id')],
            "student_id" =>       [ "required",Rule::exists('students','id')],
            'from_chapter' => [
                'required',
                'numeric',
                new LessThanLessonChaptersCountRule()
            ],
            'to_chapter' => [
                'required',
                'numeric',
                'gte:from_chapter',
                new LessThanLessonChaptersCountRule()
            ],
            'from_page' => [
                'required',
                'numeric',
                new LessThanLessonPagesNumberRule()
            ],
            'to_page' => [
                'required',
                'numeric',
                'gte:from_page',
                new LessThanLessonPagesNumberRule()
            ]
        ];
    }
}
