<?php

namespace Tests\Controller;

use App\Models\Teacher;
use App\Models\User;
use Mockery\MockInterface;
use Tests\Traits\TestTeacherTrait;
use App\Services\Teacher\TeacherService;
use Tests\TestCaseWithTransLationsSetUp;

class TeacherControllerTest extends TestCaseWithTransLationsSetUp
{
    use TestTeacherTrait;


    public function setUp() : void
    {
        parent::setUp();
        
        $this->refreshApplicationWithLocale('en');
    }


    public function test_index_opens_without_errors()
    {
        $res = $this->call('get', route('admin.teacher.index'));

        $res->assertOk();
    }

    /**
     * @test
     * @dataProvider storeValidationProvider
     */
    public function test_store_validations($data)
    {
        $res = $this->call('POST', route('admin.teacher.store'), $data);

        $res->assertSessionHasErrors();
    }

    public function test_store_pass_with_all_data()
    {
        $this->mock(TeacherService::class, function (MockInterface $mock) {
            $mock->shouldReceive('createTeacher')->once();
        });

        $data = $this->generateRandomTeacherData();

        $res = $this->call('POST', route('admin.teacher.store'), $data);

        $res->assertSessionHasNoErrors();
    }

    /**
     * @dataProvider storeValidationProvider
     */
    public function test_update_validations($data)
    {
        $teacher = $this->generateRandomTeacher();

        $res = $this->call('PUT', route('admin.teacher.update', $teacher->id), $data);

        $res->assertSessionHasErrors();
    }

    public function test_update_works_with_all_data()
    {
        $teacher = $this->generateRandomTeacher();

        $this->mock(TeacherService::class, function (MockInterface $mock) {
            $mock->shouldReceive('updateTeacher')->once();
        });

        $data = $this->generateRandomTeacherData();

        $res = $this->call('PUT', route('admin.teacher.update', $teacher->id), $data);
        
        $res->assertSessionHasNoErrors();
    }

    public function test_teacher_get_deleted_without_errors()
    {
        $teacher = $this->generateRandomTeacher();

        $this->mock(TeacherService::class, function(MockInterface $mock){
            $mock->shouldReceive('deleteTeacher')->once();
        });

        $res = $this->call('get', route('admin.teacher.delete', $teacher->id));

        $res->assertSessionHasNoErrors();
    }

    public function test_get_teacher_show_data_ajax()
    {
        $teacher = $this->generateRandomTeacher();

        $res = $this->call('get', route('admin.teacher.getTeacherShowDataAjax', $teacher->id));

        $res->assertSessionHasNoErrors();
        $res->assertOk();
    }


    public function storeValidationProvider(): array
    {
        $this->refreshApplication();

        return [
            "without data" => [
                [],
            ],
            "without a name" => [
                [
                    'name'          => null,
                    'birthday'      => fake()->date(),
                    'phone'         => fake()->phoneNumber(),
                    'avatar'        => fake()->name(),
                    'qualification' => fake()->text(),
                    'role' => fake()->randomElement(getSeededRoles())['name']
                ],
            ],
            "without a birthday" => [
                [
                    'name'          => fake()->name,
                    'birthday'      => null,
                    'phone'         => fake()->phoneNumber(),
                    'avatar'        => fake()->name(),
                    'qualification' => fake()->text(),
                    'role' => fake()->randomElement(getSeededRoles())['name']
                ],
            ],
            "without a phone" => [
                [
                    'name'          => fake()->name,
                    'birthday'      => fake()->date(),
                    'phone'         => null,
                    'avatar'        => fake()->name(),
                    'qualification' => fake()->text(),
                    'role' => fake()->randomElement(getSeededRoles())['name']
                ],
            ],
            "If (avatar) its type is a number" => [
                [
                    'name'          => fake()->name,
                    'birthday'      => fake()->date(),
                    'phone'         => fake()->phoneNumber(),
                    'avatar'        => 0,
                    'qualification' => fake()->text(),
                    'role' => fake()->randomElement(getSeededRoles())['name']
                ],
            ],
            "if (avatar) its type is not [jpeg, png, jpg, gif, svg, or webp]" => [
                [
                    'name'          => fake()->name,
                    'birthday'      => fake()->date(),
                    'phone'         => fake()->phoneNumber(),
                    'avatar'        => 'string',
                    'qualification' => fake()->text(),
                    'role' => fake()->randomElement(getSeededRoles())['name']
                ],
            ],
            "without qualification" => [
                [
                    'name'          => fake()->name,
                    'birthday'      => fake()->date(),
                    'phone'         => fake()->phoneNumber(),
                    'avatar'        => fake()->name(),
                    'qualification' => null,
                    'role' => fake()->randomElement(getSeededRoles())['name']
                ],
            ],
            "without a role" => [
                [
                    'name'          => fake()->name,
                    'birthday'      => fake()->date(),
                    'phone'         => fake()->phoneNumber(),
                    'avatar'        => fake()->name(),
                    'qualification' => null,
                    'role' => null
                ],
            ],

            "with a wrong role" => [
                [
                    'name'          => fake()->name,
                    'birthday'      => fake()->date(),
                    'phone'         => fake()->phoneNumber(),
                    'avatar'        => fake()->name(),
                    'qualification' => null,
                    'role' => "this is a wrong role"
                ],
            ],

        ];
    }
}
