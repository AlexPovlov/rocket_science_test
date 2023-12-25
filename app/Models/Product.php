<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'quantity',
    ];

    function properties()
    {
        return $this->belongsToMany(Property::class);
    }

    function scopeFilterProperties(Builder $query, array $filter = [])
    {
        if (empty($filter))
            return $query;

        return $query->whereHas('properties', function ($query) use ($filter) {
            foreach ($filter as $key => $value) {
                $query->whereName($key)->whereIn('value', $value);
            }
        });

    }
}
