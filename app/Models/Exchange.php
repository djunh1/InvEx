<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'exchange';

    public $timestamps = false;

    protected $fillable = [
        'abbrev',
        'name',
        'city',
        'country',
        'currency',
        'timezone_offset',
        'created_date',
        'last_updated_date'
    ];

    protected $guarded = [];

        
}