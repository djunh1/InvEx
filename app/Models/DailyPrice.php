<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'daily_price';

    public $timestamps = false;

    protected $fillable = [
        'data_vendor_id',
        'symbol_id',
        'price_date',
        'created_date',
        'last_updated_date',
        'open_price',
        'high_price',
        'low_price',
        'close_price',
        'adj_close_price',
        'volume'
    ];

    protected $guarded = [];

        
}