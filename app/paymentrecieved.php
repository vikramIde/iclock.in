<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class paymentrecieved extends Model
{
    //
    protected $table = 'payments';
    protected $fillable = array('invoice_id', 'recieved_amount', 'refno', 'date', 'adjust_mode', 'adjust_amount');
    public function invoice(){

    		return $this->belongsTo('App\Invoice')
    				->select(array('Id','ClientName','EventName','RepresentativeNo','GrandTotal'));

    	}


}
