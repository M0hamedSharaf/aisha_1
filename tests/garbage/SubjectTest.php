<?php

namespace Tests\Controller;

use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Tests\TestCase;

class SubjectTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_that_subject_store_method()
    {
        $originalFilePath = __DIR__ . "/../stub/math.pdf";
        $testingFilePath = __DIR__ . "/../stub/math2.pdf";

        copy($originalFilePath,$testingFilePath);

        $response = $this->call('POST',route('admin.subject.store'),[
            'name' => 'math',
            'book' => new UploadedFile($testingFilePath,'math2.pdf','application/pdf',null,true)
        ]);

        $response->assertSessionHasNoErrors();
        
        $this->assertTrue(File::exists(public_path('files/subjects/math_book.pdf')));
        $this->assertTrue(File::missing(public_path('files/subjects/math_book2.pdf')));

        $this->assertTrue(File::exists(public_path('files/subjects/math/')));
        $this->assertTrue(File::exists(public_path('files/subjects/math/1.jpg')));
        $this->assertTrue(File::exists(public_path('files/subjects/math/2.jpg')));
        $this->assertTrue(File::exists(public_path('files/subjects/math/3.jpg')));
        $this->assertTrue(File::exists(public_path('files/subjects/math/4.jpg')));

        unlink(public_path('files/subjects/math_book.pdf'));
        $this->assertTrue(File::missing(public_path('files/subjects/math_book.pdf')));

        File::deleteDirectory(public_path('files/subjects/math/'));
        $this->assertTrue(File::missing(public_path('files/subjects/math/')));
        $this->assertTrue(File::missing(public_path('files/subjects/math/1.jpg')));
        $this->assertTrue(File::missing(public_path('files/subjects/math/2.jpg')));
        $this->assertTrue(File::missing(public_path('files/subjects/math/3.jpg')));
        $this->assertTrue(File::missing(public_path('files/subjects/math/4.jpg')));
    }


    public function test_that_subject_update_method_without_sending_file()
    {
        $originalFilePath = __DIR__ . "/../stub/math.pdf";
        $testingFilePath = public_path('files/subjects/' . 'math_book.pdf');

        File::makeDirectory(public_path('files/subjects/math/'), 0777, true, true);

        copy($originalFilePath,$testingFilePath);

        copy(__DIR__ . "/../stub/1.jpg", public_path('files/subjects/math/1.jpg'));
        copy(__DIR__ . "/../stub/2.jpg", public_path('files/subjects/math/2.jpg'));
        copy(__DIR__ . "/../stub/3.jpg", public_path('files/subjects/math/3.jpg'));
        copy(__DIR__ . "/../stub/4.jpg", public_path('files/subjects/math/4.jpg'));

        $subject = Subject::factory()->create([
            'name' => 'math',
            'book' => 'math_book.pdf'
        ]);
        
        $response = $this->call('PUT',route('admin.subject.update',$subject->id),[
            'name' => 'calculus',
        ]);

        $response->assertSessionHasNoErrors();

        $this->assertTrue(File::exists(public_path('files/subjects/calculus_book.pdf')));
        $this->assertTrue(File::missing(public_path('files/subjects/math_book.pdf')));

        $this->assertTrue(File::exists(public_path('files/subjects/calculus/')));
        $this->assertTrue(File::exists(public_path('files/subjects/calculus/1.jpg')));
        $this->assertTrue(File::exists(public_path('files/subjects/calculus/2.jpg')));
        $this->assertTrue(File::exists(public_path('files/subjects/calculus/3.jpg')));
        $this->assertTrue(File::exists(public_path('files/subjects/calculus/4.jpg')));

        unlink(public_path('files/subjects/calculus_book.pdf'));
        $this->assertTrue(File::missing(public_path('files/subjects/calculus_book.pdf')));

        File::deleteDirectory(public_path('files/subjects/calculus/'));
        $this->assertTrue(File::missing(public_path('files/subjects/calculus/')));
        $this->assertTrue(File::missing(public_path('files/subjects/calculus/1.jpg')));
        $this->assertTrue(File::missing(public_path('files/subjects/calculus/2.jpg')));
        $this->assertTrue(File::missing(public_path('files/subjects/calculus/3.jpg')));
        $this->assertTrue(File::missing(public_path('files/subjects/calculus/4.jpg')));
    }


    public function test_that_subject_update_method_with_sending_file()
    {
        $originalFilePath = __DIR__ . "/../stub/math5.pdf";
        $testingFilePathBeforeUpdate = public_path('files/subjects/' . 'math2_book.pdf');
        $originalFilePathForUpload = __DIR__ . "/../stub/math3.pdf";
        $testingFilePathForUpload = __DIR__ . "/../stub/math4.pdf";

        File::makeDirectory(public_path('files/subjects/math2/'), 0777, true, true);

        copy($originalFilePath,$testingFilePathBeforeUpdate);
        copy($originalFilePathForUpload,$testingFilePathForUpload);

        copy(__DIR__ . "/../stub/1.jpg", public_path('files/subjects/math2/1.jpg'));
        copy(__DIR__ . "/../stub/2.jpg", public_path('files/subjects/math2/2.jpg'));
        copy(__DIR__ . "/../stub/3.jpg", public_path('files/subjects/math2/3.jpg'));
        copy(__DIR__ . "/../stub/4.jpg", public_path('files/subjects/math2/4.jpg'));

        $subject = Subject::factory()->create([
            'name' => 'math2',
            'book' => 'math2_book.pdf'
        ]);
        
        $response = $this->call('PUT',route('admin.subject.update',$subject->id),[
            'name' => 'calculus2',
            'book' => new UploadedFile($testingFilePathForUpload,'math4.pdf','application/pdf',null,true)
        ]);

        $response->assertSessionHasNoErrors();

        $this->assertTrue(File::exists(public_path('files/subjects/calculus2_book.pdf')));
        $this->assertTrue(File::missing(public_path('files/subjects/math2_book.pdf')));

        $this->assertTrue(File::exists(public_path('files/subjects/calculus2/')));
        $this->assertTrue(File::exists(public_path('files/subjects/calculus2/1.jpg')));
        $this->assertTrue(File::exists(public_path('files/subjects/calculus2/2.jpg')));
        $this->assertTrue(File::exists(public_path('files/subjects/calculus2/3.jpg')));
        $this->assertTrue(File::exists(public_path('files/subjects/calculus2/4.jpg')));

        unlink(public_path('files/subjects/calculus2_book.pdf'));
        $this->assertTrue(File::missing(public_path('files/subjects/calculus2_book.pdf')));

        File::deleteDirectory(public_path('files/subjects/calculus2/'));
        $this->assertTrue(File::missing(public_path('files/subjects/calculus2/')));
        $this->assertTrue(File::missing(public_path('files/subjects/calculus2/1.jpg')));
        $this->assertTrue(File::missing(public_path('files/subjects/calculus2/2.jpg')));
        $this->assertTrue(File::missing(public_path('files/subjects/calculus2/3.jpg')));
        $this->assertTrue(File::missing(public_path('files/subjects/calculus2/4.jpg')));


        $this->assertTrue(File::missing(public_path('files/subjects/math2/')));
        $this->assertTrue(File::missing(public_path('files/subjects/math2/1.jpg')));
        $this->assertTrue(File::missing(public_path('files/subjects/math2/2.jpg')));
        $this->assertTrue(File::missing(public_path('files/subjects/math2/3.jpg')));
        $this->assertTrue(File::missing(public_path('files/subjects/math2/4.jpg')));
    }


    public function test_subject_delete_method()
    {
        $originalFilePath = __DIR__ . "/../stub/math5.pdf";
        $testingFilePath = public_path('files/subjects/' . 'math6_book.pdf');

        File::makeDirectory(public_path('files/subjects/math6/'), 0777, true, true);

        copy($originalFilePath,$testingFilePath);

        copy(__DIR__ . "/../stub/1.jpg", public_path('files/subjects/math6/1.jpg'));
        copy(__DIR__ . "/../stub/2.jpg", public_path('files/subjects/math6/2.jpg'));
        copy(__DIR__ . "/../stub/3.jpg", public_path('files/subjects/math6/3.jpg'));
        copy(__DIR__ . "/../stub/4.jpg", public_path('files/subjects/math6/4.jpg'));

        $subject = Subject::factory()->create([
            'name' => 'math6',
            'book' => 'math6_book.pdf'
        ]);
        
        $response = $this->call('GET',route('admin.subject.delete',$subject->id));

        $response->assertSessionHasNoErrors();

        $this->assertTrue(File::missing(public_path('files/subjects/math6_book.pdf')));

        $this->assertTrue(File::missing(public_path('files/subjects/math6/')));
        $this->assertTrue(File::missing(public_path('files/subjects/math6/1.jpg')));
        $this->assertTrue(File::missing(public_path('files/subjects/math6/2.jpg')));
        $this->assertTrue(File::missing(public_path('files/subjects/math6/3.jpg')));
        $this->assertTrue(File::missing(public_path('files/subjects/math6/4.jpg')));
    }
}
