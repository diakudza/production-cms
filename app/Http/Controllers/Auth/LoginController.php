<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request)
    {
        if (!Auth::attempt([
            'tabNumber' => $request->validated('tabNumber'),
            'password' => $request->validated('password')
        ])) {
            return back()->withErrors('success', 'Не верные данные!');
        } else {
            $request->session()->regenerate();
            return redirect()->intended()->with('success', 'Вы вошли!');
        }


    }
}
