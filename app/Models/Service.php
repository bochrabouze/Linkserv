<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $primaryKey = 'service_id';


    protected $fillable = [
        'servant_id',
        'application_id',
        'Description',
        'Date',
        'Wage',
        'State',
    ];
}


