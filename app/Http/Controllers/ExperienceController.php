<?php

namespace App\Http\Controllers;

use App\DataTables\ExperienceDataTable;
use App\Http\Requests\Experience\StoreExperienceRequest;
use App\Http\Requests\Experience\UpdateExperienceRequest;
use App\Models\Experience;
use App\Models\Teacher;
use App\Services\Experience\ExperienceService;
use App\Services\Permission\PermissionService;
use RealRashid\SweetAlert\Facades\Alert;

class ExperienceController extends Controller
{

    private ExperienceDataTable $experienceDataTable;
    private ExperienceService $experienceService;
    private PermissionService $permissionService;

    public function __construct(
        ExperienceDataTable $experienceDataTable,
        ExperienceService   $experienceService,
        PermissionService $permissionService
    ) {
        $this->experienceDataTable = $experienceDataTable;
        $this->experienceService = $experienceService;
        $this->permissionService = $permissionService;

        $this->permissionService->handlePermissions($this, [
            'index' => 'index-experience',
            'store' => 'store-experience',
            'update' => 'update-experience',
            'delete' => 'delete-experience',
        ]);
    }

    public function index()
    {
        $teachers = Teacher::teachers()->select([
            'id', 'name'
        ])->get();

        return $this->experienceDataTable->render('pages.experience.index', [
            'teachers' => $teachers,
        ]);
    }

    public function store(StoreExperienceRequest $request)
    {
        $this->experienceService->createExperience($request);

        Alert::toast('تمت العملية بنجاح', 'success');
        return redirect()->back();
    }

    public function update(UpdateExperienceRequest $request, Experience $experience)
    {
        $this->experienceService->updateExperience($experience, $request);

        Alert::toast('تمت العملية بنجاح', 'success');
        return redirect()->back();
    }

    public function delete(Experience $experience)
    {
        $this->experienceService->deleteExperience($experience);

        Alert::toast('تمت العملية بنجاح', 'success');
        return redirect()->back();
    }
}
