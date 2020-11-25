<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $table = 'business';
    protected $fillable = [
        'name', 'loc_province', 'loc_regency', 'loc_district', 'loc_village', 'address', 'business_sectors_id'
    ];

    public function photo()
    {
        return $this->hasOne('App\Models\Business_picture', 'business_id', 'id');
    }
}
