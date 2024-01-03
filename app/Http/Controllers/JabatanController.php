<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jabatan;
use Illuminate\Support\Facades\File;

class JabatanController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data jabatan',
            'data_jabatan' => jabatan::all(),
        );

        return view('master.jabatan.list', $data);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('nama_file')) {
            $filefile = $request->file('nama_file');
            $filename = $filefile->hashName();
            $filefile->move(public_path('/penyimpanan/jabatan'), $filename);
        }
        jabatan::create([
            'jabatan' => $request->jabatan,
            'tanggal' => $request->tanggal,
            'no_sk' => $request->no_sk,
            'nama_file' => $filename
        ]);

        return redirect('/jabatan')->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $data = jabatan::find($id);

        // Check if a new file has been uploaded
        if ($request->hasFile('nama_file')) {
            $filefile = $request->file('nama_file');
            $filename = $filefile->hashName();
            $filefile->move(public_path('/penyimpanan/jabatan'), $filename);

            // Delete the old file
            File::delete(public_path('/penyimpanan/jabatan') . '/' . $data->nama_file);
        } else {
            // If no new file, use the existing file name
            $filename = $data->nama_file;
        }

        // Update the record
        jabatan::where('id', $id)->update([
            'jabatan' => $request->jabatan,
            'tanggal' => $request->tanggal,
            'no_sk' => $request->no_sk,
            'nama_file' => $filename
        ]);

        return redirect('/jabatan')->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $data = jabatan::where('id', $id)->first();
        File::delete(public_path('/penyimpanan/jabatan') . '/' . $data->nama_file);
        jabatan::where('id', $id)->delete();
        return redirect('/jabatan')->with('success', 'Data berhasil disimpan');
    }
}
