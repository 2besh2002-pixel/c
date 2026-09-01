<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Specialty extends Model
{
    protected $connection = 'business';

    protected $table = 'bs_specialties';

    protected $fillable = [

        'office_type',

        'name_ar',

        'name_en',

        'is_active',

    ];

    protected $casts = [

        'is_active' => 'boolean',

    ];

    /*
    |--------------------------------------------------------------------------
    | Offices
    |--------------------------------------------------------------------------
    */

    public function offices(): BelongsToMany
    {
        return $this->belongsToMany(
            Office::class,
            'bs_office_specialties',
            'specialty_id',
            'office_id'
        );
    }
}