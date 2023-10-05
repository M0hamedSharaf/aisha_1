<?php

namespace App\Http\Requests\StudentLesson;

use App\Rules\Admin\StudentLesson\CheckLessonChaptersCountMaxRule;
use App\Rules\Admin\StudentLesson\CheckLastPageFinishedMaxRule;
use Illuminate\Foundation\Http\FormRequest;

class StudentLessonReviewRequest extends FormRequest
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
     * @return string[]
     * #[ArrayShape(['name' => "string"])]
     */
    protected function finished(): array
    {
        return [
            'group_id'           => 'required|exists:groups,id',
            'lesson_id'          => 'required|exists:lessons,id',
            'student_id'         => 'required|exists:students,id',
            'finished'           => 'required',
            'chapters_count'     => ['required','integer', new CheckLessonChaptersCountMaxRule],
            'last_page_finished' => ['required','integer',new CheckLastPageFinishedMaxRule()],
        ];
    }

    /**
     * @return string[]
     * #[ArrayShape(['name' => "string"])]
     */
    protected function notFinished(): array
    {
        return [
            'group_id'           => 'required|exists:groups,id',
            'lesson_id'          => 'required|exists:lessons,id',
            'student_id'         => 'required|exists:students,id',
            'finished'           => 'required',
        ];
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        if ($this->finished == "true") 
        {
            return $this->finished();
        } 
        else 
        {
            return $this->notFinished();
        }
    }
}



