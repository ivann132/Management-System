<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pengembang_pengajaran;
use Illuminate\Support\Facades\File;

class PengembangpengajaranController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data pengembang_pengajaran',
            'data_pengembang_pengajaran' => pengembang_pengajaran::all(),
        );

        return view('master.pengembang_pengajaran.list', $data);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('nama_file')) {
            $filefile = $request->file('nama_file');
            $filename = $filefile->hashName();
            $filefile->move(public_path('/penyimpanan/pengembang_pengajaran'), $filename);
        }
        pengembang_pengajaran::create([
            'produk' => $request->produk,
            'nama_file' => $filename
        ]);

        return redirect('/pengembang_pengajaran')->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $data = pengembang_pengajaran::find($id);

        // Check if a new file has been uploaded
        if ($request->hasFile('nama_file')) {
            $filefile = $request->file('nama_file');
            $filename = $filefile->hashName();
            $filefile->move(public_path('/penyimpanan/pengembang_pengajaran'), $filename);

            // Delete the old file
            File::delete(public_path('/penyimpanan/pengembang_pengajaran') . '/' . $data->nama_file);
        } else {
            // If no new file, use the existing file name
            $filename = $data->nama_file;
        }

        // Update the record
        pengembang_pengajaran::where('id', $id)->update([
            'produk' => $request->produk,
            'nama_file' => $filename
        ]);

        return redirect('/pengembang_pengajaran')->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $data = pengembang_pengajaran::where('id', $id)->first();
        File::delete(public_path('/penyimpanan/pengembang_pengajaran') . '/' . $data->nama_file);
        pengembang_pengajaran::where('id', $id)->delete();
        return redirect('/pengembang_pengajaran')->with('success', 'Data berhasil disimpan');
    }
}
