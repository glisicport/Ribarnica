<?php

// app/Models/ContactInfo.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'phone_label',
        'phone_value',
        'email_label',
        'email_value',
        'hours_label',
        'hours_value',
    ];
}
