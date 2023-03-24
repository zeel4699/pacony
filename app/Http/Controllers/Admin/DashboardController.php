<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use App\Models\Admin\Page;
use App\Models\Admin\Service;
use App\Models\Admin\Software;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieving models for Landing Site
        $blogs_count = Blog::all()->count();
        $services_count = Service::all()->count();
        $software_count = Software::all()->count();
        $pages_count = Page::all()->count();

        return view('admin.dashboard', compact('blogs_count',
            'services_count', 'software_count', 'pages_count'));

    }

}
