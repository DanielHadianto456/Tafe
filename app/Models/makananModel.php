<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\restoranModel;

class makananModel extends Model
{
    use HasFactory;
    protected $table = 'makanan', $primaryKey = 'id_makanan';
    public $timestamps = false, $fillable = [
        'nama_makanan', 'harga_makanan', 'id_restoran'
    ];

    public function restoran(){
        return $this->belongsTo(restoranModel::class, 'id_restoran', 'id_restoran');
    }

    // public function restoranAsal1(){
    //     return $this->belongsTo(restoranModel::class, 'id_restoran');
    // }
}
