<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;

class ShowController extends BaseController
{
    public function __invoke(Request $request, $blogId)
    {
        $blog = $this->blogService->getById($blogId);

        if (!$blog)
            abort(404);

        $url = $blog->url;

        $articles = $this->feedService->getArticles($url);

        $blogTitle = $this->feedService->getBlogTitle($url);

        return view('blogs.show', compact('url', 'blog', 'articles', 'blogTitle'));
    }
}
