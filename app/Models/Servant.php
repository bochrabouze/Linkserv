<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servant extends Model
{
    use HasFactory;
    protected $primaryKey = 'servant_id';


    protected $fillable = [
        'user_id',
        'Profession',
        'Description',
    ];
}
