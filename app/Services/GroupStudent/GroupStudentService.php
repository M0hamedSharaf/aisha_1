<?php

namespace App\Services\GroupStudent;

use App\Models\GroupStudent;

class GroupStudentService
{

    public function getAllGroupStudents(array $columns = ['id', 'student_id', 'group_id'])
    {
        return GroupStudent::select($columns)->get();
    }

    public function createGroupStudent(object $request)
    {
        return GroupStudent::create([
            'student_id' => $request->student_id,
            'group_id'   => $request->group_id,
        ]);
    }

    public function updateGroupStudent(GroupStudent $groupStudent, object $request)
    {
        return $groupStudent->update([
            'student_id' => $request->student_id,
            'group_id'   => $request->group_id,
        ]);
    }

    public function deleteGroupStudent(GroupStudent $groupStudent)
    {
        return $groupStudent->delete();
    }

    public function getGroupStudentsOfGroup(int $group_id)
    {
        return  GroupStudent::where('group_id', $group_id)->select(['group_id', 'student_id'])->get();
    }
    
    public function getGroupStudentsOfStudent(int $student_id)
    {
        return  GroupStudent::where('student_id', $student_id)->select(['group_id', 'student_id'])->get();
    }
}