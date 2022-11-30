<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $blogs = $this->blogService->getAllByUser($user);
        $latestBlogs = array();
        $blogsNames = array();

        foreach ($blogs as $blog) {
            $blogId = $blog->id;
            $url = $blog->url;

            $latestBlogs[$blogId] = $this->feedService->getBlogs($url)[0];
            $blogsNames[$blogId] = $this->feedService->getBlogTitle($url);
        }

        return view('blogs.index', compact('latestBlogs', 'blogsNames'));
    }
}
