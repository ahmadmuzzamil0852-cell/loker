<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // DATA USER
    private $users = [

        [
            'email' => 'admin@gmail.com',
            'password' => '123',
            'role' => 'admin'
        ],

        [
            'email' => 'user@gmail.com',
            'password' => '123',
            'role' => 'user'
        ]

    ];

    // =========================
    // FORM LOGIN
    // =========================
    public function formLogin()
    {
        return view('auth.login');
    }

    // =========================
    // PROSES LOGIN
    // =========================
    public function login(Request $request)
    {
        foreach ($this->users as $user) {

            // CEK EMAIL & PASSWORD
            if(
                $request->email == $user['email']
                &&
                $request->password == $user['password']
            ) {

                // SIMPAN SESSION LOGIN
                session([

                    'login' => true,

                    'role' => $user['role'],

                    'email' => $user['email']

                ]);

                // LOGIN ADMIN
                if($user['role'] == 'admin') {

                    return redirect('/admin/produk')->with(
                        'success',
                        'Login admin berhasil'
                    );
                }

                // LOGIN USER
                return redirect('/')->with(
                    'success',
                    'Login user berhasil'
                );
            }
        }

        // LOGIN GAGAL
        return back()->with(
            'error',
            'Email atau password salah'
        );
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout()
    {
        // HAPUS LOGIN SAJA
        session()->forget('login');

        session()->forget('role');

        session()->forget('email');

        return redirect('/login')->with(
            'success',
            'Logout berhasil'
        );
    }
}