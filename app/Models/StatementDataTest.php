<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class StatementData extends Model
{
    protected $table = 'statementData_test';

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