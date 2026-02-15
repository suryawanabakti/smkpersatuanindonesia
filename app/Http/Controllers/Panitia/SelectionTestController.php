<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\SelectionTest;
use Illuminate\Http\Request;

class SelectionTestController extends Controller
{
    public function index()
    {
        $this->authorize('manage selection tests');
        $tests = SelectionTest::latest()->paginate(10);
        return view('panitia.tests.index', compact('tests'));
    }

    public function create()
    {
        $this->authorize('manage selection tests');
        return view('panitia.tests.create');
    }

    public function store(Request $request)
    {
        $this->authorize('manage selection tests');
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:mengaji,wawancara',
            'description' => 'nullable|string',
        ]);

        SelectionTest::create($request->all());

        return redirect()->route('panitia.tests.index')->with('success', 'Tes seleksi berhasil ditambahkan');
    }

    public function edit(SelectionTest $test)
    {
        $this->authorize('manage selection tests');
        return view('panitia.tests.edit', compact('test'));
    }

    public function update(Request $request, SelectionTest $test)
    {
        $this->authorize('manage selection tests');
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:mengaji,wawancara',
            'description' => 'nullable|string',
        ]);

        $test->update($request->all());

        return redirect()->route('panitia.tests.index')->with('success', 'Tes seleksi berhasil diperbarui');
    }

    public function destroy(SelectionTest $test)
    {
        $this->authorize('manage selection tests');
        $test->delete();
        return redirect()->route('panitia.tests.index')->with('success', 'Tes seleksi berhasil dihapus');
    }
}
