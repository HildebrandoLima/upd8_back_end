<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Representative extends Model
{
    use HasFactory;

    protected $table = 'representative';

    protected $fillable = [
        'name',
        'cpf',
        'city_id',
    ];

    public function clients(): HasMany
    {
        return $this->hasMany(RepresentativeClient::class, 'representative_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
