<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    // pošto je tabela 'contact_message', a ne 'contact_messages'
    protected $table = 'contact_message';

    protected $fillable = [
        'username',
        'message',
        'comment',
    ];
}
