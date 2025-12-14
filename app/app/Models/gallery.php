<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galerija';

    protected $fillable = [
        'naziv_slike',
        'opis',
        'putanja',
    ];
}
