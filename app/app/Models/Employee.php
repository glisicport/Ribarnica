<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [ 'name', 'last_name', 'position', 'bio', 'photo' ];

    public function about_us () {
        return $this->hasOne(about_us::class);
    }
}
