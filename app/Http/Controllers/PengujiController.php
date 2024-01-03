<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penguji;
use Illuminate\Support\Facades\File;

class PengujiController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data penguji',
            'data_penguji' => penguji::all(),
        );

        return view('master.penguji.list', $data);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('nama_file')) {
            $filefile = $request->file('nama_file');
            $filename = $filefile->hashName();
            $filefile->move(public_path('/penyimpanan/penguji'), $filename);
        }
        penguji::create([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'tanggal' => $request->tanggal,
            'no_sk' => $request->no_sk,
            'nama_file' => $filename
        ]);

        return redirect('/penguji')->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $data = penguji::find($id);

        // Check if a new file has been uploaded
        if ($request->hasFile('nama_file')) {
            $filefile = $request->file('nama_file');
            $filename = $filefile->hashName();
            $filefile->move(public_path('/penyimpanan/penguji'), $filename);

            // Delete the old file
            File::delete(public_path('/penyimpanan/penguji') . '/' . $data->nama_file);
        } else {
            // If no new file, use the existing file name
            $filename = $data->nama_file;
        }

        // Update the record
        penguji::where('id', $id)->update([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'tanggal' => $request->tanggal,
            'no_sk' => $request->no_sk,
            'nama_file' => $filename
        ]);

        return redirect('/penguji')->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $data = penguji::where('id', $id)->first();
        File::delete(public_path('/penyimpanan/penguji') . '/' . $data->nama_file);
        penguji::where('id', $id)->delete();
        return redirect('/penguji')->with('success', 'Data berhasil disimpan');
    }
}
