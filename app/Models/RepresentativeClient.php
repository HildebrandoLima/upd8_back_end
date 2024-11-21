<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentativeClient extends Model
{
    use HasFactory;

    protected $table = 'representative_client';

    protected $fillable = [
        'representative_id',
        'client_id',
    ];
}
