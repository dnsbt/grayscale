<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminNav;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends AdminPageController
{
    public function index()
    {
        return view('admin.pages.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate(['name' => 'required|string', 'password' => 'required|string']);
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route(AdminNav::ADMIN_DASHBOARD);
        }

        return redirect()->route('admin_login');
    }
}
