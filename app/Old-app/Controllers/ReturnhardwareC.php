<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthM;

class ReturnhardwareC extends BaseController
{
     public function index(){
        return view('returnhardware');
     }
}
