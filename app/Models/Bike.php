<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color_id',
        'model_id',
        'weight',
        'price',
        'bike_image',
    ];

    public function color()
    {
        return $this->HasOne(BikeColor::class, 'id', 'color_id');
    }

    public function bike_model()
    {
        return $this->HasOne(BikeModel::class, 'id', 'model_id');
    }

}
