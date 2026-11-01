<?php

namespace App\Http\Controllers\Api;

use App\Models\InformasiUmum;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArtikelController extends BaseApiController
{
    /**
     * Menampilkan daftar artikel edukasi kesehatan posyandu.
     */
    public function index(Request $request): JsonResponse
    {
        $query = InformasiUmum::query();

        if ($request->filled('kategori')) {
            $query->where('kategori_info', $request->kategori);
        }

        if ($request->filled('search')) {
            $query->where('judul', 'like', "%{$request->search}%");
        }

        $artikels = $query->orderBy('tanggal_post', 'desc')->get();

        return $this->sendResponse($artikels, 'Daftar artikel edukasi kesehatan berhasil diambil.');
    }

    /**
     * Menampilkan detail satu artikel kesehatan.
     */
    public function show(int $id): JsonResponse
    {
        $artikel = InformasiUmum::find($id);

        if (!$artikel) {
            return $this->sendError('Artikel edukasi tidak ditemukan.', [], 404);
        }

        return $this->sendResponse($artikel, 'Detail artikel berhasil diambil.');
    }
}

