<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class AdminAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $guard = Filament::auth();
        $role = $guard->user()->role;

        if ($guard->check() && $role !== 'admin') {
            $guard->logout();
            Notification::make()
                ->danger()
                ->title('Access Denied')
                ->body("You do not have permission to access this area because you are a {$role}.")
                ->persistent()
                ->send();
            return redirect('/admin');
        }

        return $next($request);
    }
}
