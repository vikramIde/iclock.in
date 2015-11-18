<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Targetassign extends Model
{
    //
    protected $table = 'targetassign';

    public function user()
  		{
    		return $this->belongsTo('App\User');
  }
}
