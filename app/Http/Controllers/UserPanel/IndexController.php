<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('userPanel.index');
    }
}
