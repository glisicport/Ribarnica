<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable=["username","message","comment"];
     public function Contact() {
        return $this->hasOne(Contact::class);
    }
}
