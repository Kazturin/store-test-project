<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'status',
        'product_id',
        'created_by'
    ];

    const STATUS_CREATED = 0;
    const STATUS_CONFIRMED = 1;
    const STATUS_REJECTED = 2;

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function getStatus(){
        switch ($this->status){
            case self::STATUS_CREATED: return 'В ожидание'; break;
            case self::STATUS_CONFIRMED: return 'Подтвержден'; break;
            case self::STATUS_REJECTED: return 'Отклонен'; break;
            default :return null;
        }
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function($model)
        {
            $model->status = self::STATUS_CREATED;
        });
    }
}
