<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Login;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class LogController extends Controller
{
    public function __invoke(): Factory|View|Application
    {
        $logins = Login::query()->with('user')->get();

        return view('admin.log', ['logins' => $logins]);
    }
}
