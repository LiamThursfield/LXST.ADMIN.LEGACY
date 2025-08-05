<?php

namespace App\Models;

use App\Models\Settings\CoreSettings;
use Exception;
use Illuminate\Support\Str;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

/**
 *
 * @property string $id
 * @property string $locale
 * @property array $modules
 */
class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    protected $casts = [
        'modules' => 'array'
    ];

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'modules',
        ];
    }


    public function getLocaleAttribute(): string
    {
        try {
            return app()->make(CoreSettings::class)->locale;
        } catch (Exception $e) {
            // For when a tenant is being created
            return 'en';
        }
    }

    public function hasModule(string $module): bool
    {
        return $this->modules && in_array(Str::upper($module), $this->modules);
    }
}
