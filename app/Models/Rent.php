<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use app\Models\User;
use app\Models\Moto;
use app\Models\Discount;

class Rent extends Model {
    use HasFactory;
    protected $table = 'rents';

    protected $fillable = [
        'user_id',
        'moto_id',
        'discount_id',
        'start_date',
        'requested_end_date',
        'actual_end_date',
        'total_requested_price',
        'total_actual_price',
        'is_active',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function moto() {
        return $this->belongsTo(Moto::class);
    }

    public function discount() {
        return $this->belongsTo(Discount::class);
    }
}
