<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    protected $fillable = ['name','email','phone','massage'];
    public function ConactMessage(): BelongsTo{
        return $this->belongsTo(ContactMessage::class);
    }

    

}