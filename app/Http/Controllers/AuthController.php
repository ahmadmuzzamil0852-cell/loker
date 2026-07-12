<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // =========================
    // FORM LOGIN USER
    // =========================
    public function formLogin()
    {
        return view('auth.login');
    }

    // =========================
    // PROSES LOGIN USER
    // =========================
    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|string',
            ],
            [
                'email.required' => 'Email user wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'password.required' => 'Password user wajib diisi.',
            ]
        );

        $user = User::where('email', $request->email)
            ->where('role', 'user')
            ->first();

        if (
            !$user
            || !Hash::check(
                $request->password,
                $user->password
            )
        ) {
            return back()
                ->withInput($request->only('email'))
                ->with(
                    'error',
                    'Email atau password user salah'
                );
        }

        $request->session()->regenerate();

        session([
            'login' => true,
            'role' => $user->role,
            'email' => $user->email,
        ]);

        return redirect('/')->with(
            'success',
            'Login user berhasil'
        );
    }

    // =========================
    // FORM LOGIN ADMIN
    // =========================
    public function formLoginAdmin()
    {
        return view('auth.login-admin');
    }

    // =========================
    // PROSES LOGIN ADMIN
    // =========================
    public function loginAdmin(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|string',
            ],
            [
                'email.required' => 'Email admin wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'password.required' => 'Password admin wajib diisi.',
            ]
        );

        $user = User::where('email', $request->email)
            ->where('role', 'admin')
            ->first();

        if (
            !$user
            || !Hash::check(
                $request->password,
                $user->password
            )
        ) {
            return back()
                ->withInput($request->only('email'))
                ->with(
                    'error',
                    'Email atau password admin salah'
                );
        }

        $request->session()->regenerate();

        session([
            'login' => true,
            'role' => $user->role,
            'email' => $user->email,
        ]);

        return redirect('/admin/produk')->with(
            'success',
            'Login admin berhasil'
        );
    }

    // =========================
    // FORM REGISTER USER
    // =========================
    public function formRegister()
    {
        return view('auth.register');
    }

    // =========================
    // PROSES REGISTER USER
    // =========================
    public function register(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|min:3|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'name.string' => 'Nama harus berupa teks.',
                'name.min' => 'Nama minimal 3 karakter.',
                'name.max' => 'Nama maksimal 255 karakter.',

                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',

                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal 6 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak sama.',
            ]
        );

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(
                $request->password
            ),
            'role' => 'user',
        ]);

        return redirect('/login')->with(
            'success',
            'Register berhasil. Silakan login menggunakan akun Anda.'
        );
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout(Request $request)
    {
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with(
            'success',
            'Logout berhasil'
        );
    }
}