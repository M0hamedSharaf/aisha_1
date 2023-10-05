<?php

use Illuminate\Support\Facades\Session;

if (!function_exists('getStudentTypes')) {
    function getStudentTypes()
    {
        return [
            'normal' => 'عادي',
            'dense' => 'مكثف',
        ];
    }
}

if (!function_exists('ellipsis')) {
    function ellipsis($str, int $max)
    {
        return strlen($str) > $max ? substr($str, 0, $max) . "..." : $str;
    }
}


if (!function_exists('getFlag')) {
    function getFlag($localeCode)
    {
        $countries = [
            'ar' => 'eg.png',
            'en' => 'usa.png',
        ];

        return $countries[$localeCode];
    }
}



if (!function_exists('getGuard')) {
    function getGuard()
    {
        return Session::get('admin_guard');
    }
}

if (!function_exists('getPermissions')) {
    function getPermissions()
    {
        return json_decode(Session::get('permissions'));
    }
}

if (!function_exists('userCan')) {
    function userCan($permission)
    {
        if (in_array($permission, getPermissions())) {
            return true;
        }
        return false;
    }
}


if (!function_exists('getMonthNames')) {
    function getMonthNames()
    {
        return [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];
    }
}


if (!function_exists('getCurrectMonthName')) {
    function getCurrectMonthName()
    {
        return date('F');
    }
}

if (!function_exists('getPermissionKeys')) {
    function getPermissionKeys()
    {
        return [
            'index',
            'create',
            'edit',
            'store',
            'update',
            'delete',
            'show',
        ];
    }
}

if (!function_exists('getPermissionTables')) {
    function getPermissionTables()
    {
        return [
            // 'exam' => trans('main.exam'),
            'experience' => trans('main.experience'),
            'group' => trans('main.group'),
            'groupDay' => trans('group.groups_days'),
            'groupStudent' => trans('group.group_students'),
            'groupSubject' => trans('group.groups_subject'),
            'groupType' => trans('group.group_type'),
            'lesson' => trans('main.lessons'),
            'payment' => trans('main.payment'),
            'role' => trans('main.role'),
            'student' => trans('main.student'),
            'studentLesson' => trans('student.student_lessons'),
            'studentLessonReview' => trans('student.student_lessons_review'),
            'subject' => trans('main.subject'),
            'syllabus' => trans('main.syllabus'),
            'syllabusReview' => trans('student.syllabus_review'),
            'teacher' => trans('main.teacher'),
            'user' => trans('main.users'),
            'studentNotes' => trans('student.student_notes'),
            'setting' => trans('main.settings'),
            'elementor' => trans('main.elementor'),
        ];
    }
}



if (!function_exists('getAdditionalPermissions')) {
    function getAdditionalPermissions()
    {
        return [
            'report' => [
                'report-payment'
            ],
            'note' => [
                'note-studentIndex'
            ]
        ];
    }
}


if (!function_exists('getPermissionsForView')) {
    function getPermissionsForView()
    {
        $keys = getPermissionKeys();
        $tables = getPermissionTables();
        $additionalPermissions = getAdditionalPermissions();


        $permissions = [];

        foreach ($tables as $table => $tableName) {
            foreach ($keys as $key => $value) {
                $permissions[$table][] = [
                    'key' => $value,
                    'value' => "$value-$table",
                ];
            }
        }

        return $permissions;
    }
}


if (!function_exists('getPermissionsForSeeder')) {
    function getPermissionsForSeeder()
    {
        $keys = getPermissionKeys();
        $tables = getPermissionTables();

        $additionalPermissions = getAdditionalPermissions();

        $permissions = [];

        foreach ($tables as $table => $tableName) {
            foreach ($keys as $key => $value) {
                $permissions[]['name'] = "$value-$table";
            }
        }

        foreach ($additionalPermissions as $items) {
            foreach ($items as $permission) {
                $permissions[]['name'] = $permission;
            }
        }

        return $permissions;
    }
}


if (!function_exists('getPermissionsArray')) {
    function getPermissionsArray()
    {
        $keys = getPermissionKeys();
        $tables = getPermissionTables();

        $additionalPermissions = getAdditionalPermissions();

        $permissions = [];

        foreach ($tables as $table => $tableName) {
            foreach ($keys as $key => $value) {
                $permissions[] = "$value-$table";
            }
        }

        foreach ($additionalPermissions as $items) {
            foreach ($items as $permission) {
                $permissions[] = $permission;
            }
        }

        return $permissions;
    }
}


if (!function_exists('getSeededRoles')) {
    function getSeededRoles()
    {
        return [
            [
                'name' => 'admin',
                'display_name' => 'admin',
                'description' => 'Have All Control On System',
            ],
            [
                'name' => 'teacher',
                'display_name' => 'teacher',
                'description' => 'Have Accessibility on teacher and Student Actions ',
            ],
            [
                'name' => 'student',
                'display_name' => 'student',
                'description' => 'Have Accessibility on Student Actions',
            ],

        ];
    }
}


if (!function_exists('getMonthsAccordingToLocalization')) {
    function getMonthsAccordingToLocalization($months)
    {
        foreach($months as $key => $month_en)
        {
            $months[$key] = trans("main.$month_en");
        }
        return $months;
    }
}