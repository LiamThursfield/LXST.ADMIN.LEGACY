<?php

namespace App\Models\CMS;

use App\Traits\CMS\HasContent;
use App\Traits\CMS\HasMetadata;
use App\Traits\CMS\HasUrl;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $page_id
 * @property Page $page
 * @property string $referrer
 * @property string $user_agent
 * @property string $ip_address
 * @property string $session_id
 * @property array $enquiry_source
 * @property array $additional_data
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class PageView extends Model
{

    protected $table = 'cms_page_views';

    protected $guarded = [];

    protected $casts = [
        'additional_data'   => 'json',
        'enquiry_source'    => 'json',
    ];

    public function page() : BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
