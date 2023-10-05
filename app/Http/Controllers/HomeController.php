<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use App\Models\Teacher;
use App\Services\HomeService;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    private HomeService $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index()
    {
        $groupsCountsData = $this->homeService->getGroupsCountsData();

        return view('pages.home.home', $groupsCountsData);
    }

    public function getHomeStatistics()
    {

        $data = [
            'statistics' => [
                [
                    'count' => Group::groups()->count(),
                    'icon' => '<i class="fa-solid fa-users-rays"></i>',
                    'title' => trans('main.groups')
                ],
            ]
        ];

        if (getGuard() == 'teacher') {
            $data['statistics'][] = [
                'count' => Auth::guard(getGuard())->user()->unFinishedSyllabus()->count(),
                'icon' => '<i class="fa-solid fa-clock"></i>',
                'title' => trans('main.students_with_lessons')
            ];
        } else {
            $data['statistics'][] = [
                'count' => Teacher::teachers()->count(),
                'icon' => '<i class="fa-solid fa-chalkboard-user"></i>',
                'title' => trans('main.teachers')
            ];
        }

        if (getGuard() == "student") {
            $data['statistics'][] = [
                'count' => Auth::guard(getGuard())->user()->unFinishedSyllabus()->count(),
                'icon' => '<i class="fa-solid fa-clock-rotate-left"></i>',
                'title' => trans('main.un_finished_lessons')
            ];
        } else {
            $data['statistics'][] = [
                'count' => Student::students()->count(),
                'icon' => '<i class="fa-solid fa-graduation-cap"></i>',
                'title' => trans('main.students')
            ];
        }

        return response()->json($data);
    }
}
