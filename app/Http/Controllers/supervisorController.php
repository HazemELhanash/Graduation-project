<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class supervisorController extends Controller
{
    public function index()
    {
      return redirect()->route("supervisor.index");
    }
}
