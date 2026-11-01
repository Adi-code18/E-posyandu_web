<?php

namespace App\Http\Controllers\Api;

use App\Models\BarangManajemen;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProdukController extends BaseApiController
{
    /**
     * Menampilkan daftar inventaris produk, PMT, vitamin, dan obat-obatan.
     */
    public function index(Request $request): JsonResponse
    {
        $query = BarangManajemen::query();

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', "%{$request->search}%");
        }

        $produk = $query->orderBy('nama_barang', 'asc')->get();

        return $this->sendResponse($produk, 'Daftar stok logistik dan PMT berhasil diambil.');
    }

    /**
     * Menampilkan detail satu produk inventaris.
     */
    public function show(int $id): JsonResponse
    {
        $produk = BarangManajemen::find($id);

        if (!$produk) {
            return $this->sendError('Data produk tidak ditemukan.', [], 404);
        }

        return $this->sendResponse($produk, 'Detail produk berhasil diambil.');
    }
}

