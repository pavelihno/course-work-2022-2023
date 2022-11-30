<?php

namespace App\Http\Controllers\Blog;

use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;

class StoreController extends BaseController
{
    public function __invoke(BlogRequest $request)
    {
        $data = $request->validated();

        $user = $request->user();

        $this->blogService->add($user, $data['url']);

        return to_route('blogs.index');
    }
}
