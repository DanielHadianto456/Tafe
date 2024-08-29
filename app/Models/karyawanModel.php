<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class karyawanModel extends Model
{
    use HasFactory;
    protected $table = 'user_karyawan', $primaryKey = 'id_user_karyawan';
    public $timestamps = false, $fillable = [
        'nama', 'username', 'password', 'email', 'status'
    ];
}
