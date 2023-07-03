<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class YourController extends Controller
{
    public function redirectToWelcome($param1, $param2)
    {
        return view('welcome2', [
            'param1' => $param1,
            'param2' => $param2
        ]);
    }
}
