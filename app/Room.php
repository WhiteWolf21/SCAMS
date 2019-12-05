<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model {
    protected $table = 'Room';
    protected $primaryKey = 'room_id';
    public $incrementing = false;

    public $timestamps = false;

}
