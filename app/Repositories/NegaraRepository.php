<?php

namespace App\Repositories;

use App\Http\Requests\NegaraRequest;
use App\Interfaces\NegaraInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\NegaraResource;

class NegaraRepository implements NegaraInterface
{
  public function getAllNegara()
  {
    try {
      // Mendapatkan semua data negara dengan join ke tabel direktorat dan kawasan
      $negara = DB::table('negara')
        ->join('direktorat', 'negara.id_direktorat', '=', 'direktorat.id_direktorat')
        ->join('kawasan', 'negara.id_kawasan', '=', 'kawasan.id_kawasan')
        ->select(
          'negara.id_negara as id',
          'negara.nama_negara as country_name',
          'negara.created_at',
          'direktorat.id_direktorat as direktorat_id',
          'direktorat.nama_direktorat',
          'kawasan.id_kawasan as region_id',
          'kawasan.nama_kawasan'
        )
        ->get();

      // Membentuk struktur JSON untuk setiap negara
      $result = $negara->map(function ($item) {
        return [
          'id' => $item->id,
          'country_name' => $item->country_name,
          'created_at' => $item->created_at,
          'direktorat' => [
            'id' => $item->direktorat_id,
            'nama_direktorat' => $item->nama_direktorat,
          ],
          'region' => [
            'id' => $item->region_id,
            'nama_kawasan' => $item->nama_kawasan,
          ],
        ];
      });

      // Mengembalikan data dalam format JSON
      return response()->json($result);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage()
      ], 500);
    }
  }

  public function getById($id)
  {
    try {
      // Mencari data negara berdasarkan ID dengan join ke tabel direktorat dan kawasan
      $negara = DB::table('negara')
        ->join('direktorat', 'negara.id_direktorat', '=', 'direktorat.id_direktorat')
        ->join('kawasan', 'negara.id_kawasan', '=', 'kawasan.id_kawasan')
        ->select(
          'negara.id_negara as id',
          'negara.nama_negara as country_name',
          'negara.created_at',
          'direktorat.id_direktorat as direktorat_id',
          'direktorat.nama_direktorat',
          'kawasan.id_kawasan as region_id',
          'kawasan.nama_kawasan'
        )
        ->where('negara.id_negara', $id)
        ->first();

      // Memeriksa apakah data negara ditemukan
      if (!$negara) {
        return response()->json([
          'success' => false,
          'message' => 'Negara tidak ditemukan'
        ], 404);
      }

      // Membentuk struktur JSON sesuai dengan yang diinginkan
      $result = [
        'id' => $negara->id,
        'country_name' => $negara->country_name,
        'created_at' => $negara->created_at,
        'direktorat' => [
          'id' => $negara->direktorat_id,
          'nama_direktorat' => $negara->nama_direktorat
        ],
        'region' => [
          'id' => $negara->region_id,
          'nama_kawasan' => $negara->nama_kawasan
        ]
      ];

      // Mengembalikan data dalam format JSON
      return response()->json($result);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage()
      ], 500);
    }
  }

  public function create(NegaraRequest $request)
  {
    DB::beginTransaction();
    try {
      // Memasukkan data negara baru ke dalam tabel 'negara'
      $negara = DB::table('negara')->insertGetId([
        'id_kawasan'    => $request['id_kawasan'],
        'id_direktorat' => $request['id_direktorat'],
        'nama_negara'   => $request['nama_negara'],
        'kode_negara'   => $request['kode_negara'],
        'created_at'    => now(),
        'updated_at'    => now(),
      ]);

      DB::commit();
      // Mengambil kembali data negara yang baru dibuat untuk ditampilkan dalam response
      $newNegara = DB::table('negara')->where('id_negara', $negara)->first();
      return new NegaraResource(true, "Berhasil menambahkan negara", $newNegara);
    } catch (\Exception $e) {
      DB::rollBack();
      return new NegaraResource(false, $e->getMessage(), null);
    }
  }

  public function delete($id)
  {
    DB::beginTransaction();
    try {
      // Mencari negara berdasarkan ID menggunakan Query Builder
      $negara = DB::table('negara')->where('id_negara', $id)->first();

      // Jika data negara tidak ditemukan, kembalikan response error
      if (!$negara) {
        return new NegaraResource(false, "Data Negara Tidak Ditemukan!", null);
      }

      // Hapus data negara
      DB::table('negara')->where('id_negara', $id)->delete();

      // Melakukan commit pada transaksi
      DB::commit();
      return new NegaraResource(true, "Negara berhasil dihapus", null);
    } catch (\Exception $e) {
      DB::rollBack();
      return new NegaraResource(false, $e->getMessage(), null);
    }
  }
}
