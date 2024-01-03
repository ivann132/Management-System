<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pengembang_progkul;
use Illuminate\Support\Facades\File;

class PengembangprogkulController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data pengembang_progkul',
            'data_pengembang_progkul' => pengembang_progkul::all(),
        );

        return view('master.pengembang_progkul.list', $data);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('nama_file')) {
            $filefile = $request->file('nama_file');
            $filename = $filefile->hashName();
            $filefile->move(public_path('/penyimpanan/pengembang_progkul'), $filename);
        }
        pengembang_progkul::create([
            'deskripsi' => $request->deskripsi,
            'nama_file' => $filename
        ]);

        return redirect('/pengembang_progkul')->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $data = pengembang_progkul::find($id);

        // Check if a new file has been uploaded
        if ($request->hasFile('nama_file')) {
            $filefile = $request->file('nama_file');
            $filename = $filefile->hashName();
            $filefile->move(public_path('/penyimpanan/pengembang_progkul'), $filename);

            // Delete the old file
            File::delete(public_path('/penyimpanan/pengembang_progkul') . '/' . $data->nama_file);
        } else {
            // If no new file, use the existing file name
            $filename = $data->nama_file;
        }

        // Update the record
        pengembang_progkul::where('id', $id)->update([
            'deskripsi' => $request->deskripsi,
            'nama_file' => $filename
        ]);

        return redirect('/pengembang_progkul')->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $data = pengembang_progkul::where('id', $id)->first();
        File::delete(public_path('/penyimpanan/pengembang_progkul') . '/' . $data->nama_file);
        pengembang_progkul::where('id', $id)->delete();
        return redirect('/pengembang_progkul')->with('success', 'Data berhasil disimpan');
    }
}
