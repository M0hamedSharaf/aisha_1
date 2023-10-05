<?php

namespace App\Services\GroupSubject;

use App\Models\GroupSubject;

class GroupSubjectService
{

    public function getAllGroupSubjects(array $columns = ['id', 'subject_id', 'group_id'])
    {
        return GroupSubject::select($columns)->get();
    }

    public function createGroupSubject(object $request)
    {
        return GroupSubject::create([
            'subject_id' => $request->subject_id,
            'group_id'   => $request->group_id,
        ]);
    }

    public function updateGroupSubject(GroupSubject $groupSubject, object $request)
    {
        return $groupSubject->update([
            'subject_id' => $request->subject_id,
            'group_id'   => $request->group_id,
        ]);
    }

    public function deleteGroupSubject(GroupSubject $groupSubject)
    {
        return $groupSubject->delete();
    }

    public function getGroupSubjectsOfGroup(int $group_id)
    {
        return GroupSubject::where('group_id', $group_id)->select(['group_id', 'subject_id'])->get();
    }
}