<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\AuthM;

class HierarchyC extends BaseController
{
     public function index(){
        return view('master/hierarchy');
     }
}
