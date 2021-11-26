<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tale extends Model
{
    use HasFactory;

    protected $table = 'tales';

    protected $fillable = [
        'title',
        'is_enable',
        'body'
    ];

}
