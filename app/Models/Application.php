<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $primaryKey = 'application_id';


    protected $fillable = [
        'applicant_id',
        'Description' ,
        'Categorie',
        'Date' ,
        'Wage' ,
        'Workers' ,
        'State' => "Finished",
    ];
}

