<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    //
    protected $table = 'comments';

    public function invoice(){

    		return $this->belongsTo('App\Invoice')
    				->select(array('Id','ClientName','EventName','RepresentativeNo','GrandTotal'));

    	}

  
}
