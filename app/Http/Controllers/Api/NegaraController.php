<?php

namespace App\Http\Controllers\Api;

// Import model Negara
use App\Models\Negara;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import resource NegaraResource
use App\Http\Resources\NegaraResource;

// Import facade Validator
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

class NegaraController extends Controller
{
  // Fungsi index untuk mendapatkan semua data negara
  public function index()
  {
    // Mendapatkan semua data negara dari tabel 'negara' menggunakan query builder
    $negara =  DB::table('negara')->get(); // Diperbaiki dengan menambahkan ->get()

    // Mengembalikan data negara dalam bentuk resource collection
    return new NegaraResource(true, 'List Data Negara', $negara);
  }

  // Fungsi store untuk menambahkan data negara baru
  public function store(Request $request)
  {
    // Mendefinisikan aturan validasi untuk input data
    $validator = Validator::make($request->all(), [
      'id_kawasan' => 'required|exists:kawasan,id_kawasan', // Memastikan 'id_kawasan' wajib diisi dan ada di tabel 'kawasan'
      'id_direktorat' => 'required|exists:direktorat,id_direktorat', // Memastikan 'id_direktorat' wajib diisi dan ada di tabel 'direktorat'
      'nama_negara' => 'required|string|max:100', // Memastikan 'nama_negara' wajib diisi, berupa string, dan maksimal 100 karakter
      'kode_negara' => 'required|string|max:2,' // Memastikan 'kode_negara' wajib diisi, berupa string, dan maksimal 2 karakter
    ]);

    // Mengecek apakah validasi gagal
    if ($validator->fails()) {
      // Jika validasi gagal, mengembalikan response berupa error dalam format JSON dengan status code 422
      return response()->json($validator->errors(), 422);
    }

    // Jika validasi berhasil, memasukkan data negara baru ke dalam tabel 'negara'
    $negara = DB::table('negara')->insert([
      'id_kawasan'    => $request->id_kawasan, // Mengisi kolom 'id_kawasan' dengan data dari request
      'id_direktorat' => $request->id_direktorat, // Mengisi kolom 'id_direktorat' dengan data dari request
      'nama_negara'   => $request->nama_negara, // Mengisi kolom 'nama_negara' dengan data dari request
      'kode_negara'   => $request->kode_negara, // Mengisi kolom 'kode_negara' dengan data dari request
      'created_at'    => now(), // Mengisi kolom 'created_at' dengan timestamp saat ini
      'updated_at'    => now(), // Mengisi kolom 'updated_at' dengan timestamp saat ini
    ]);

    // Mengembalikan response sukses dalam bentuk resource dengan pesan berhasil
    return new NegaraResource(true, 'Data Negara Berhasil Ditambahkan!', $negara);
  }

  public function show($id)
  {
    // Mencari data negara berdasarkan ID
    $negara = DB::table('negara')->where('id_negara', $id)->first();

    // Jika data negara tidak ditemukan, kembalikan response error
    if (!$negara) {
      return response()->json([
        'success' => false,
        'message' => 'Data Negara Tidak Ditemukan!',
      ], 404);
    }

    // Mengembalikan data negara dalam bentuk resource
    return new NegaraResource(true, 'Detail Data Negara!', $negara);
  }

  public function destroy($id)
  {
    // Mencari negara berdasarkan ID menggunakan Query Builder
    $negara = DB::table('negara')->where('id_negara', $id)->first();

    // Jika data negara tidak ditemukan, kembalikan response error
    if (!$negara) {
      return response()->json([
        'success' => false,
        'message' => 'Data Negara Tidak Ditemukan!',
      ], 404);
    }

    // Hapus data negara
    DB::table('negara')->where('id_negara', $id)->delete();

    // Mengembalikan response sukses setelah penghapusan
    return new NegaraResource(true, 'Data Negara Berhasil Dihapus!', null);
  }
}
