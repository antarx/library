<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    protected $fillable = [
        'title', 'slug', 'h1', 'text', 'meta_title', 'meta_description', 'meta_keywords', 'status'
    ];

    protected $attributes = [
        'status' => self::STATUS_ENABLED
    ];

    public static function statuses()
    {
        return [
            self::STATUS_DISABLED => __('Вимкнений'),
            self::STATUS_ENABLED  => __('Активний')
        ];
    }

    public static function htmlStatuses()
    {
        return [
            self::STATUS_DISABLED => '<i class="la la-remove text-danger"></i> ' . __('Вимкнений'),
            self::STATUS_ENABLED  => '<i class="la la-check text-success"></i> ' . __('Активний')
        ];
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ENABLED);
    }
}
