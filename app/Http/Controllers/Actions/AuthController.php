<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->username)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['username' => 'Username atau password tidak ditemukan']);
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['username' => 'Username atau password tidak ditemukan']);
        }

        Auth::login($user);

        return redirect()->route('home');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date_of_birth' => 'required',
            'address' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:users,email'
        ]);
        $request->merge(['password' => Hash::make($request->password)]);
        User::create($request->all());

        return redirect()->route('login');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date_of_birth' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->user()->id . ',id'
        ]);

        User::where('id', $request->user()->id)->update($request->all());

        return redirect()->back()->withErrors(['name' => 'Informasi Pengguna berhasil di ubah']);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required'
        ]);


        $user = User::where('id', $request->user()->id)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['old_password' => 'Terjadi kesalahan pada saat query ke server']);
        }

        if (Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Password lama tidak sesuai']);
        }

        if (Hash::check($request->new_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Password baru tidak boleh sama dengan password lama']);
        }

        User::where('id', $request->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()->withErrors(['old_password' => 'Password berhasil di perbarui']);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout user

        $request->session()->invalidate(); // Invalidasi session
        $request->session()->regenerateToken(); // Regenerasi CSRF token untuk keamanan

        return redirect()->back();
    }
}
