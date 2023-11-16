<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'desc',
        'url_logo',
        'url_website',
        'siret',
        'address',
        'address2',
        'zip_code',
        'city',
        'id_country',
        'primary_color',
        'secondary_color',
        'data'
    ];

    public function country() {
        return $this->belongsTo(Countries::class, 'id_country');
    }
}
