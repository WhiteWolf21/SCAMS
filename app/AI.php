<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AI extends Model {
    protected $table = 'AI';
    protected $primaryKey = 'date';
    public $incrementing = false;

    public $timestamps = false;

}
