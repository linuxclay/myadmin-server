<?php

namespace App\Http\Controllers\Web;

use Illuminate\Routing\Controller;

/**
 *
 *
 */
class ErrorController extends Controller
{
    public function notFound()
    {
        return view('error.404');
    }
}