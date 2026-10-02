<?php
namespace App\Http\Controllers;
use App\Models\{Store, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};

class AuthController extends Controller {
    public function form() { return view('login'); }
    public function login(Request $r) {
        $c = $r->validate(['email' => 'required|email', 'password' => 'required']);
        if (Auth::attempt($c)) { $r->session()->regenerate(); return redirect('/ringkasan'); }
        return back()->withErrors(['email' => 'Email atau kata sandi salah.'])->onlyInput('email');
    }
    public function registerForm() { return view('register'); }
    public function register(Request $r) {
        $d = $r->validate([
            'store_name' => 'required|string|max:80', 'name' => 'required|string|max:60',
            'email' => 'required|email|unique:users,email', 'password' => 'required|min:6|confirmed',
        ], ['required' => 'Semua kolom wajib diisi.', 'email.unique' => 'Email ini sudah terdaftar.',
            'email' => 'Format email belum benar.', 'min' => 'Kata sandi minimal 6 karakter.', 'confirmed' => 'Konfirmasi kata sandi tidak sama.']);
        $store = Store::create(['name' => $d['store_name']]);
        $u = User::forceCreate(['name' => $d['name'], 'email' => $d['email'], 'password' => Hash::make($d['password']),
            'role' => 'pemilik', 'store_id' => $store->id]);
        Auth::login($u); $r->session()->regenerate();
        return redirect('/ringkasan');
    }
    public function logout(Request $r) {
        Auth::logout(); $r->session()->invalidate(); $r->session()->regenerateToken();
        return redirect('/');
    }
}
