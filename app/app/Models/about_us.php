<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class about_us extends Model
{
    protected $table = "about_us";
    protected $fillable = [ 'title', 'short_description', 'long_description',  'image', 'mission','vision' ];

    // Veza: AboutUs pripada jednom zaposlenom
    public function Employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

