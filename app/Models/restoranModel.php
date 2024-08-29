<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class restoranModel extends Model
{
    use HasFactory;
    protected $table = 'restoran', $primaryKey = 'id_restoran';
    public $timestamps = false, $fillable = [
        'nama_restoran', 'alamat_restoran', 'deskripsi', 'denah', 'jam_buka', 'jam_tutup'
    ];

    public function menu(){
        return $this->hasMany(makananModel::class, 'id_restoran', 'id_restoran');
    }

    public function meja(){
        return $this->hasMany(mejaModel::class, 'id_restoran', 'id_restoran');
    }
}
