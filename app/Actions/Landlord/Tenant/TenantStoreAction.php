<?php

namespace App\Actions\Landlord\Tenant;

use App\Models\Tenant;

class TenantStoreAction
{
    public function handle(array $tenant_data, ?string $domain = null): Tenant
    {
        /** @var Tenant $tenant */
        $tenant = Tenant::create($tenant_data);

        if ($domain) {
            $tenant->domains()->create([
                'domain' => $domain
            ]);
        }

        return $tenant;
    }
}
