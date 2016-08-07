<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'statementRow';

    public $timestamps = false;

    protected $fillable = [
        'statement_id',
        'rowOrder',
        'rowTitle'
    ];

    protected $guarded = [];

        
}