<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mascota;
use App\Models\Dueno;
use App\Models\Consulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index(){
        return view("modules/auth/login");
    }

    public function logear(Request $request) {
        $credenciales = [
            'email'    => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credenciales)) {
            $role = Auth::user()->role;

            if ($role === 'administrador') {
                return to_route('admin.home');
            }

            return to_route('home');
        } else {
            return back()->withErrors(['email' => 'Credenciales incorrectas.'])->onlyInput('email');
        }
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return to_route('login');
    }

    public function home() {
        $vet = Auth::user()->veterinario;

        $totalMascotas   = Mascota::count();
        $totalDuenos     = Dueno::count();
        $consultasHoy    = $vet
            ? Consulta::where('veterinario_id', $vet->id)->whereDate('fecha_consulta', today())->count()
            : 0;
        $actividadReciente = $vet
            ? Consulta::with('mascota.dueno')
                ->where('veterinario_id', $vet->id)
                ->latest('fecha_consulta')
                ->take(5)
                ->get()
            : collect();

        return view('modules/dashboard/home', compact(
            'totalMascotas', 'totalDuenos', 'consultasHoy', 'actividadReciente'
        ));
    }

    public function adminHome() {
        return view('modules/admin/dashboard');
    }
}
