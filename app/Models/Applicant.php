<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;
    protected $primaryKey = 'applicant_id';


    protected $fillable = [
        'user_id' ,
        'Profession',
        'Description',
    ];


}
