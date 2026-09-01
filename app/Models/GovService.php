<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GovService extends Model
{
    protected $connection = 'business';
    protected $table      = 'bs_services';

    protected $fillable = [
        'entity_id', 'name_ar', 'name_en', 'icon', 'price',
        'description_ar', 'description_en', 'estimated_days', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'price'          => 'decimal:2',
        'is_active'      => 'boolean',
        'estimated_days' => 'integer',
    ];

    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::class);
    }

    public function serviceRequests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class, 'service_id');
    }
}
