<?php

namespace App\Models\CMS;

use App\Traits\CMS\HasContent;
use App\Traits\CMS\HasMetadata;
use App\Traits\CMS\HasUrl;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property int $layout_id
 * @property Layout $layout
 * @property int $template_id
 * @property Template $template
 * @property int $parent_id
 * @property Page $parent
 * @property string $name
 * @property string $slug
 * @property Collection<PageView> $pageViews
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Page extends Model
{
    use HasContent, HasFactory, HasMetadata, HasUrl;

    protected $table = 'cms_pages';

    protected $guarded = [];

    public function layout(): BelongsTo
    {
        return $this->belongsTo(Layout::class);
    }

    public function pageViews(): HasMany
    {
        return $this->hasMany(PageView::class, 'page_id');
    }

    public function parent() : BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function template() : BelongsTo
    {
        return $this->belongsTo(Template::class);
    }
}
