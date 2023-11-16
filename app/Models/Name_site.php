<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Name_site extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'desc',
        'id_company',
        'data'
    ];
}
