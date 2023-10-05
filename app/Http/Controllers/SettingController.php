<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\ImageService;
use App\Services\Permission\PermissionService;
use App\Services\Setting\SettingService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    private $imageService;
    private $settingService;
    private $permissionService;

    public function __construct(ImageService $imageService, SettingService $settingService, PermissionService $permissionService)
    {
        $this->imageService = $imageService;
        $this->settingService = $settingService;
        $this->permissionService = $permissionService;

        $this->permissionService->handlePermissions($this, [
            'index' => 'index-setting',
            'store' => 'store-setting',
        ]);
    }

    public function index()
    {
        $setting = $this->settingService->getSettingRedis();
        return view('pages.setting.index', [
            'setting' => $setting
        ]);
    }

    public function store(Request $request,Setting $setting)
    {
        $logo = $setting->getRawOriginal('logo');
        $welcome_img = $setting->getRawOriginal('welcome_img');

        if ($request->file('logo')) {
            $this->imageService->deleteImage(path: $setting->getLogoPath());

            $logo = $this->imageService->uploadImage(
                imageObject: $request->file('logo'),
                path: Setting::LOGO_PATH
            );
        }
        
        if ($request->file('welcome_img')) {
            $this->imageService->deleteImage(path: $setting->getWelcomeImagePath());

            $welcome_img = $this->imageService->uploadImage(
                imageObject: $request->file('welcome_img'),
                path: Setting::WELCOME_IMAGE_PATH
            );
        }

        $setting->update([
            'logo' => $logo,
            'welcome_text_1' => [
                'en' => $request->welcome_text_1_en,
                'ar' => $request->welcome_text_1_ar,
            ],
            'welcome_text_2' => [
                'en' => $request->welcome_text_2_en,
                'ar' => $request->welcome_text_2_ar,
            ],
            'welcome_btn_1' => [
                'en' => $request->welcome_btn_1_en,
                'ar' => $request->welcome_btn_1_ar,
            ],
            'welcome_btn_2' => [
                'en' => $request->welcome_btn_2_en,
                'ar' => $request->welcome_btn_2_ar,
            ],
            'welcome_img' => $welcome_img,
        ]);

        $this->settingService->setSettingRedis();

        Alert::toast('تمت العملية بنجاح', 'success');
        return redirect()->back();
    }
}
