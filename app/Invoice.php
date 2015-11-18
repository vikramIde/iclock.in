<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
     protected $table = 'event_invoice';
     protected $primaryKey = 'Id';

	/*
	 * An invoice can has many payments 
	 *
	 */
     public function payments(){
        return $this->hasMany('App\paymentrecieved');
    }

    public function comments(){
        return $this->hasMany('App\comments');
    }
}
