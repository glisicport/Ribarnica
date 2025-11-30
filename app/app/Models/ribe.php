<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ribe extends Model
{
    protected $table='ribe';
    protected $fillable = ['naziv','vrsta','tezina','cena','opis','kategorija_id'];

    public function gallery(){

        return $this->hasOne(gallery::class);
    }
}
