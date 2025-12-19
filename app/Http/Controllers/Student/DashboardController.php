<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Assuming PendaftaranSiswa is linked to User, we can get status from there if needed
        $pendaftaran = \App\Models\PendaftaranSiswa::where('user_id', $user->id)->first();

        $latestPayment = \App\Models\Payment::where('user_id', $user->id)->latest()->first();

        return view('student.dashboard', compact('user', 'pendaftaran', 'latestPayment'));
    }
}
