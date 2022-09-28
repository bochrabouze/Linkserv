<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permis extends Model
{
    use HasFactory;
    protected $primaryKey = 'permis_id';

    public function forfaits()
    {
        return $this->hasMany(Forfait::class,'permis_id', 'permis_id');
    }

}
