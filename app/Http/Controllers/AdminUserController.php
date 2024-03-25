<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Pekerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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
        $cekKepsek = User::where('role', 4)->first();

        return view('admin.user.tambah', [
            "title" => "Tambah Data Pengguna",
            "part" => "pengguna",
            "pegawai" => $pegawai_available,
            "kepsek" => $cekKepsek
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
            'username' => 'required|unique:users|alpha_dash',
            'role' => 'required',
            'pegawai_id' => 'required|unique:users',
            'password' => 'required|min:6'
        ]);

        $validatedData['dec_password'] = encrypt($validatedData['password']);
        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['last_seen'] = (new \DateTime())->format("Y-m-d H:i:s");

        $pekerja = Pekerja::where('id', $request->pegawai_id)->first();

        $validatedData['email'] = $pekerja->email;

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
        if ($user->role == 4) {
            $jabatan = 'Kepala Sekolah';
        } elseif ($user->role == 2) {
            $jabatan = 'Guru';
        } else {
            $jabatan = 'Staf Tata Usaha';
        }
        $selected_pegawai = User::all()->where('id', $user->id)->pluck('pegawai_id');
        $pegawai_not_available = User::all()->whereNotNull('pegawai_id')->whereNotIn('pegawai_id', $selected_pegawai)->pluck('pegawai_id');
        $pegawai_available = Pekerja::all()->where('jabatan', $jabatan)->whereNotIn('id', $pegawai_not_available)->all();
        $cekKepsek = User::where('role', 4)->first();

        return view('admin.user.edit', [
            'title' => "Edit Data Pengguna",
            'part' => "pengguna",
            'pengguna' => $user,
            'pegawai' => $pegawai_available,
            'kepsek' => $cekKepsek
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
            $rules['username'] = 'required|unique:users|alpha_dash';
        } else {
            $rules['username'] = 'required|alpha_dash';
        }

        if ($request->pegawai_id != $user->pegawai_id) {
            $rules['pegawai_id'] = 'required|unique:users';

            $pekerja = Pekerja::where('id', $request->pegawai_id)->first();
            $validatedData['email'] = $pekerja->email;
        } else {
            $rules['pegawai_id'] = 'required';
        }

        if ($request->password) {
            $rules['password'] = 'required|min:6';
        }

        $validatedData = $request->validate($rules);

        $pekerja = Pekerja::where('id', $request->pegawai_id)->first();
        $validatedData['email'] = $pekerja->email;

        if ($request->password) {
            $validatedData['dec_password'] = encrypt($validatedData['password']);
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        // dd($validatedData);
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
        if (Cache::has('user-is-online-' . $user->id)) {
            return redirect('/pengguna')->with('fail', "Data pengguna aktif tidak bisa dihapus!");
        } else {
            User::destroy($user->id);

            return redirect('/pengguna')->with('success', "Data $user->username berhasil dihapus!");
        }
    }

    public function getPegawai(Request $request) {
        $pegawai_id_not_available = User::all()->pluck('pegawai_id')->toArray();
        if ($request->role_id == 4) {
            $jabatan = 'Kepala Sekolah';
        } elseif ($request->role_id == 2) {
            $jabatan = 'Guru';
        } else {
            $jabatan = 'Staf Tata Usaha';
        }
        $pegawai = Pekerja::all()->where('jabatan', $jabatan)->whereNotIn('id', $pegawai_id_not_available)->all();
        $data = [
            "pegawai" => $pegawai,
        ];

        return view('admin.user.partials.pegawai-list', $data);
    }

    public function isAdmin(Request $request) {
        $admin = User::getAdmin();
        $status = decrypt($admin->dec_password) == $request->password;

        return response()->json([
            "status" => $status
        ]);
    }
}
