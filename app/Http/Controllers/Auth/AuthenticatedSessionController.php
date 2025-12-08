<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Student;

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan halaman login Breeze
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => \Route::has('password.request'), // HARUS BOOLEAN
            'status' => session('status'),
        ]);
    }

    /**
     * LOGIN ADMIN / SISWA OTOMATIS
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $input = $request->email;

        /**
         * ================================
         * BERSIHKAN SEMUA SESSION SEBELUM LOGIN
         * ================================
         */
        Auth::guard('web')->logout();
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        /**
         * ================================
         * LOGIN SISWA (INPUT NISN NUMERIC)
         * ================================
         */
        if (is_numeric($input)) {

            $student = Student::where('nisn', $input)->first();

            if (!$student || !Hash::check($request->password, $student->password)) {
                return back()->withErrors(['email' => 'NISN atau password salah']);
            }

            Auth::guard('student')->login($student);

            $request->session()->regenerate();
            return redirect()->route('student.dashboard');
        }

        /**
         * ================================
         * LOGIN ADMIN (INPUT EMAIL)
         * ================================
         */
        if (!Auth::guard('web')->attempt([
            'email' => $input,
            'password' => $request->password
        ])) {
            return back()->withErrors(['email' => 'Email atau password salah']);
        }

        $request->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }

    /**
     * LOGOUT ADMIN & SISWA
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('student')->logout();
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
