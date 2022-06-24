<?php

namespace App\Http\Controllers\Admin;


class DashboardController extends AdminPageController
{
    public function index()
    {
        $generalPageData = $this->getGeneralPageData();

        return view('admin.pages.dashboard', $generalPageData);
    }
}
