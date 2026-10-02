<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller {
    private function staff() { return User::where('store_id', auth()->user()->store_id)->where('role', 'karyawan'); }
    public function index() { return view('staff', ['staff' => $this->staff()->orderBy('name')->get()]); }
    public function store(Request $r) {
        $d = $r->validate(['name' => 'required|string|max:60', 'email' => 'required|email|unique:users,email', 'password' => 'required|min:6'],
            ['required' => 'Semua kolom wajib diisi.', 'email.unique' => 'Email ini sudah terdaftar.', 'min' => 'Kata sandi minimal 6 karakter.']);
        User::forceCreate(['name' => $d['name'], 'email' => $d['email'], 'password' => Hash::make($d['password']),
            'role' => 'karyawan', 'store_id' => $r->user()->store_id]);
        return back();
    }
    public function destroy(int $id) { $this->staff()->findOrFail($id)->delete(); return back(); }
}
