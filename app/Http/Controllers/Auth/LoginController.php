<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Login;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function __invoke(LoginRequest $request): RedirectResponse
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
}
