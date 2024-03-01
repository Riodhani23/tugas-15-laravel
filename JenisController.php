<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenis;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //DI GUNAKAN UNTUK MENAMPILKAN DATA JENIS
        $j = Jenis::all();
        if (isset($j)) {
            $sukses = [
                'success' => true,
                'message' => 'List of Jenis',
                'data' => $j
            ];
            return response()->json($sukses, 200);
        } else {
            $gagal = [
                'success' => false,
                'message' => 'Data Jenis Tidak Ditemukan',
                'data' => $j
            ];
            return response()->json($gagal, 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Di gunakan untuk menambahkan data jenis baru
        $data = [
            'nama' => 'required',
        ];

        $validator = Validator::make($request->all(), $data);

        if ($validator->fails()) {
            $fails = [
                'message' => 'Data Tidak Valid',
                'data' => $validator->errors()
            ];
            return response()->json($fails, 400);
        } else {
            $j = new Jenis;
            $j->nama = $request->input('nama');
            $j->save();
            $sukses = [
                'success' => true,
                'message' => 'Data Jenis Berhasil Ditambahkan',
                'data' => $j
            ];
            return response()->json($sukses, 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Di gunakan untuk mengupdate data jenis
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);

        if ($validator->fails()) {
            $fails = [
                'message' => 'Data Tidak Valid',
                'data' => $validator->errors()
            ];
            return response()->json($fails, 400);
        }

        $j = Jenis::find($id);
        if ($j) {
            $j->update($request->all());
            $success = [
                'success' => true,
                'message' => 'Data Jenis Berhasil Diupdate',
                'data' => $j
            ];
            return response()->json($success, 200);
        } else {
            $fails = [
                'success' => false,
                'message' => 'Data Jenis Tidak Ditemukan',
                'data' => $j
            ];
            return response()->json($fails, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Digunakan untuk menghapus data jenis
        $j = Jenis::where('id', $id)->first();
        if (isset($j)) {
            $j->delete();
            $success = [
                'success' => true,
                'message' => 'Data Jenis Berhasil dihapus',
                'data' => $j
            ];
            return response()->json($success, 200);
        } else {
            $fails = [
                'success' => false,
                'message' => 'Data Jenis Tidak Ditemukan',
                'data' => []
            ];
            return response()->json($fails, 404);
        }
    }
}
