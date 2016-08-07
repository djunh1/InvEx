<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'statementData';

    public $timestamps = false;

    protected $fillable = [
        'symbol_id',
        'statementRow_Id',
        'type',
        'date',
        'amount'
    ];

    protected $guarded = [];

        
}