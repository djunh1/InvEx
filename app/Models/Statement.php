<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'statement';

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    protected $guarded = [];

        
}