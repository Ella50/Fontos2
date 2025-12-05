<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategoria;

class Ingatlan extends Model
{
    public $table = 'ingatlanok';
    public $timestamps = false;

    /*protected $fillable = [
        'kategoria',
        'tehermentes',
        'ar',
    ]; //kötelező mezők*/

    public $guarded = []; //nem kötelező mezők


    public function kategoria()
    {
        return $this->belongsTo(Kategoria::class, 'kategoria');
    }
}
