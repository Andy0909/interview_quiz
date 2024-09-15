<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRmb extends Model
{
    use HasFactory;

    protected $table = 'orders_rmb';

    protected $primaryKey = 'id';
    
    public $incrementing = false;

    protected $fillable = [
        'id', 'name', 'city', 'district', 'street', 'price', 'currency',
    ];
}
