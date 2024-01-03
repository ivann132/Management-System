<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perkuliahan;
use Illuminate\Support\Facades\File;

class perkuliahancontroller extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data perkuliahan',
            'data_perkuliahan' => Perkuliahan::all(),
        );

        return view('master.perkuliahan.list', $data);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('nama_file')) {
            $filefile = $request->file('nama_file');
            $filename = $filefile->hashName();
            $filefile->move(public_path('/penyimpanan/perkuliahan'), $filename);
        }
        Perkuliahan::create([
            'mata_Kuliah' => $request->mata_Kuliah,
            'semester' => $request->semester,
            'sks' => $request->sks,
            'no_sk' => $request->no_sk,
            'nama_file' => $filename
        ]);

        return redirect('/perkuliahan')->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $data = Perkuliahan::find($id);

        // Check if a new file has been uploaded
        if ($request->hasFile('nama_file')) {
            $filefile = $request->file('nama_file');
            $filename = $filefile->hashName();
            $filefile->move(public_path('/penyimpanan/perkuliahan'), $filename);

            // Delete the old file
            File::delete(public_path('/penyimpanan/perkuliahan') . '/' . $data->nama_file);
        } else {
            // If no new file, use the existing file name
            $filename = $data->nama_file;
        }

        // Update the record
        Perkuliahan::where('id', $id)->update([
            'mata_Kuliah' => $request->mata_Kuliah,
            'semester' => $request->semester,
            'sks' => $request->sks,
            'no_sk' => $request->no_sk,
            'nama_file' => $filename
        ]);

        return redirect('/perkuliahan')->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $data = Perkuliahan::where('id', $id)->first();
        File::delete(public_path('/penyimpanan/perkuliahan') . '/' . $data->nama_file);
        Perkuliahan::where('id', $id)->delete();
        return redirect('/perkuliahan')->with('success', 'Data berhasil disimpan');
    }
}
