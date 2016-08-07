<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Symbol extends Model {

    protected $table = 'symbol';

    public $timestamps = false;

    protected $fillable = [];

    protected $guarded = [
        'exchange_id',
        'ticker',
        'instrument',
        'name',
        'sector',
        'currency',
        'created_date',
        'last_updated_date'
    ];

    public function posts()
    {
        return $this->hasMany('App\Posts', 'on_post');
    }

}
