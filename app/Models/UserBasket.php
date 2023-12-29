<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBasket extends Model {
    use HasFactory;
    protected $table = 'user_basket';

    protected $fillable = [
        'user_id',
        'moto_id',
        'quantity',
        'status',
        'start_date',
        'end_date',
        'total_price',
        'total_price_currency',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function moto() {
        return $this->belongsTo(Moto::class);
    }
}
