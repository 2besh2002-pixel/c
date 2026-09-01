<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageSlide extends Model
{
    protected $table = 'homepage_slides';

    protected $fillable = [
        'title', 'image_path', 'link_url', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image_path) {
            return null;
        }

        if ($this->isLocalPath()) {
            return asset($this->image_path);
        }

        $storageRel = 'storage/' . ltrim($this->image_path, '/');
        if (file_exists(public_path($storageRel))) {
            return asset($storageRel);
        }

        // Fallback: check if the original file exists in public/images (strip timestamp prefix)
        $cleanName = preg_replace('/^\d+_/', '', basename($this->image_path));
        if (file_exists(public_path('images/' . $cleanName))) {
            return asset('images/' . $cleanName);
        }

        return asset($storageRel);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    private function isLocalPath(): bool
    {
        return str_starts_with($this->image_path, 'images/')
            || str_starts_with($this->image_path, 'uploads/');
    }
}
