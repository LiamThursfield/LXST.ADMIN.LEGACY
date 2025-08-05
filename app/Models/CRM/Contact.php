<?php

namespace App\Models\CRM;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property bool $is_spam
 * @property string $title
 * @property string $first_name
 * @property string $last_name
 * @property string $telephone
 * @property string $email
 * @property bool $marketing_email
 * @property bool $marketing_sms
 * @property bool $marketing_telephone
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'crm_contacts';

    protected $guarded = [];

    protected $appends = [
        'name',
        'name_with_title',
    ];

    protected $casts = [
        'is_spam'               => 'boolean',
        'marketing_email'       => 'boolean',
        'marketing_sms'         => 'boolean',
        'marketing_telephone'   => 'boolean',
    ];


    /**
     * Helper to return first + last name.
     * @return string
     */
    public function getNameAttribute(): String
    {
        return trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? ''));
    }

    /**
     * Helper to return title + first + last name.
     * @return string
     */
    public function getNameWithTitleAttribute(): String
    {
        return trim(($this->title ?? '') . ' ' . ($this->name));
    }


    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }


    public function formSubmissions(): HasMany
    {
        return $this->hasMany(FormSubmission::class);
    }
}
