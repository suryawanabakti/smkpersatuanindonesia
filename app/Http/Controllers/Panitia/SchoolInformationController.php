<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SchoolInformationController extends Controller
{
    public function edit()
    {
        $info = \App\Models\SchoolInformation::first();
        return view('panitia.school_information.edit', compact('info'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'price' => 'nullable|numeric|min:0',
        ]);

        $info = \App\Models\SchoolInformation::first();
        $info->update($request->all());

        return back()->with('success', 'Informasi sekolah berhasil diperbarui.');
    }
}
