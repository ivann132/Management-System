<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pembina;
use Illuminate\Support\Facades\File;

class PembinaController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data pembina',
            'data_pembina' => pembina::all(),
        );

        return view('master.pembina.list', $data);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('nama_file')) {
            $filefile = $request->file('nama_file');
            $filename = $filefile->hashName();
            $filefile->move(public_path('/penyimpanan/pembina'), $filename);
        }
        pembina::create([
            'nama_penasehat' => $request->nama_penasehat,
            'tanggal' => $request->tanggal,
            'no_sk' => $request->no_sk,
            'nama_file' => $filename
        ]);

        return redirect('/pembina')->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $data = pembina::find($id);

        // Check if a new file has been uploaded
        if ($request->hasFile('nama_file')) {
            $filefile = $request->file('nama_file');
            $filename = $filefile->hashName();
            $filefile->move(public_path('/penyimpanan/pembina'), $filename);

            // Delete the old file
            File::delete(public_path('/penyimpanan/pembina') . '/' . $data->nama_file);
        } else {
            // If no new file, use the existing file name
            $filename = $data->nama_file;
        }

        // Update the record
        pembina::where('id', $id)->update([
            'nama_penasehat' => $request->nama_penasehat,
            'tanggal' => $request->tanggal,
            'no_sk' => $request->no_sk,
            'nama_file' => $filename
        ]);

        return redirect('/pembina')->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $data = pembina::where('id', $id)->first();
        File::delete(public_path('/penyimpanan/pembina') . '/' . $data->nama_file);
        pembina::where('id', $id)->delete();
        return redirect('/pembina')->with('success', 'Data berhasil disimpan');
    }
}
