<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;

class CreateController extends BaseController
{
    public function __invoke()
    {
        return view('blogs.create');
    }
}
