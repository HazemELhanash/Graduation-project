<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class assistantController extends Controller
{
    public function index()
    {
      return redirect()->route("assistant.index");
    }
}
