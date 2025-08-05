<?php

namespace App\Http\Requests\Landlord\Admin\Tenant;

use App\Http\Requests\BaseRequest;
use App\Interfaces\TenantInterface;
use Illuminate\Validation\Rule;

class TenantStoreRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'id' => [
                'required',
                'string',
                Rule::unique('tenants'),
            ],
            'modules' => 'nullable|array',
            'modules.*' => [
                'sometimes',
                Rule::in(TenantInterface::ALL_MODULES)
            ]
        ];
    }
}
