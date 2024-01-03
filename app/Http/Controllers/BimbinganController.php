<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bimbingan;
use Illuminate\Support\Facades\File;

class BimbinganController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data bimbingan',
            'data_bimbingan' => bimbingan::all(),
        );

        return view('master.bimbingan.list', $data);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('nama_file')) {
            $filefile = $request->file('nama_file');
            $filename = $filefile->hashName();
            $filefile->move(public_path('/penyimpanan/bimbingan'), $filename);
        }
        bimbingan::create([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'tanggal' => $request->tanggal,
            'no_sk' => $request->no_sk,
            'nama_file' => $filename
        ]);

        return redirect('/bimbingan')->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $data = bimbingan::find($id);

        // Check if a new file has been uploaded
        if ($request->hasFile('nama_file')) {
            $filefile = $request->file('nama_file');
            $filename = $filefile->hashName();
            $filefile->move(public_path('/penyimpanan/bimbingan'), $filename);

            // Delete the old file
            File::delete(public_path('/penyimpanan/bimbingan') . '/' . $data->nama_file);
        } else {
            // If no new file, use the existing file name
            $filename = $data->nama_file;
        }

        // Update the record
        bimbingan::where('id', $id)->update([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'tanggal' => $request->tanggal,
            'no_sk' => $request->no_sk,
            'nama_file' => $filename
        ]);

        return redirect('/bimbingan')->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $data = bimbingan::where('id', $id)->first();
        File::delete(public_path('/penyimpanan/bimbingan') . '/' . $data->nama_file);
        bimbingan::where('id', $id)->delete();
        return redirect('/bimbingan')->with('success', 'Data berhasil disimpan');
    }
}
