<?php

namespace App\Models;

use App\Models\Pekerja;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Config;

class User extends Authenticatable implements CanResetPassword {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'username',
    //     'role',
    //     'password',
    //     'last_seen',
    //     'pegawai_id'
    // ];
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pegawai() {
        return $this->belongsTo(Pekerja::class, 'pegawai_id');
    }

    public static function updateEnv($key, $newValue) {
        $path = base_path('.env');
        $oldValue = env($key);

        // rewrite file content with changed data
        if (file_exists($path)) {
            // replace current value with new value 
            file_put_contents(
                $path,
                str_replace(
                    "$key='$oldValue'",
                    "$key='$newValue'",
                    file_get_contents($path)
                )
            );
        }
    }

    public static function updateConfigUser($nama, $role, $foto) {
        Config::set('user.nama', $nama);
        Config::set('user.role', $role);
        Config::set('user.foto', $foto);
    }

    public static function getAdmin() {
        return User::where('role', 1)->first();
    }
}