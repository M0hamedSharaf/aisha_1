<?php

namespace App\Services\Student;

use App\Models\Student;
use App\Services\ImageService;
use Illuminate\Support\Facades\Hash;

class StudentService
{
    private ImageService $imageService;

    public function __construct(
        ImageService $imageService
    )
    {
        $this->imageService = $imageService;
    }

    /**
     * Get All Students
     * Select Columns That You Want To Get
     * ['id','name']
     * @param array $selectColumns
     * @return mixed
     */
    public function getAllStudents(array $selectColumns = ['*'])
    {
        return Student::select($selectColumns)->get();
    }

    public function createStudent($request): void
    {
        $fileName = $this->imageService->uploadImage(
            imageObject: $request->file('avatar'),
            path: Student::AVATARS_PATH
        );

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthday' => $request->birthday,
            'phone' => $request->phone,
            'qualification' => $request->qualification,
            'avatar' => $fileName,
        ]);

        $student->attachRole($request->role);

    }

    public function updateStudent($request, $student): void
    {
        $fileName = $student->getRawOriginal('avatar');

        if ($request->file('avatar')) {

            $this->imageService->deleteImage(
                path: $student->getAvatarPath()
            );
            $fileName = $this->imageService->uploadImage(
                imageObject: $request->file('avatar'),
                path: Student::AVATARS_PATH
            );
        }

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $student->password,
            'birthday' => $request->birthday,
            'phone' => $request->phone,
            'qualification' => $request->qualification,
            'avatar' => $fileName,
        ]);

        $student->detachRole($student->role);
        $student->attachRole($request->role);
    }

    public function getStudentWithGroupStudents($student)
    {
        $student->load([
            'groupStudents' => function ($q) {
                $q->with('group.studentLessons');
            },
            'role:id,name'
        ]);
    }

    public function deleteStudent($student): ?bool
    {
        $this->imageService->deleteImage(path: $student->getAvatarPath());
        $student->detachRole($student->role);
        return $student->delete();
    }
}
