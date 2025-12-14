<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuickFact extends Model
{
    protected $fillable = [
        'text',
        'is_active',
        'order',
    ];
}
