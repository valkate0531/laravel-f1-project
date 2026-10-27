<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoopingController extends Controller
{
    public function index()
    {
        $age = 18;
        $ages = [];
        
        for($i = 0; $i < 10; $i++)
            {
                $ages[] = $age + $i;
            }
    }
}
