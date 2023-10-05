<?php

namespace App\Services\Group;

use App\Models\Group;

class GroupService
{
    public function getAllGroups()
    {
        return  Group::get();
    }

    public function createGroup(object $request)
    {
        return Group::create([
            'name' => $request->name,
            'teacher_id' => $request->teacher_id,
            'group_type_id' => $request->group_type_id,
            'age_type' => $request->age_type,
        ]);
    }

    public function updateGroup(Group $group, object $request)
    {
        return $group->update([
            'name' => $request->name,
            'group_type_id' => $request->group_type_id,
            'teacher_id' => $request->teacher_id,
            'age_type' => $request->age_type,
        ]);
    }

    public function getGroupWithAllData(Group $group)
    {
        return $group->load([
            'groupStudents' => function ($q) use ($group) {
                return $q->select(['id', 'group_id', 'student_id'])
                    ->with([
                        'student' => function ($q) use ($group) {
                            return $q->select(['id', 'name', 'avatar', 'birthday', 'phone'])
                                ->with([
                                    'payments' => function ($q) use ($group) {
                                        return $q->select(['id', 'group_id', 'student_id', 'paid', 'month'])->where('group_id', $group->id);
                                    }
                                ]);
                        }
                    ]);
            },
            'groupSubjects' => function ($q) {
                return $q->select(['id', 'group_id', 'subject_id'])
                    ->with('subject:id,name,pages_count');
            },
            'groupType:id,name,price',
            'teacher:id,name,email,birthday,phone,qualification' => [
                "role:id,name"
            ],
        ]);
    }

    public function getGruopsWithPaymentsByMonth($currentMonth)
    {
        $gorups = Group::with([
            'students.payments',
            'groupType',
            'payments' => function ($query) use ($currentMonth) {
                return $query->where('month', $currentMonth);
            }
        ])->get();

        return $gorups;
    }

    function appendAllStudentsPaidToGroups($gorups)
    {
        $gorups->map(function ($group) {
            $group->allStudentsPaid = $group->students->count() == $group->payments->where('paid', true)->where('month', getCurrectMonthName())->count();
        });
    }
}
