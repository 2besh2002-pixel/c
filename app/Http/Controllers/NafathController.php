<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NafathController extends Controller
{
    public function show()
    {
        return redirect()->route('amrtm.login');
    }

    public function verify(Request $request)
    {
        return redirect()->route('amrtm.login');
    }

    public function wait()
    {
        return redirect()->route('amrtm.login');
    }

    public function callback(Request $request)
    {
        return redirect()->route('amrtm.login');
    }
}
