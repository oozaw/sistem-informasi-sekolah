<?php

namespace App\Http\Controllers;

use App\Models\Pekerja;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.user.index', [
            "title" => "Data Pengguna",
            "part" => "pengguna",
            "pengguna" => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $pegawai_not_available = User::all()->whereNotNull('pegawai_id')->pluck('pegawai_id');
        $pegawai_available = Pekerja::all()->whereNotIn('id', $pegawai_not_available)->all();

        return view('admin.user.tambah', [
            "title" => "Tambah Data Pengguna",
            "part" => "pengguna",
            "pegawai" => $pegawai_available
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'username' => 'required|unique:users',
            'role' => 'required',
            'pegawai_id' => 'required|unique:users',
            'password' => 'required|min:6'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['last_seen'] = (new \DateTime())->format("Y-m-d H:i:s");

        User::create($validatedData);

        return redirect('/pengguna')->with('success', 'Data pengguna baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        return view('admin.user.detail', [
            'title' => 'Detail Pengguna',
            'part' => 'pengguna',
            'pengguna' => $user,
            'profil' => Pekerja::where('id', $user->pegawai_id)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        $selected_pegawai = User::all()->where('id', $user->id)->pluck('pegawai_id');
        $pegawai_not_available = User::all()->whereNotNull('pegawai_id')->whereNotIn('pegawai_id', $selected_pegawai)->pluck('pegawai_id');
        $pegawai_available = Pekerja::all()->whereNotIn('id', $pegawai_not_available)->all();

        return view('admin.user.edit', [
            'title' => "Edit Data Pengguna",
            'part' => "pengguna",
            'pengguna' => $user,
            'pegawai' => $pegawai_available
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {
        $rules = ['role' => 'required'];

        if ($request->username != $user->username) {
            $rules['username'] = 'required|unique:users';
        } else {
            $rules['username'] = 'required';
        }

        if ($request->pegawai_id != $user->pegawai_id) {
            $rules['pegawai_id'] = 'required|unique:users';
        } else {
            $rules['pegawai_id'] = 'required';
        }

        if ($request->password) {
            $rules['password'] = 'required|min:6';
        }

        $validatedData = $request->validate($rules);

        if ($request->password) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        User::where('id', $user->id)->update($validatedData);

        return redirect("/pengguna/$user->id")->with('success', "Data $user->username berhasil diperbarui!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        User::destroy($user->id);

        return redirect('/pengguna')->with('success', "Data $user->username berhasil dihapus!");
    }
}