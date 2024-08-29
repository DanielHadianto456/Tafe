<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ratingModel;

class ratingDetailModel extends Model
{
    use HasFactory;

    protected $table = 'detail_rating', $primaryKey = 'id_detail_rating';
    public $timestamps = false, $fillable = [
        'id_rating', 'skor'
    ];

    public function rating(){
        return $this->belongsTo(ratingModel::class, 'id_rating', 'id_rating');
    }

}
