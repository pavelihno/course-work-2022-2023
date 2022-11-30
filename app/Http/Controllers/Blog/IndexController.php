<?php

namespace App\Http\Controllers\Blog;

use App\Models\Blog;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $blogs = $this->blogService->getAllByUser($user);
        $latestBlogs = array();

        foreach ($blogs as $blog) {
            $latestBlogs[$blog->id] = $this->feedService->getBlogs($blog->url)[0];
        }

        return view('blogs.index', compact('latestBlogs'));
    }
}
