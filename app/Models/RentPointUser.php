<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentPointUser extends Model {
    use HasFactory;
    protected $table = 'rent_point_user';

    protected $fillable = [
        'rent_point_id',
        'user_id',
    ];

    public function rentPoint() {
        return $this->belongsTo(RentPoint::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
