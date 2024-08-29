<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\restoranModel;

class ratingModel extends Model
{
    use HasFactory;

    protected $table = 'rating', $primaryKey = 'id_rating';
    public $timestamps = false, $fillable = [
        'id_restoran', 'id_user'
    ];

    public function restoran(){
        return $this->belongsTo(restoranModel::class, 'id_restoran', 'id_restoran');
    }

    public function user(){
        return $this->belongstO(User::class, 'id_user', 'id_user');
    }
}
