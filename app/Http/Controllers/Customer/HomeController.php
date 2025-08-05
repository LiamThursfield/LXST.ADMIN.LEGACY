<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Show the application homepage.
     *
     * @return Response
     */
    public function index()
    {
        if (!config('lxst_admin.web.enabled')) {
            return redirect(route('admin.index'));
        }

        return Inertia::render('website/home/Index');
    }
}
