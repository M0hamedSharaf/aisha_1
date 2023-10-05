<?php

namespace Tests;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\LaravelLocalization;

class TestCaseWithTransLationsSetUp extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $admin = User::where('email', 'admin@admin.com')->first();
        $permissions = collect(getPermissionsForSeeder())->pluck('name');
        Session::put('admin_guard', 'admin');
        Session::put('permissions', json_encode($permissions));
        $this->actingAs($admin, 'admin');
    }

    protected function refreshApplicationWithLocale($locale)
    {
        self::tearDown();
        putenv(LaravelLocalization::ENV_ROUTE_KEY . '=' . $locale);
        self::setUp();
    }

    protected function tearDown(): void
    {
        putenv(LaravelLocalization::ENV_ROUTE_KEY);
        parent::tearDown();
    }
}
