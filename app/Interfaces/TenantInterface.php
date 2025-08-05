<?php

namespace App\Interfaces;

class TenantInterface
{
    public const MODULE_CMS = 'CMS';
    public const MODULE_CRM = 'CRM';

    public const ALL_MODULES = [
        self::MODULE_CMS,
        self::MODULE_CRM,
    ];

    public const ALL_MODULES_LABELLED = [
        self::MODULE_CMS => 'CMS',
        self::MODULE_CRM => 'CRM',
    ];
}
