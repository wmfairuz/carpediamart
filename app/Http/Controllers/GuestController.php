<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function __invoke()
    {
        return view('landing');
    }

    public function test(Request $request)
    {
//        $queryString = $request->getQueryString();
//        dd($queryString);
        return 'ok';
    }

}
