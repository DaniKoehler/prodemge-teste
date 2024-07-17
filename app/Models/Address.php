<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $table = 'addresses';

    protected $fillable = [
        'person_id',
        'type',
        'cep',
        'street',
        'number',
        'complement',
        'neighborhood',
        'state',
        'city'
    ];
}
