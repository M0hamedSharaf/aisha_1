<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subject\StoreSubjectRequest;
use App\Http\Requests\Subject\UpdateSubjectRequest;
use App\Http\Traits\AuthTrait;
use App\Jobs\BreakPDFIntoImagesJob;
use App\Models\Subject;
use App\Services\ImageService;
use App\Services\PDFService;
use App\Services\Permission\PermissionService;
use App\Services\Subject\SubjectService;
use RealRashid\SweetAlert\Facades\Alert;

class SubjectController extends Controller
{
    private ImageService $imageService;
    private PDFService $PDFService;
    private SubjectService $subjectService;
    private PermissionService $permissionService;
    

    public function __construct(
        ImageService $imageService,
        PDFService   $PDFService,
        SubjectService   $subjectService,
        PermissionService $permissionService
    )
    {
        $this->imageService = $imageService;
        $this->PDFService = $PDFService;
        $this->subjectService = $subjectService;
        $this->permissionService = $permissionService;


        $this->permissionService->handlePermissions($this,[
            'index' => 'index-subject',
            'create' => 'create-subject',
            'store' => 'store-subject',
            'edit' => 'edit-subject',
            'update' => 'update-subject',
            'delete' => 'delete-subject',
        ]);
    }


    public function index()
    {
        $subjects = Subject::get();

        return view('pages.subject.index', [
            'subjects' => $subjects
        ]);
    }

    public function create()
    {
        return view('pages.subject.create');
    }

    public function store(StoreSubjectRequest $request)
    {
        $fileName = $this->imageService->uploadImage(
            imageObject: $request->file('avatar'),
            path: Subject::AVATARS_PATH
        );

        $book_name = $this->PDFService->uploadPdfFile(
            $request->file('book'),
            $request->name,
            'subjects',
            null,
            'book'
        );

        $subject = $this->subjectService->createSubject($request,$book_name,$fileName);

        // BreakPDFIntoImagesJob::dispatch($this->PDFService, $subject);

        Alert::toast('تمت العملية بنجاح', 'success');
        return redirect(route('admin.subject.index'));
    }

    public function edit(Subject $subject)
    {
        return view('pages.subject.edit', [
            'subject' => $subject
        ]);
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $fileName = $subject->getRawOriginal('avatar');

        if ($request->file('avatar')) {

            $this->imageService->deleteImage(
                path: $subject->getAvatarPath()
            );

            $fileName = $this->imageService->uploadImage(
                imageObject: $request->file('avatar'),
                path: Subject::AVATARS_PATH
            );
        }

        if ($book = $request->file('book')) {
            $this->PDFService->deleteFile($subject->book);

            // $this->PDFService->deleteDirectory($subject->directoryName());

            $book_name = $this->PDFService->uploadPdfFile(
                $book,
                $request->name,
                'subjects',
                null,
                'book'
            );
        } else {
            $book_name = $request->name . "_book" . "." . "pdf";

            if (file_exists(public_path($subject->book))) {
               
                $this->subjectService->convertedSubjectBookToBookName($subject->book,$book_name);
                // $this->subjectService->switchSubjectNameToRequetName($subject->name,$request->name);
            }
        }

        $this->subjectService->updateSubject($subject,$request,$book_name,$fileName);

        // BreakPDFIntoImagesJob::dispatch($this->PDFService, $subject);

        Alert::toast('تمت العملية بنجاح', 'success');
        return redirect(route('admin.subject.index'));
    }

    public function delete(Subject $subject)
    {
        $this->imageService->deleteImage(
            path: $subject->getAvatarPath()
        );
        $this->PDFService->deleteFile($subject->book);
        // $this->PDFService->deleteDirectory($subject->directoryName());

        $subject->delete();

        Alert::toast('تمت العملية بنجاح', 'success');
        return redirect()->back();
    }
}
