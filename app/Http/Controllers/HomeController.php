<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Auth/Login');
    }

    public function dashboard(): Response
    {
        return Inertia::render('Dashboard');
    }
}
