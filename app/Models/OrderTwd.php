<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTwd extends Model
{
    use HasFactory;

    protected $table = 'orders_twd';

    protected $primaryKey = 'id';
    
    public $incrementing = false;

    protected $fillable = [
        'id', 'name', 'city', 'district', 'street', 'price', 'currency',
    ];
}
