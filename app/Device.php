<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model {
    protected $table = 'Device';
    protected $primaryKey = 'device_id';
    public $incrementing = false;

    public $timestamps = false;

}
