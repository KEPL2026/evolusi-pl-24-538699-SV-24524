<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Handle login POST
     */
    public function login(Request $request)
    {
        try {
            $login = $request->input('login') ?? $request->input('username') ?? $request->input('email');
            $password = $request->input('password');

            $validator = Validator::make([
                'login' => $login,
                'password' => $password,
            ], [
                'login' => 'required|string',
                'password' => 'required|string',
            ], [
                'login.required' => 'Username atau email wajib diisi.',
                'password.required' => 'Password wajib diisi.',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            $credentials = [
                $field => $login,
                'password' => $password,
            ];

            if (Auth::attempt($credentials, $request->filled('remember'))) {
                $request->session()->regenerate();

                return redirect()->intended('dashboard');
            }

            return back()->withErrors([
                'form' => 'Username/email atau password salah.',
            ])->withInput();
        } catch (Exception $e) {
            return back()->withErrors(['form' => 'Gagal login.'])->withInput();
        }
    }

    /**
     * Show register form
     */
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }

        return view('auth.register');
    }

    /**
     * Handle register POST
     */
    public function register(Request $request)
    {
        try {
            $data = $request->validate([
                'username' => 'required|string|max:255|unique:users,username',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
            ], [
                'username.required' => 'Username wajib diisi.',
                'username.unique' => 'Username sudah digunakan.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal 8 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            ]);

            $user = User::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);

            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return back()->withErrors(['form' => 'Gagal mendaftar: '.$e->getMessage().', Silahkan coba lagi'])->withInput();
        }
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
