<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Redirigir según el rol del usuario
            return $this->redirectBasedOnRole();
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function redirectBasedOnRole()
    {
        $user = Auth::user();

        if ($user->user_type_id == 1) { // admin
            return redirect()->route('admin.index');
        } elseif ($user->user_type_id == 2) { // jefe
            return redirect()->route('jefe.index');
        } elseif ($user->user_type_id == 3) { // secretaria
            return redirect()->route('secretaria.index');
        } elseif ($user->user_type_id == 4) { // especialista
            return redirect()->route('especialista.index');
        }

        return redirect('/'); // default fallback
    }
}