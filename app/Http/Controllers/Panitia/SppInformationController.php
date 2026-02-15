<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\SppInformation;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\ActivityNotification;

class SppInformationController extends Controller
{
    public function index()
    {
        $sppInfos = SppInformation::all();
        return view('panitia.spp.index', compact('sppInfos'));
    }

    public function create()
    {
        return view('panitia.spp.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan' => 'required|string|unique:spp_information,jurusan',
            'amount' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $sppInfo = SppInformation::create($request->all());

        User::notifyKepsek(new ActivityNotification(
            "User panitia Mengubah informasi spp: {$sppInfo->jurusan}",
            auth()->user(),
            'create'
        ));

        return redirect()->route('panitia.spp.index')->with('success', 'Informasi SPP berhasil ditambahkan.');
    }

    public function edit(SppInformation $spp)
    {
        $sppInformation = $spp;
        return view('panitia.spp.edit', compact('sppInformation'));
    }

    public function update(Request $request, SppInformation $spp)
    {
        $request->validate([
            'jurusan' => 'required|string|unique:spp_information,jurusan,' . $spp->id,
            'amount' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $spp->update($request->all());

        User::notifyKepsek(new ActivityNotification(
            "User panitia Mengubah informasi spp: {$spp->jurusan}",
            auth()->user(),
            'update'
        ));

        return redirect()->route('panitia.spp.index')->with('success', 'Informasi SPP berhasil diperbarui.');
    }

    public function destroy(SppInformation $spp)
    {
        $jurusan = $spp->jurusan;
        $spp->delete();

        User::notifyKepsek(new ActivityNotification(
            "User panitia Menghapus informasi spp: {$jurusan}",
            auth()->user(),
            'delete'
        ));

        return redirect()->route('panitia.spp.index')->with('success', 'Informasi SPP berhasil dihapus.');
    }
}
