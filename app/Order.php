<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_DISABLED = 0;
    const STATUS_PREORDER = 1;
    const STATUS_ENABLED = 2;

    protected $fillable = [
        'user_id', 'invoice', 'status'
    ];

    public static function statuses()
    {
        return [
            self::STATUS_DISABLED => __('Не активний'),
            self::STATUS_PREORDER => __('Очикує на підтвердження'),
            self::STATUS_ENABLED  => __('Активний')
        ];
    }

    public static function htmlStatuses()
    {
        return [
            self::STATUS_DISABLED => '<i class="la la-remove text-danger"></i> ' . __('Не активний') . '</span>',
            self::STATUS_PREORDER => '<i class="la la-clock-o text-primary"></i>' . __('Очикує на підтвердження') . '</span>',
            self::STATUS_ENABLED  => '<i class="la la-check text-success"></i> ' . __('Активний') . '</span>'
        ];
    }

    public static function generateInvoice()
    {
        return 'INV-' . Carbon::now()->format('YmdHis');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)
            ->using(CategoryOrder::class)
            ->withPivot('date_start', 'date_end');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
