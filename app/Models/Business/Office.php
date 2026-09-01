<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Business\OfficeDocument;
use App\Models\Business\OfficeUser;
use Illuminate\Support\Str;

class Office extends Model
{
    protected $connection = 'business';

    protected $table = 'bs_offices';

    protected $fillable = [
        'type',
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'phone',
        'email',
        'city',
        'cr_number',
        'logo',
        'specialties',
        'is_active',
        'is_verified',
        'commission_rate',

    // كود ورابط المكتب
    'office_code',
    'public_token',
    ];

    protected $casts = [
        'specialties' => 'array',
        'is_active' => 'boolean',
        'is_verified' => 'boolean',
        'commission_rate' => 'float',
    ];

    public static array $typeLabels = [

        'law' => [
            'ar' => 'شركة/مكتب محاماة',
            'en' => 'Law Firm',
        ],

        'services' => [
            'ar' => 'مكتب خدمات وتعقيب',
            'en' => 'Service & Expediting Office',
        ],

        'customs' => [
            'ar' => 'شركة/مكتب تخليص جمركي',
            'en' => 'Customs Clearance',
        ],

        'accounting' => [
            'ar' => 'مكاتب المحاسبة والاستشارات المالية والضريبية',
            'en' => 'Accounting & Tax Consulting',
        ],

        'engineering' => [
            'ar' => 'الاستشارات الهندسية والتصميم والإشراف',
            'en' => 'Engineering Consulting',
        ],

        'freelance' => [
            'ar' => 'أصحاب المهن الحرة',
            'en' => 'Freelance Professionals',
        ],

    ];


protected static function booted()
{
    static::creating(function ($office) {
        do {
            $code = 'OF-' . strtoupper(Str::random(6));
        } while (static::where('office_code', $code)->exists());

        $office->office_code = $code;
        $office->public_token = Str::random(40);
    });
}
    



    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */

    public function users(): HasMany
    {
        return $this->hasMany(OfficeUser::class, 'office_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Requests
    |--------------------------------------------------------------------------
    */

    public function requests(): HasMany
    {
        return $this->hasMany(OfficeRequest::class, 'office_id');
    }

    public function directRequests(): HasMany
    {
        return $this->hasMany(OfficeRequest::class, 'office_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Messages
    |--------------------------------------------------------------------------
    */

    public function messages(): HasMany
    {
        return $this->hasMany(OfficeMessage::class, 'office_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Services
    |--------------------------------------------------------------------------
    */

    public function services(): HasMany
    {
        return $this->hasMany(OfficeService::class, 'office_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Office Profile
    |--------------------------------------------------------------------------
    */

    public function profile()
{
    return $this->hasOne(
        \App\Models\Business\OfficeProfile::class,
        'office_id',
        'id'
    );
}
    /*
    |--------------------------------------------------------------------------
    | Office Documents
    |--------------------------------------------------------------------------
    */


    public function documents()
{
    return $this->hasMany(
        OfficeDocument::class,
        'office_id',
        'id'
    );
}
    /*
    |--------------------------------------------------------------------------
    | Specialties
    |--------------------------------------------------------------------------
    */

    public function specialtiesRelation(): BelongsToMany
    {
        return $this->belongsToMany(
            Specialty::class,
            'bs_office_specialties',
            'office_id',
            'specialty_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Labels
    |--------------------------------------------------------------------------
    */

    public function typeLabelAr(): string
    {
        return self::$typeLabels[$this->type]['ar'] ?? $this->type;
    }

    public function typeLabelEn(): string
    {
        return self::$typeLabels[$this->type]['en'] ?? $this->type;
    }

    public function getDisplaySpecialtyArAttribute(): string
    {
        if ($this->relationLoaded('specialtiesRelation') && $this->specialtiesRelation->isNotEmpty()) {
            return $this->specialtiesRelation->first()->name_ar;
        }
        $spec = $this->specialtiesRelation()->first();
        if ($spec) {
            return $spec->name_ar;
        }
        if (is_array($this->specialties) && count($this->specialties) > 0) {
            return $this->specialties[0];
        }
        return self::$typeLabels[$this->type]['ar'] ?? 'تخصص معتمد';
    }

    public function getDisplaySpecialtyEnAttribute(): string
    {
        if ($this->relationLoaded('specialtiesRelation') && $this->specialtiesRelation->isNotEmpty()) {
            return $this->specialtiesRelation->first()->name_en ?? $this->specialtiesRelation->first()->name_ar;
        }
        $spec = $this->specialtiesRelation()->first();
        if ($spec) {
            return $spec->name_en ?? $spec->name_ar;
        }
        if (is_array($this->specialties) && count($this->specialties) > 0) {
            return $this->specialties[0];
        }
        return self::$typeLabels[$this->type]['en'] ?? 'Certified Specialty';
    }
}

    

