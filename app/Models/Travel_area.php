<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel_area extends Model
{
    use HasFactory;

    protected $table = 'travel_area';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'desc',
        'price',
        'id_company',
        'data'
    ];

    public function company() {
        return $this->belongsTo(Companies::class, 'id_company');
    }
}
