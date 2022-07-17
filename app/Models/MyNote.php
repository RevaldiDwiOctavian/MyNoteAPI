<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyNote extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'body',
        'is_public',
        'user_id',
    ];
}
