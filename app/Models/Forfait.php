<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forfait extends Model
{
    use HasFactory;
    protected $primaryKey = 'forfait_id';

    public function permis()
    {
        return $this->belongsTo(Permis::class,'permis_id', 'permis_id');
    }

}
