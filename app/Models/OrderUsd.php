<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderUsd extends Model
{
    use HasFactory;

    protected $table = 'orders_usd';

    protected $fillable = [
        'id', 'name', 'city', 'district', 'street', 'price', 'currency',
    ];
}
