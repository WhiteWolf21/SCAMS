<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountRequest extends Model {
    protected $table = 'AccountRequest';
    protected $primaryKey = 'user_id';
    public $incrementing = false;

    public $timestamps = false;

}
