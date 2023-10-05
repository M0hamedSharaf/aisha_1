<?php

namespace Tests\Controller;

use App\Services\Role\RoleService;
use App\Services\User\UserService;
use Mockery\MockInterface;
use Tests\TestCaseWithTransLationsSetUp;
use Tests\Traits\TestUserTrait;

class UserControllerTest extends TestCaseWithTransLationsSetUp
{

    use TestUserTrait;

    protected function setUp() : void
    {
        parent::setUp();

        $this->refreshApplicationWithLocale('en');
    }

    public function test_index_opens_without_errors()
    {
        $this->mock(RoleService::class, function(MockInterface $mock){
            $mock->shouldReceive('getRoles')->once()->with(['name'])->andReturn([]);
        });

        $res = $this->call('get',route('admin.user.index'));

        $res->assertOk();
    }

    /**
     * @test
     * @dataProvider storeValidationProvider
     */
    public function test_store_validations($data)
    {
        $res = $this->call('POST',route('admin.user.store'), $data);

        $res->assertSessionHasErrors();
    }

    public function test_store_pass_with_all_data()
    {
        $data = $this->generateRandomUserData();

        $this->mock(UserService::class, function(MockInterface $mock){
            $mock->shouldReceive('createUser')->once();
        });

        $res = $this->call('POST',route('admin.user.store'), $data);

        $res->assertSessionHasNoErrors();
    }

    /**
     * @dataProvider updateValidationProvider
     */
    public function test_update_validations($data)
    {
        $user = $this->generateRandomUser();
        
        $res = $this->call('PUT',route('admin.user.update',$user->id),$data);

        $res->assertSessionHasErrors();
    }

    public function test_update_works_with_all_data()
    {
        $user = $this->generateRandomUser();
        $data = $this->generateRandomUserData();

        $this->mock(UserService::class, function(MockInterface $mock){
            $mock->shouldReceive('updateUser')->once();
        });

        $res = $this->call('PUT',route('admin.user.update',$user->id), $data);

        $res->assertSessionHasNoErrors();
    }

    public function test_user_get_deleted_without_errors()
    {
        $user = $this->generateRandomUser();

        $this->mock(UserService::class, function(MockInterface $mock){
            $mock->shouldReceive('deleteUser')->once();
        });

        $res = $this->call('get',route('admin.user.delete',$user->id));

        $res->assertSessionHasNoErrors();
    }


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
                    'email' => fake()->email,
                    'password' => $password,
                    'password_confirmation' => $password,
                    'role' => fake()->randomElement(getSeededRoles())['name']
                ],
            ],
            "without a email" => [
                [
                    'name'  => fake()->name,
                    'email' => null,
                    'password' => $password,
                    'password_confirmation' => $password,
                    'role' => fake()->randomElement(getSeededRoles())['name']
                ],
            ],
            "with an email that has a wrong format" => [
                [
                    'name'  => fake()->name,
                    'email' => "this is a wrong email format",
                    'password' => $password,
                    'password_confirmation' => $password,
                    'role' => fake()->randomElement(getSeededRoles())['name']
                ],
            ],
            "without password" => [
                [
                    'name'  => fake()->name,
                    'email' => fake()->email,
                    'password' => null,
                    'password_confirmation' => $password,
                    'role' => fake()->randomElement(getSeededRoles())['name']
                ],
            ],
            "without confirmation password" => [
                [
                    'name'  => fake()->name,
                    'email' => fake()->email,
                    'password' => $password,
                    'password_confirmation' => null,
                    'role' => fake()->randomElement(getSeededRoles())['name']
                ],
            ],
            "with password that don't match confirmation" => [
                [
                    'name'  => fake()->name,
                    'email' => fake()->email,
                    'password' => $password,
                    'password_confirmation' => fake()->password,
                    'role' => fake()->randomElement(getSeededRoles())['name']
                ],
            ],
            "without role" => [
                [
                    'name'  => fake()->name,
                    'email' => fake()->email,
                    'password' => $password,
                    'password_confirmation' => $password,
                    'role' => null
                ],
            ],
            "with a role that doesn't exist" => [
                [
                    'name'  => fake()->name,
                    'email' => fake()->email,
                    'password' => $password,
                    'password_confirmation' => $password,
                    'role' => "this is a role that doesn't exist"
                ],
            ],
        ];
    }


    public function updateValidationProvider() : array
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
                    'email' => fake()->email,
                    'password' => $password,
                    'password_confirmation' => $password,
                    'role' => fake()->randomElement(getSeededRoles())['name']
                ],
            ],
            "without a email" => [
                [
                    'name'  => fake()->name,
                    'email' => null,
                    'password' => $password,
                    'password_confirmation' => $password,
                    'role' => fake()->randomElement(getSeededRoles())['name']
                ],
            ],
            "with an email that has a wrong format" => [
                [
                    'name'  => fake()->name,
                    'email' => "this is a wrong email format",
                    'password' => $password,
                    'password_confirmation' => $password,
                    'role' => fake()->randomElement(getSeededRoles())['name']
                ],
            ],
        ];
    }
}