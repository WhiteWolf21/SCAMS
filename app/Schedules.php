<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model {
    protected $table = 'Schedule';
    protected $primaryKey = 'schedule_id';
    public $incrementing = false;

    public $timestamps = false;

}
