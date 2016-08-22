<?php

namespace Jfreites\Luna\Http\Controllers;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
}
