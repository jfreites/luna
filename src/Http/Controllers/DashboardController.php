<?php

namespace Jfreites\Luna\Http\Controllers;

class DashboardController extends AdminController
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('luna::admin.dashboard');
    }
}
