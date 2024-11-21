<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    protected $table = 'city';

    protected $fillable = [
        'state',
        'city_name',
    ];

    public function client(): HasMany
    {
        return $this->hasMany(Client::class, 'city_id');
    }
}
