<?php

namespace App\Http\Controllers\Api;

use App\Models\Kader;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends BaseApiController
{
    /**
     * Login untuk Kader, Petugas, atau Warga.
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username atau NIK wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi login gagal', $validator->errors()->all(), 422);
        }

        $credential = $request->username;
        $password = $request->password;

        // 1. Cek User (Ketua / Admin / Bidan)
        $user = User::where('username', $credential)->first();
        if ($user && Hash::check($password, $user->password)) {
            $token = Str::random(60);
            return $this->sendResponse([
                'token' => $token,
                'role' => 'user',
                'user' => [
                    'id' => $user->id_user,
                    'nama' => $user->nama,
                    'username' => $user->username,
                    'jabatan' => $user->jabatan,
                ],
            ], 'Login petugas berhasil');
        }

        // 2. Cek Kader
        $kader = Kader::where('username', $credential)->first();
        if ($kader && Hash::check($password, $kader->password)) {
            $token = Str::random(60);
            return $this->sendResponse([
                'token' => $token,
                'role' => 'kader',
                'kader' => [
                    'id' => $kader->id_kader,
                    'nama_kader' => $kader->nama_kader,
                    'username' => $kader->username,
                ],
            ], 'Login kader berhasil');
        }

        // 3. Cek Warga (login menggunakan NIK)
        $warga = Warga::where('NIK', $credential)->first();
        if ($warga) {
            // Warga dapat login dengan tanggal lahir (YYYY-MM-DD atau password default)
            $validDate = ($password === $warga->tanggal_lahir || $password === 'password');
            if ($validDate) {
                $token = Str::random(60);
                return $this->sendResponse([
                    'token' => $token,
                    'role' => 'warga',
                    'warga' => [
                        'nik' => $warga->NIK,
                        'nama_lengkap' => $warga->nama_lengkap,
                        'tanggal_lahir' => $warga->tanggal_lahir,
                        'status' => $warga->status,
                        'jenis_kelamin' => $warga->jenis_kelamin,
                    ],
                ], 'Login warga berhasil');
            }
        }

        return $this->sendError('Username / NIK atau kata sandi tidak valid.', [], 401);
    }

    /**
     * Logout
     */
    public function logout(): JsonResponse
    {
        return $this->sendResponse(null, 'Berhasil keluar dari sesi mobile.');
    }
}

