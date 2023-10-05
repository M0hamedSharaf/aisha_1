<?php

namespace App\Services;

use App\Models\Group;
use App\Models\GroupType;

class HomeService
{

    private $groups;
    private $allGroupsCount;

    function getGroupsCountsData()
    {
        $this->setGroups();
        $this->setAllGroupsCount();

        $groupKidsCount = $this->getGroupKidsCount();
        $groupAdultCount = $this->getGroupAdultsCount();

        $groupKidsPercentage = $this->getGroupPercentageOf($groupKidsCount);
        $groupAdultPercentage = $this->getGroupPercentageOf($groupAdultCount);

        $groupTypes = GroupType::withCount('groups')->get();

        $groupTypes->map(function($groupType){
            $groupType->percentage = $this->getGroupPercentageOf($groupType->groups_count);
        });

        return [
            'allGroupsCount' => $this->allGroupsCount,
            'groupKidsCount' => $groupKidsCount,
            'groupAdultCount' => $groupAdultCount,
            'groupKidsPercentage' => $groupKidsPercentage,
            'groupAdultPercentage' => $groupAdultPercentage,
            'groupTypes' => $groupTypes
        ];
    }

    private function getGroups()
    {
        return Group::select(['id','age_type'])->get();
    }

    private function setGroups()
    {
        $this->groups = $this->getGroups();
    }

    private function setAllGroupsCount()
    {
        $this->allGroupsCount = $this->groups->count();
    }
    
    private function getGroupKidsCount()
    {
        return $this->groups->where('age_type', 'kid')->count();
    }
    private function getGroupAdultsCount()
    {
        return $this->groups->where('age_type', 'adult')->count();
    }

    private function getGroupPercentageOf($groupKindCount)
    {
        return $this->allGroupsCount > 0 ? round(($groupKindCount / $this->allGroupsCount) * 100) : 0;
    }
}