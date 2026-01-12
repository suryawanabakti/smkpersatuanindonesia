<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\SppInformation;
use Illuminate\Http\Request;

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

        SppInformation::create($request->all());

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

        return redirect()->route('panitia.spp.index')->with('success', 'Informasi SPP berhasil diperbarui.');
    }

    public function destroy(SppInformation $spp)
    {
        $spp->delete();
        return redirect()->route('panitia.spp.index')->with('success', 'Informasi SPP berhasil dihapus.');
    }
}
