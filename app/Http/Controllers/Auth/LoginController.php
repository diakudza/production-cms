<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Login;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginPage(Request $request): Factory|View|Application
    {
        return view('public.login');
    }
    public function login(LoginRequest $request): RedirectResponse
    {
        if (!Auth::attempt([
            'tabNumber' => $request->validated('tabNumber'),
            'password' => $request->validated('password')
        ])) {
            (new Login)->fill([
                'tabNumber' => $request->validated('tabNumber'),
                'user_agent' => $request->server('HTTP_USER_AGENT'),
                'ip' => $request->ip(),
                'success' => false
            ])->save();
            return back()->with('fail', 'Не верные данные!');
        } else {
            $request->session()->regenerate();
            \auth()->user()->logins()->create([
                'user_agent' => $request->server('HTTP_USER_AGENT'),
                'ip' => $request->ip(),
                'success' => true]);
            return redirect()->intended()->with('success', 'Вы вошли!');
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with(['success' => 'Вы вышли!']);
    }
}
