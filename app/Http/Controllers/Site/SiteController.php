<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\Elementor\ElementorService;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    private $elementorService;

    public function __construct(ElementorService $elementorService)
    {
        $this->elementorService = $elementorService;
    }
    public function index()
    {
        $elementors = $this->elementorService->getElementorsRedis();
        return view('site.home.index', [
            'elementors' => $elementors
        ]);
    }

    public function about()
    {
        return view('site.about.index');
    }

    public function courses()
    {
        return view('site.courses.index');
    }

    public function pricing()
    {
        return view('site.pricing.index');
    }
}
