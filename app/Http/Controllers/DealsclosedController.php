<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Event;
use App\Employee;
use App\Invoice;
use App\Deal;
use Mail;

class DealsclosedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex(){
         $categories = Deal::where('Status','=',1)->get();
         $in=Invoice::all();
     
      return View('dealsclosed')->with(array('categories'=>$categories,'in'=>$in));
    }







    }
