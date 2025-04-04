<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TeacherAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('filament.teacherPanel.auth.login');
        }

        $user = Filament::auth()->user();

        if ($user->role !== 'teacher' || !$user->teacher) {
            Auth::logout();
            return redirect()
                ->route('filament.teacherPanel.auth.login')
                ->with('error', 'You must be a teacher to access this area.');
        }

        return $next($request);
    }
}
