<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index(){
        return view('pointakses/user/index');
    }

    public function view(){
        $user = User::where('role', 'user')->get();
        return view('pages.admin.user.index', compact('user'));
    }

    public function edit($id)
    {
        // Terapkan middleware admin di sini
        $user = User::findOrFail($id);
        return view('pages.admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->fullname = $request->input('fullname');
        $user->email = $request->input('email');
        $user->password = $request->input('password');

        if ($request->hasFile('gambar')) {
            // Hapus gambar Lama jika ada 

            if ($user->gambar && file_exists(public_path('picture/akun/' . $user->gambar))) {
                unlink(public_path('picture/akun/' . $user->gambar));
            }
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('picture/akun/'), $imageName);
        
            // Simpan nama gambar ke dalam database
            $user->gambar = $imageName;
        }

        $user->update();
        return redirect()->route('user.index')->with('success', 'User berhasil di update.');

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->gambar && file_exists(public_path('picture/akun/' . $user->gambar))) {
            unlink(public_path('picture/akun/' . $user->gambar));
        }
        $user->delete();
        return redirect()->route('user.index')->with('success','User berhasil dihapus.');
    }
}
