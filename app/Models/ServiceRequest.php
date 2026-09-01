<?php

namespace App\Models;

use App\Models\Business\BusinessUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class ServiceRequest extends Model
{
    protected $connection = 'business';
    protected $table      = 'bs_requests';

    protected $fillable = [
        'ref_number', 'user_id', 'service_id', 'entity_id',
        'client_name', 'client_email', 'client_phone', 'client_id_number',
        'company_name', 'company_cr', 'notes', 'attachments',
        'price', 'status', 'reject_reason',
        'estimated_completion', 'completed_at', 'handled_by',
    ];

    protected $casts = [
        'attachments'  => 'array',
        'price'        => 'decimal:2',
        'completed_at' => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->ref_number)) {
                $model->ref_number = 'AMR-' . strtoupper(Str::random(6));
            }
        });
    }

    public function user(): BelongsTo     { return $this->belongsTo(BusinessUser::class); }

    public function govService(): BelongsTo
    {
        return $this->belongsTo(GovService::class, 'service_id');
    }

    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(RequestLog::class, 'request_id')->orderByDesc('created_at');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(ServicePayment::class, 'request_id');
    }

    public function getStatusLabelAttribute(): array
    {
        return match ($this->status) {
            'pending'     => ['ar' => 'قيد الانتظار',   'en' => 'Pending'],
            'processing'  => ['ar' => 'جاري المعالجة',  'en' => 'Processing'],
            'in_progress' => ['ar' => 'قيد التنفيذ',    'en' => 'In Progress'],
            'done'        => ['ar' => 'تمت العملية',     'en' => 'Completed'],
            'rejected'    => ['ar' => 'مرفوض',           'en' => 'Rejected'],
            default       => ['ar' => 'غير معروف',       'en' => 'Unknown'],
        };
    }

    /** Map of all status values to their Arabic label — single source of truth. */
    public static function statusLabels(): array
    {
        return [
            'pending'     => 'قيد الانتظار',
            'processing'  => 'جاري المعالجة',
            'in_progress' => 'قيد التنفيذ',
            'done'        => 'تمت العملية',
            'rejected'    => 'مرفوض',
        ];
    }

    /**
     * Standard API representation used by admin & user dashboard endpoints.
     * Avoids repeating the same map() closure in multiple controllers.
     */
    public function toApiArray(): array
    {
        return [
            'id'                   => $this->id,
            'ref_number'           => $this->ref_number,
            'client_name'          => $this->client_name,
            'client_email'         => $this->client_email ?? null,
            'client_phone'         => $this->client_phone ?? null,
            'client_id_number'     => $this->client_id_number ?? null,
            'company_name'         => $this->company_name ?? null,
            'price'                => (float) $this->price,
            'status'               => $this->status,
            'reject_reason'        => $this->reject_reason,
            'estimated_completion' => $this->estimated_completion,
            'created_at'           => $this->created_at,
            'gov_service'          => $this->govService ? [
                'name_ar' => $this->govService->name_ar,
                'name_en' => $this->govService->name_en,
                'icon'    => $this->govService->icon,
            ] : null,
            'entity'               => $this->entity ? [
                'name_ar' => $this->entity->name_ar,
                'name_en' => $this->entity->name_en,
                'color'   => $this->entity->color,
                'bg'      => $this->entity->bg,
            ] : null,
            'logs'                 => $this->relationLoaded('logs')
                ? $this->logs->map(fn($l) => [
                    'status'     => $l->status,
                    'log_type'   => $l->log_type,
                    'note'       => $l->note,
                    'created_at' => $l->created_at,
                ])
                : [],
        ];
    }
}
