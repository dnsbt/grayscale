<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNav;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    protected function getGeneralPageData(): array
    {
        return [
            'nav' => $this->getNav(),
            'dashboard_url' => $this->getDashboardUrl(),
        ];
    }

    private function getNav(): array
    {
        $nav = [];
        foreach (AdminNav::getNav() as $navItem) {
            $route = route($navItem['route']);
            $nav[$navItem['title']] = $route;
        }

        return $nav;
    }

    private function getDashboardUrl(): string
    {
        return route(AdminNav::ADMIN_DASHBOARD);
    }
}
