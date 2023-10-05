<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $permissions = getPermissionsArray();
        
        $adminRole = Role::where('name', 'admin')->first();

        $admin = User::firstOrCreate([
            'email' => 'admin@admin.com',
        ], [
            'name' => 'admin',
            'password' => Hash::make('123')
        ]);

        $teacher = Teacher::firstOrCreate([
            'email' => 't@t.com',
        ], [
            'name' => 'teacher-ahmed',
            'password' => Hash::make('123')
        ]);

        $student = Student::firstOrCreate([
            'email' => 's@s.com',
        ], [
            'name' => 'Student-ali',
            'password' => Hash::make('123')
        ]);

        if (!$admin->hasRole('admin')) {

            $admin->attachRole('admin');

            $adminRole->attachPermissions($permissions);
        }

        if (!$teacher->hasRole('admin')) {
            $teacher->attachRole('admin');
        }

        if (!$student->hasRole('admin')) {
            $student->attachRole('admin');
        }
    }
}
