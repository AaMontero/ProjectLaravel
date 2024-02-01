<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerCalendar extends Controller
{
    public function calendar()
    {
        return view('calendario.calendario');
    }
}
