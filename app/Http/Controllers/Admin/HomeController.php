<?php

namespace App\Http\Controllers\Admin;

class HomeController extends BaseController
{
    public function index()
    {
        return view('admin.pages.index');
    }

    public function email()
    {
        return view('admin.pages.email');
    }
}
