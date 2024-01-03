<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KKN;
use Illuminate\Support\Facades\File;

class KknController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data KKN',
            'data_KKN' => KKN::all(),
        );

        return view('master.KKN.list', $data);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('nama_file')) {
            $filefile = $request->file('nama_file');
            $filename = $filefile->hashName();
            $filefile->move(public_path('/penyimpanan/KKN'), $filename);
        }
        KKN::create([
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'semester' => $request->semester,
            'no_sk' => $request->no_sk,
            'nama_file' => $filename
        ]);

        return redirect('/KKN')->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $data = KKN::find($id);

        // Check if a new file has been uploaded
        if ($request->hasFile('nama_file')) {
            $filefile = $request->file('nama_file');
            $filename = $filefile->hashName();
            $filefile->move(public_path('/penyimpanan/KKN'), $filename);

            // Delete the old file
            File::delete(public_path('/penyimpanan/KKN') . '/' . $data->nama_file);
        } else {
            // If no new file, use the existing file name
            $filename = $data->nama_file;
        }

        // Update the record
        KKN::where('id', $id)->update([
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'semester' => $request->semester,
            'no_sk' => $request->no_sk,
            'nama_file' => $filename
        ]);

        return redirect('/KKN')->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $data = KKN::where('id', $id)->first();
        File::delete(public_path('/penyimpanan/KKN') . '/' . $data->nama_file);
        KKN::where('id', $id)->delete();
        return redirect('/KKN')->with('success', 'Data berhasil disimpan');
    }
}
