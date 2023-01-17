<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('userPanel.auth.login');
    }

    public function registerPage()
    {
        return view('userPanel.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $createdUser = User::store($validated);
        if ($createdUser) {
            auth()->login($createdUser);
            return redirect(route("cabinet.main"));
        }
    }

    public function login(LoginRequest $request)
    {
        $confirmed = auth()->attempt([
            'username' => $request->username,
            'password' => $request->password,
        ]);
        if ($confirmed) {
            auth()->user();
            return redirect()->route('cabinet.main');
        }
        return back();
    }

    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("index");
    }
}
