<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PizzaOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'pizza_id',
        'size_id',
        'value'
    ];

    public function pizza()
    {
        return $this->belongsTo(Pizza::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
