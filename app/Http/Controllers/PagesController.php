<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller {

    /**
     * Static about page.
     *
     * @return mixed
     */
    public function about()
    {
        return response()->view('about');
    }
}
