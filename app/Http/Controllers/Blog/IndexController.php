<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $blogs = $this->blogService->getAllByUser($user);

        $latestArticles = array();
        $articlesNames = array();

        foreach ($blogs as $blog) {
            $blogId = $blog->id;
            $url = $blog->url;

            $latestArticles[$blogId] = $this->feedService->getArticles($url)[0];
            $articlesNames[$blogId] = $this->feedService->getBlogTitle($url);
        }

        return view('blogs.index', compact('latestArticles', 'articlesNames'));
    }
}
