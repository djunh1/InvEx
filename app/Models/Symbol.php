<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class Symbol extends Model
{
    protected $table = 'symbol';

    public $timestamps = false;

    protected $fillable = [
        'exchange_id',
        'ticker',
        'instrument',
        'name',
        'sector',
        'currency',
        'created_date',
        'last_updated_date'
    ];

    protected $guarded = [];

        
}