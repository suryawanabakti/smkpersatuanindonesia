<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function loginActivity()
    {
        $users = User::whereNotNull('last_login_at')
            ->orderBy('last_login_at', 'desc')
            ->paginate(20);

        return view('reports.login_activity', compact('users'));
    }
}
