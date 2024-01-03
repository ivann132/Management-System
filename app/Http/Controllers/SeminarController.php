<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seminar;
use Illuminate\Support\Facades\File;

class SeminarController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data Seminar',
            'data_Seminar' => Seminar::all(),
        );

        return view('master.Seminar.list', $data);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('nama_file')) {
            $filefile = $request->file('nama_file');
            $filename = $filefile->hashName();
            $filefile->move(public_path('/penyimpanan/Seminar'), $filename);
        }
        Seminar::create([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'tanggal' => $request->tanggal,
            'semester' => $request->semester,
            'no_seminar' => $request->no_seminar,
            'nama_file' => $filename
        ]);

        return redirect('/Seminar')->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $data = Seminar::find($id);

        // Check if a new file has been uploaded
        if ($request->hasFile('nama_file')) {
            $filefile = $request->file('nama_file');
            $filename = $filefile->hashName();
            $filefile->move(public_path('/penyimpanan/Seminar'), $filename);

            // Delete the old file
            File::delete(public_path('/penyimpanan/Seminar') . '/' . $data->nama_file);
        } else {
            // If no new file, use the existing file name
            $filename = $data->nama_file;
        }

        // Update the record
        Seminar::where('id', $id)->update([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'tanggal' => $request->tanggal,
            'semester' => $request->semester,
            'no_seminar' => $request->no_seminar,
            'nama_file' => $filename
        ]);

        return redirect('/Seminar')->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $data = Seminar::where('id', $id)->first();
        File::delete(public_path('/penyimpanan/Seminar') . '/' . $data->nama_file);
        Seminar::where('id', $id)->delete();
        return redirect('/Seminar')->with('success', 'Data berhasil disimpan');
    }
}
