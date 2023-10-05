<?php

namespace App\Services\Experience;

use App\Models\Experience;
use DateTime;
use Illuminate\Database\Eloquent\Collection;

class ExperienceService
{
    public function createExperience(object $request)
    {
        return Experience::create([
            'title' => $request->title,
            'from' => $request->from,
            'to' => $request->to,
            'teacher_id' => $request->teacher_id
        ]);
    }

    public function updateExperience(Experience $experience, object $request)
    {
        return $experience->update([
            'title' => $request->title,
            'from' => $request->from,
            'to' => $request->to,
            'teacher_id' => $request->teacher_id,
        ]);
    }

    public function deleteExperience(Experience $experience)
    {
        return $experience->delete();
    }

    public function getCountOfExperienceYears(Collection|array $experiences)
    {
        $years = 0;
        $months = 0;
        $days = 0;

        foreach ($experiences as $experience) {
            $from = new DateTime($experience->from);
            $to = new DateTime($experience->to);

            $diff = $from->diff($to);

            $years += $diff->y;
            $months += $diff->m;
            $days += $diff->d;
        }

        return $years + floatval(($months / 12)) + floatval(($days / (12 * 24)));
    }
}
