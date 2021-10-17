<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Render Welcome page.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render('Auth/Login');
    }

    /**
     * Render Dashboard page.
     *
     * @return \Inertia\Response
     */
    public function dashboard(): Response
    {
        return Inertia::render('Dashboard');
    }
}
