<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorities extends Model
{
    use HasFactory;
    protected $primaryKey = 'favorite_id';
    protected $fillable = [
        'favorite_name',
        'favorite_description',
    ];

}
