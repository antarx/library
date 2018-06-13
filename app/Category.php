<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    protected $fillable = [
        'parent_id', 'name', 'slug', 'h1', 'text', 'meta_title', 'meta_description', 'meta_keywords', 'sort_order', 'status'
    ];

    protected $attributes = [
        'status'     => self::STATUS_ENABLED,
        'sort_order' => 0
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

    public function scopeList($query, $caregoryId = null)
    {
        return $query->where('id', '!=', $caregoryId)
            ->orderBy('name', 'asc')
            ->pluck('name', 'id')
            ->toArray();
    }
}
