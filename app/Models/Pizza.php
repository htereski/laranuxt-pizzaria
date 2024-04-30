<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'kind_id'
    ];

    public function kind()
    {
        return $this->belongsTo(Kind::class);
    }

    public function pizzaOrder()
    {
        return $this->hasMany(PizzaOrder::class);
    }
}
