<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfficeService extends Model
{
    protected $connection = 'business';
    protected $table      = 'bs_office_services';

    protected $fillable = [
        'office_id', 'name_ar', 'name_en',
        'description_ar', 'description_en',
        'price', 'duration', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'price'     => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id');
    }
}