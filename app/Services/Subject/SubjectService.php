<?php
namespace App\Services\Subject;

use App\Models\Subject;

class SubjectService
{
    public function getAllSubjects(array $selectColumns = ['*'])
    {
        return Subject::select($selectColumns)->get();
    }

    public function getSubjectsWithLessonsWithReviewsOfStudent($student)
    {
        return $student->subjects()->with([
            'lessons.studentLessons.syllabus',
            'lessons.studentLessons.studentLessonReview.syllabusReviews',
        ])->get();
    }

    public function getSubjectsWtihLessons()
    {
        return Subject::with('lessons')->get();
    }

    public function createSubject($request,$book_name,$fileName)
    {
        return  Subject::create([
            'name' => $request->name,
            'book' => $book_name,
            'avatar' => $fileName,
        ]);
    }

    public function updateSubject($subject,$request,$book_name,$fileName)
    {
        return $subject->update([
            'name' => $request->name,
            'book' => $book_name,
            'avatar' => $fileName,
        ]);
    }

    public function convertedSubjectBookToBookName($old_name,$book_name)
    {
        return   rename(
                    public_path($old_name),
                    public_path('files/subjects/' . $book_name)
                );
    }

    public function switchSubjectNameToRequetName($subject,$request)
    {
        return    rename(
                    public_path('files/subjects/' . $subject->name . "/"),
                    public_path('files/subjects/' . $request->name . "/")
                );
    }
}