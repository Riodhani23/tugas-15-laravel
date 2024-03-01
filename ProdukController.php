<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // DIGUNAKAN UNTUK MENAMPILKAN DATA PRODUK
        $p = Produk::all();
        if (isset($p)) {
            $sukses = [
                'success' => true,
                'message' => 'List of Produk',
                'data' => $p
            ];
            return response()->json($sukses, 200);
        } else {
            $gagal = [
                'success' => false,
                'message' => 'Data Produk Tidak Ditemukan',
                'data' => $p
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
        // Di gunakan untuk menambahkan data produk baru
        $data = [
            'nama' => 'required',
            'stok' => 'required',
            'harga' =>  'required|integer',
            'idjns' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $data);

        if ($validator->fails()) {
            $fails = [
                'message' => 'Data Tidak Valid',
                'data' => $validator->errors()
            ];
            return response()->json($fails, 422);
        } else {
            $p = new Produk;
            $p->nama = $request->nama;
            $p->stok = $request->stok;
            $p->harga = $request->harga;
            $p->idjns = $request->idjns;
            $p->save();
            $success = [
                'success' => true,
                'message' => 'Data Produk Berhasil',
                'data' => $p
            ];
            return response()->json($success, 201);
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
        // Di gunakan untuk mengupdate data produk
        $validator = Validator::make($request->all(), [
            'nama' => 'required'|'max:65',
            'stok' => 'required',
            'harga' =>  'required|integer',
            'idjns' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $fails = [
                'message' => 'Data Tidak Valid',
                'data' => $validator->errors()
            ];
            return response()->json($fails, 422);
        }

        $p = Produk::find($id);
        if ($p) {
            $p->update($request->all());
            $success = [
                'success' => true,
                'message' => 'Data Produk Berhasil diupdate',
                'data' => $p
            ];
            return response()->json($success, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Di gunakan unntuk menghapus data produk
        $p = Produk::find($id);
        if ($p) {
            $p->delete();
            $success = [
                'success' => true,
                'message' => 'Data Produk Berhasil dihapus',
                'data' => $p
            ];
            return response()->json($success, 200);
        } else {
            $fails = [
                'success' => false,
                'message' => 'Data Produk Tidak Ditemukan',
                'data' => $p
            ];
            return response()->json($gagal, 404);
        }
    }
}
