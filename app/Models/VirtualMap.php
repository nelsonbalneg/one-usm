<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VirtualMap extends Model
{
    use HasFactory;

    protected $table = 'portal.virtualmap';

    protected $fillable = [
        'latitude',
        'longitude',
        'label',
        'url',
        'text',
        'color',
        'icon',
        'campus_id',
        'tenant_id',
    ];
}
