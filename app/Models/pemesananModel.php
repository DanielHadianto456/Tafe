<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemesananModel extends Model
{
    use HasFactory;
    protected $table = 'pemesanan_makanan', $primaryKey = 'id_pemesanan_makanan';
    public $timestamps = false, $fillable = [
        'id_user', 'id_makanan', 'qty', 'status_makanan'
    ];
}
