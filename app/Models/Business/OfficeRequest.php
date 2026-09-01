<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfficeRequest extends Model
{
    protected $connection = 'business';
    protected $table      = 'bs_office_requests';

    protected $fillable = [
        'ref_number', 'user_id', 'office_id', 'office_service_id',
        'client_name', 'client_phone', 'client_email', 'client_id_number',
        'notes', 'attachments',
        'price', 'commission_amount',
        'status', 'office_note', 'completed_at',
    ];

    protected $casts = [
        'attachments'       => 'array',
        'price'             => 'decimal:2',
        'commission_amount' => 'decimal:2',
        'completed_at'      => 'datetime',
    ];

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    public function officeService(): BelongsTo
    {
        return $this->belongsTo(OfficeService::class, 'office_service_id');
    }
}