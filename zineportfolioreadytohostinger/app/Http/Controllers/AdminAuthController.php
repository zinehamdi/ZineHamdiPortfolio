<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('username', $data['username'])->first();
        if (!$admin || !Hash::check($data['password'], $admin->password)) {
            return back()->withErrors(['auth' => __('Invalid credentials')])->withInput();
        }

        $request->session()->put('admin_id', $admin->id);
        $request->session()->put('admin_username', $admin->username);

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['admin_id', 'admin_username']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
