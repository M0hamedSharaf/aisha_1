<?php

namespace App\Http\Controllers;

use App\DataTables\ElementorDataTable;
use App\Http\Requests\Elementor\StoreElementorRequest;
use App\Http\Requests\Elementor\UpdateElementorRequest;
use App\Models\Elementor;
use App\Services\Elementor\ElementorService;
use App\Services\ImageService;
use App\Services\Permission\PermissionService;
use RealRashid\SweetAlert\Facades\Alert;

class ElementorController extends Controller
{

    private $permissionService;
    private $elementorDataTable;
    private $imageService;
    private $elementorService;

    public function __construct(
        PermissionService $permissionService,
        ElementorDataTable $elementorDataTable,
        ImageService $imageService,
        ElementorService $elementorService
    ) {
        $this->permissionService = $permissionService;
        $this->elementorDataTable = $elementorDataTable;
        $this->imageService = $imageService;
        $this->elementorService = $elementorService;

        $this->permissionService->handlePermissions($this, [
            'index' => 'index-elementor',
            'store' => 'store-elementor',
            'update' => 'update-elementor',
            'delete' => 'delete-elementor',
        ]);
    }

    public function index()
    {
        return $this->elementorDataTable->render('pages.elementor.index');
    }

    public function store(StoreElementorRequest $request)
    {
        $img = $this->imageService->uploadImage(imageObject: $request->file('img'), path: Elementor::IMG_PATH);

        Elementor::create([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ],
            'desc' => [
                'en' => $request->desc_en,
                'ar' => $request->desc_ar,
            ],
            'img' => $img
        ]);

        $this->elementorService->setElementorsRedis();

        Alert::toast('تمت العملية بنجاح', 'success');
        return redirect()->back();
    }

    public function update(UpdateElementorRequest $request, Elementor $elementor)
    {
        $img = $elementor->getRawOriginal('img');

        if ($request->file('img')) {
            $this->imageService->deleteImage(path: $elementor->getImgPath());

            $img = $this->imageService->uploadImage(
                imageObject: $request->file('img'),
                path: Elementor::IMG_PATH
            );
        }
        $elementor->update([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ],
            'desc' => [
                'en' => $request->desc_en,
                'ar' => $request->desc_ar,
            ],
            'img' => $img
        ]);

        $this->elementorService->setElementorsRedis();

        Alert::toast('تمت العملية بنجاح', 'success');
        return redirect()->back();
    }

    public function delete(Elementor $elementor)
    {
        $this->imageService->deleteImage(path: $elementor->getImgPath());
        $elementor->delete();

        Alert::toast('تمت العملية بنجاح', 'success');
        return redirect()->back();
    }
}
