<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class gallery extends Model
{   
    protected $table='galerija';
    protected $fillable =['naziv_slike','opis','putanja','datum_postavljanja','kategorija_id'];

    public function ribe(){

        return $this->belongsTo(ribe::class);

    }
}
