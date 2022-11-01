<?php

namespace App\Http\Controllers;

use App\Models\Elektronik;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class ElektronikController extends Controller
{
    public function create()
    {
        return view('create', ["karyawans" => Karyawan::all()]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_barang' => 'required|string|max:100',
            'harga' => 'required|string|max:100',
            'jenis' => 'required|string|max:100',
            'karyawan_id' => 'required'

        ]);

        Elektronik::create($validateData);

        return redirect('/')->with('success', 'Data  berhasil ditambah');
    }

    public function show(Elektronik $id)
    {
        return view('show', [
            'title' => 'Elektronik',
            'elektronik' => $id
        ]);
    }
    public function edit(Elektronik $id)
    {
        return view('edit', [
            'title' => 'Elektronik',
            'elektronik' => $id,
            'karyawans' => Karyawan::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $elektronik = Elektronik::findOrFail($id);
        $validateData = $request->validate([
            'nama_barang' => 'required|string|max:100',
            'harga' => 'required|string|max:100',
            'jenis' => 'required|string|max:100',
            'karyawan_id' => 'required'
        ]);

        $elektronik->update($validateData);

        return redirect('/')->with('success', 'Data berhasil diedit');
    }

    public function destroy($id)
    {
        $elektronik = Elektronik::findOrFail($id);
        $elektronik->delete();
        return redirect('/')->with('success', 'Data berhasil dihapus');
    }
}
