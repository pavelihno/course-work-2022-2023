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

        $rssUrl = $blog->url;
        $blogUrl = $this->feedService->getBlogLink($rssUrl);

        $articles = $this->feedService->getArticles($rssUrl);

        $blogTitle = $this->feedService->getBlogTitle($rssUrl);

        return view('blogs.show', compact('blogUrl', 'blog', 'articles', 'blogTitle'));
    }
}
