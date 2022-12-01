<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;

class DestroyController extends BaseController
{
    public function __invoke(Request $request, $blogId)
    {
        $blog = $this->blogService->getById($blogId);

        $this->blogService->delete($request->user(), $blog);

        return to_route('blogs.index');
    }
}
