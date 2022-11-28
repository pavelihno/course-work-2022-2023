<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke()
    {
        dd(app()->getLocale());

        return view('home');
    }
}
