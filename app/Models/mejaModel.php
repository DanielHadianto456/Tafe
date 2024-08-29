<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mejaModel extends Model
{
    use HasFactory;
    protected $table = 'meja', $primaryKey = 'id_meja';
    public $timestamps = true, $fillable = [
        'status', 'id_restoran'
    ];

    public function restoran(){
        return $this->belongsTo(restoranModel::class, 'id_restoran', 'id_restoran');
    }
}
