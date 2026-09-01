<?php

namespace App\Models\Business;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class BusinessUser extends Authenticatable
{
    use Notifiable;

    protected $connection = 'business';
    protected $table      = 'bs_users';

    protected $fillable = [
        'name',
        'legal_name',
        'cr_number',
        'country',
        'city',
        'district',
        'street',
        'postal_code',
        'representative_name',
        'representative_role',
        'email',
        'phone',
        'password',
        'role',
        'is_active',
        'permissions',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active'         => 'boolean',
        'permissions'       => 'array',
    ];

    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'supervisor']);
    }

    public function hasPermission(string $permission): bool
    {
        if ($this->role === 'supervisor') return true;
        return in_array($permission, $this->permissions ?? []);
    }

    public function grantPermission(string $permission): void
    {
        $perms = $this->permissions ?? [];
        if (!in_array($permission, $perms)) {
            $perms[] = $permission;
            $this->update(['permissions' => $perms]);
        }
    }

    public function revokePermission(string $permission): void
    {
        $this->update(['permissions' => array_values(array_filter($this->permissions ?? [], fn($p) => $p !== $permission))]);
    }
}
