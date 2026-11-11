<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sesi Anda telah berakhir, silakan masuk kembali.'
                ], 401);
            }
            return redirect()->route('login')->with('error', 'Silakan masuk terlebih dahulu untuk mengakses menu ini.');
        }

        $user = Auth::user();

        // If no specific roles supplied, just allow authenticated user
        if (empty($roles)) {
            return $next($request);
        }

        // Parse comma separated roles if passed as string e.g. "admin,ketua"
        $allowedRoles = [];
        foreach ($roles as $roleGroup) {
            foreach (explode(',', $roleGroup) as $r) {
                $allowedRoles[] = trim($r);
            }
        }

        if (!$user->hasRole($allowedRoles)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akses ditolak: Anda tidak memiliki izin untuk tindakan ini.'
                ], 403);
            }

            return redirect()->route('admin.dashboard')->with('error', 'Akses dibatasi: Modul ini hanya dapat diakses oleh peran (' . implode(', ', array_map('ucfirst', $allowedRoles)) . '). Jabatan Anda saat ini adalah ' . $user->jabatan . '.');
        }

        return $next($request);
    }
}

