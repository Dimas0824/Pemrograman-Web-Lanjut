<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)
     */
    public function handle(Request $request, Closure $next, $levelId = ''): Response
    {
        $user = $request->user(); // ambil data user yg login

        // Cek berdasarkan level_id langsung
        if ($user->level_id == $levelId) {
            return $next($request);
        }

        // jika tidak punya level yang sesuai, tampilkan error 403
        abort(403, 'Forbidden. Kamu tidak punya akses ke halaman ini');
    }
}
