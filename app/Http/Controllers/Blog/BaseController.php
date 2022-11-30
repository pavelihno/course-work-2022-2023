<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Services\BlogService;
use App\Services\FeedService;

class BaseController extends Controller
{
    protected BlogService $blogService;
    protected FeedService $feedService;

    public function __construct(BlogService $blogService, FeedService $feedService)
    {
        $this->blogService = $blogService;
        $this->feedService = $feedService;

        $this->middleware('auth');
    }
}
