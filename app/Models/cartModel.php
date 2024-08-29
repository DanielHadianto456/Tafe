<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cartModel extends Model
{
    use HasFactory;
    protected $table = 'cart', $primaryKey = 'id_cart';
    public $timestamps = true, $fillable = [
        'id_user',
        'id_meja',
        'status',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function meja()
    {
        return $this->belongsTo(mejaModel::class, 'id_meja', 'id_meja');
    }

    public function cartDetails()
    {
        return $this->hasMany(cartDetailModel::class, 'id_cart', 'id_cart');
    }
}
