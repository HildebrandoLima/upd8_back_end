<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    use HasFactory;

    protected $table = 'representative';

    protected $fillable = [
        'name',
        'cpf',
        'city_id',
    ];
}
