<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Times extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'work_leave',
        'sick',
        'id_name_site_morning',
        'begin_date_morning',
        'end_date_morning',
        'id_name_site_afternoon',
        'begin_date_afternoon',
        'end_date_afternoon',
        'more_times',
        'bowl',
        'id_user',
        'id_company',
        'done',
        'data'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function company() {
        return $this->belongsTo(Companies::class, 'id_company');
    }

    public function name_site_morning() {
        return $this->belongsTo(Name_site::class, 'id_name_site_morning');
    }

    public function name_site_afternoon() {
        return $this->belongsTo(Name_site::class, 'id_name_site_afternoon');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data' => 'object',
    ];
}
