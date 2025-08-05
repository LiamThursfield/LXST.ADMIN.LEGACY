<?php

namespace App\Http\Requests\Landlord\Admin\Tenant;

use Illuminate\Validation\Rule;

class TenantUpdateRequest extends TenantStoreRequest
{
    public function rules() : array
    {
        $rules = parent::rules();

        $rules ['id'] = [
            'required',
            'string',
            Rule::unique('tenants')->ignore($this->tenant->id, 'id'),
        ];

        return $rules;
    }
}
