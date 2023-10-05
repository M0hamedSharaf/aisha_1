<?php

namespace Tests\Controller;

use App\Jobs\AttachPermissionsToRoleJob;
use App\Services\Permission\PermissionService;
use App\Services\Role\RoleService;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Bus;
use Mockery\MockInterface;
use Tests\TestCaseWithTransLationsSetUp;
use Tests\Traits\TestRoleTrait;

class RoleControllerTest extends TestCaseWithTransLationsSetUp
{

    use TestRoleTrait;

    protected function setUp() : void
    {
        parent::setUp();

        $this->refreshApplicationWithLocale('en');
    }

    public function test_index_opens_without_errors()
    {
        $res = $this->call('get',route('admin.role.index'));

        $res->assertOk();
    }

    public function test_create_opens_without_errors()
    {
        $res = $this->call('get',route('admin.role.create'));

        $res->assertOk();
    }

    /**
     * @test
     * @dataProvider storeValidationProvider
     */
    public function test_store_validations($data)
    {
        $res = $this->call('POST',route('admin.role.store'), $data);

        $res->assertSessionHasErrors();
    }

    public function test_store_pass_with_all_data()
    {
        $data = [
            'name' => fake()->name()
        ];

        $this->mock(RoleService::class, function(MockInterface $mock){
            $mock->shouldReceive('createRole')->once();
        });

        $this->mock(PermissionService::class, function(MockInterface $mock){
            $mock->shouldReceive('getAllPermissionNames')->once()->andReturn([]);
        });

        Bus::fake();

        $res = $this->call('POST',route('admin.role.store'), $data);

        Bus::assertDispatched(AttachPermissionsToRoleJob::class);

        $res->assertSessionHasNoErrors();
    }

    public function test_edit_opens_without_errors()
    {
        $role = $this->getRandomRole();

        $this->mock(RoleService::class, function(MockInterface $mock){
            $mock->shouldReceive('getRolePermissions')->once();
        });

        $res = $this->call('get',route('admin.role.edit', $role));

        $res->assertOk();
    }

    // /**
    //  * @dataProvider storeValidationProvider
    //  */
    // public function test_update_validations($data)
    // {
    //     $user = $this->generateRandomUser();
        
    //     $res = $this->call('PUT',route('admin.user.update',$user->id),$data);

    //     $res->assertSessionHasErrors();
    // }

    // public function test_update_works_with_all_data()
    // {
    //     $user = $this->generateRandomUser();
    //     $data = $this->generateRandomUserData();

    //     $this->mock(UserService::class, function(MockInterface $mock){
    //         $mock->shouldReceive('updateUser')->once();
    //     });

    //     $res = $this->call('PUT',route('admin.user.update',$user->id), $data);

    //     $res->assertSessionHasNoErrors();
    // }

    // public function test_user_get_deleted_without_errors()
    // {
    //     $user = $this->generateRandomUser();

    //     $this->mock(UserService::class, function(MockInterface $mock){
    //         $mock->shouldReceive('deleteUser')->once();
    //     });

    //     $res = $this->call('get',route('admin.user.delete',$user->id));

    //     $res->assertSessionHasNoErrors();
    // }


    public function storeValidationProvider() : array
    {
        $this->refreshApplication();

        $password = fake()->password;

        return [
            "without data" => [
                [
                    
                ],
            ],
            "without a name" => [
                [
                    'name'  => null,
                ],
            ],
        ];
    }
}