<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation_days extends Model
{
    use HasFactory;

    protected $table = 'operation_days';
    protected $fillable = [
        'days', 'open', 'close', 'business_id'
    ];
}
