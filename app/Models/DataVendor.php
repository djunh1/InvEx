<?php

namespace DummyNamespace;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class DummyClass extends Model
{
    protected $table = 'data_vendor';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'website_url',
        'support_email',
        'created_date',
        'last_updated_date'
    ];

    protected $guarded = [];

        
}