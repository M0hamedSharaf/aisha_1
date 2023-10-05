<?php

namespace App\Services\GroupType;

use App\Models\GroupType;

class GroupTypeService
{
    public function getAllGroupTypes(array $columns = ['id', 'name'])
    {
        return GroupType::select($columns)->get();
    }


    public function getAllGroupdays(array $columns = ['id', 'group_id', 'day'])
    {
        return GroupType::select($columns)->get();
    }

    public function createGroupType(object $request)
    {
        $price = str_replace(['$', '_', ','], ['', '0', ''], $request->price);

        return GroupType::create([
            'name'     => $request->name,
            'days_num' => $request->days_num,
            'price'    => $price,
        ]);
    }

    public function updateGroupType(GroupType $groupType, object $request)
    {
        $price = str_replace(['$', '_', ','], ['', '0', ''], $request->price);

        return $groupType->update([
            'name'     => $request->name,
            'days_num' => $request->days_num,
            'price'    => $price,
        ]);
    }

    public function deleteGroupType(GroupType $group_type)
    {
        return $group_type->delete();
    }
}
