<?php

namespace App\Interfaces;

class TenantInterface
{
    public const MODULE_CMS = 'CMS';
    public const MODULE_CRM = 'CRM';
    public const MODULE_EDU = 'EDU';

    public const ALL_MODULES = [
        self::MODULE_CMS,
        self::MODULE_CRM,
        self::MODULE_EDU,
    ];

    public const ALL_MODULES_LABELLED = [
        self::MODULE_CMS => 'CMS',
        self::MODULE_CRM => 'CRM',
        self::MODULE_EDU => 'EDU',
    ];
}
