<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cartDetailModel extends Model
{
    use HasFactory;
    protected $table = 'detail_cart', $primaryKey = 'id_detail_cart';
    public $timestamps = false, $fillable = [
        'id_cart', 'id_makanan', 'qty'
    ];

    public function cart(){
        return $this->belongsTo(cartModel::class, 'id_cart', 'id_cart');
    }

    public function makanan(){
        return $this->belongsTo(makananModel::class, 'id_makanan', 'id_makanan');
    }
    
}
