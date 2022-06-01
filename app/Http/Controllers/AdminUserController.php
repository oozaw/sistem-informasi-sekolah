<?php

namespace App\Http\Controllers;

use App\Models\Pekerja;
use App\Models\User;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        //
    }
}