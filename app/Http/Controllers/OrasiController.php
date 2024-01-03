<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orasi;
use Illuminate\Support\Facades\File;

class OrasiController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data orasi',
            'data_orasi' => orasi::all(),
        );

        return view('master.orasi.list', $data);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('nama_file')) {
            $filefile = $request->file('nama_file');
            $filename = $filefile->hashName();
            $filefile->move(public_path('/penyimpanan/orasi'), $filename);
        }
        orasi::create([
            'keg_orasi' => $request->keg_orasi,
            'nama_file' => $filename
        ]);

        return redirect('/orasi')->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $data = orasi::find($id);

        // Check if a new file has been uploaded
        if ($request->hasFile('nama_file')) {
            $filefile = $request->file('nama_file');
            $filename = $filefile->hashName();
            $filefile->move(public_path('/penyimpanan/orasi'), $filename);

            // Delete the old file
            File::delete(public_path('/penyimpanan/orasi') . '/' . $data->nama_file);
        } else {
            // If no new file, use the existing file name
            $filename = $data->nama_file;
        }

        // Update the record
        orasi::where('id', $id)->update([
            'keg_orasi' => $request->keg_orasi,
            'nama_file' => $filename
        ]);

        return redirect('/orasi')->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $data = orasi::where('id', $id)->first();
        File::delete(public_path('/penyimpanan/orasi') . '/' . $data->nama_file);
        orasi::where('id', $id)->delete();
        return redirect('/orasi')->with('success', 'Data berhasil disimpan');
    }
}
