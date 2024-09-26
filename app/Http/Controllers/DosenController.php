<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;

class DosenController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data Dosen',
            'data_dosen' => Dosen::all(),
        );

        return view('master.dosen.list', $data);
    }

    public function store(Request $request)
    {
        Dosen::create([
            'nama' => $request->nama,
            'nip' => $request->nip
        ]);

        return redirect('/dashboard')->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
        ]);

        Dosen::where('id', $id)
            ->update([
                'nama' => $request->nama,
                'nip' => $request->nip,
            ]);

        return redirect('/dashboard')->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        Dosen::where('id', $id)->delete();
        return redirect('/dashboard')->with('success', 'Data berhasil disimpan');
    }
}
