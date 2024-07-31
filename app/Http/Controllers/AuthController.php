<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Mail\AuthMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function index(){
        return view('pages.landing-page.auth.login');
    }
    function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email harus diisi',
            'password.required' => 'Password harus diisi',
        ]);

        $infologin = $request->only('email', 'password');

        if (Auth::attempt($infologin)) {
            $user = Auth::user();
            if ($user->email_verified_at != null) {
                if ($user->role === 'admin') {
                    return redirect()->route('admin')->with('success', 'Halo Admin, Anda berhasil login');
                } else if ($user->role === 'user') {
                    return redirect()->route('user')->with('success', 'Berhasil login');
                }
            } else {
                Auth::logout();
                return redirect()->route('auth')->withErrors('Akun anda belum aktif, Verifikasi terlebih dahulu');
            }
        } else {
            return redirect()->route('auth')->withErrors('Email atau Password salah');
        }
    }
    function create(){
        return view('pages.landing-page.auth.daftar');
    }
    function daftar(Request $request){
        $request->validate([
            'fullname' => 'required|min:5',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
            'gambar' => 'nullable|image|file',
        ], [
            'fullname.required' => 'Full Name wajib diisi',
            'fullname.min' => 'Full Name minimal 5 Karakter',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email telah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'gambar.image' => 'Gambar harus berupa gambar',
            'gambar.file' => 'Gambar harus berupa FILE',
        ]);
    
        $nama_gambar = null; // Default value for gambar
    
        if ($request->hasFile('gambar')) {
            $gambar_file = $request->file('gambar');
            $gambar_ekstensi = $gambar_file->extension();
            $nama_gambar = date('ymdhis') . "." . $gambar_ekstensi;
            $gambar_file->move(public_path('picture/akun'), $nama_gambar);
        }
    
        $str = Str::random(100);
        
        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'gambar' => $nama_gambar,
            'verify_key' => $str,
        ]);
    
        //Kode SMPT
        $details = [
            'nama' => $request->fullname,
            'role' => 'user',
            'datetime' => date('Y-m-d H:i:s'),
            'website' => 'Liga Generator',
            'url' => 'http://' . request()->getHttpHost() . "/" . "verify/" . $str,
        ];
        //Mengirim ke email
        Mail::to($request->email)->send(new AuthMail($details));
    
        return redirect()->route('auth')->with('success', 'Link verifikasi telah dikirim ke email anda. Cek email untuk melakukan verifikasi');
   
    }

    public function verify($verify_key)
    {
        $user = User::where('verify_key', $verify_key)->first();

        if ($user) {
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();

            return redirect()->route('auth')->with('success', 'Verifikasi berhasil. Akun anda sudah aktif');
        } else {
            return redirect()->route('auth')->withErrors('Key tidak valid. Pastikan telah melakukan registrasi')->withInput();
        }
    }

    function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function showForgotPasswordForm()
    {
        return view('pages.landing-page.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPasswordForm($token)
    {
        return view('pages.landing-page.auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();

                Auth::login($user);
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('user')->with('success', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function profil(){
        $user = Auth::user();
        return view('pages.landing-page.auth.profil', compact('user'));
    }

    public function edit_profil(){
        $user = Auth::user();
        return view('pages.landing-page.auth.edit_profil', compact('user'));
    }

    public function edit(Request $request)
    {
        $user = Auth::user();
    
        $request->validate([
            'fullname' => 'required|min:5',
            'gambar' => 'nullable|image|file',
        ], [
            'fullname.required' => 'Full Name wajib diisi',
            'fullname.min' => 'Full Name minimal 5 Karakter',
            'gambar.image' => 'Gambar harus berupa gambar',
            'gambar.file' => 'Gambar harus berupa FILE',
        ]);
    
        // Handle image upload if exists
        $nama_gambar = $user->gambar;
        if ($request->hasFile('gambar')) {
            $gambar_file = $request->file('gambar');
            $gambar_ekstensi = $gambar_file->extension();
            $nama_gambar = date('ymdhis') . "." . $gambar_ekstensi;
            $gambar_file->move(public_path('picture/akun'), $nama_gambar);
            // Delete old image if exists
            if ($user->gambar && file_exists(public_path('picture/akun/' . $user->gambar))) {
                unlink(public_path('picture/akun/' . $user->gambar));
            }
        }
    
        // Update user data
        $user->fullname = $request->fullname;
        $user->gambar = $nama_gambar;
        $user->save();
    
        return redirect()->route('profil.index')->with('success', 'Profil berhasil diperbarui');
    }
    
}
