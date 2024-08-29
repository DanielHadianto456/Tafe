<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userModel extends Model
{
    use HasFactory;
    protected $table = 'user', $primaryKey = 'id_user';
    public $timestamps = false, $fillable = [
        'nama', 'username', 'pass', 'email', 'status'
    ];
}
