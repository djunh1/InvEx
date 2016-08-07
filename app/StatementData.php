<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class StatementData extends Model {

    protected $table = 'statementData_test';

    public $timestamps = false;

    protected $fillable = [];

    protected $guarded = [
        'symbol_id',
        'statementRow_Id',
        'type',
        'date',
        'amount'
    ];

}
