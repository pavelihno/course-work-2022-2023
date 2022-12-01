<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\BlogUser;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class BlogService
{
    private FeedService $feedService;

    public function __construct(FeedService $feedService)
    {
        $this->feedService = $feedService;
    }

    public function getById(int $blogId)
    {
        return Blog::find($blogId);
    }

    public function getAll(): Collection
    {
        return Blog::all();
    }

    public function getAllByUser(User $user): Collection
    {
        $blogs_ids = BlogUser::where('user_id', $user->id)->pluck('blog_id')->toArray();

        return Blog::whereIn('id', $blogs_ids)->get();
    }

    public function create(String $url): ?Blog
    {
        $blogs = Blog::where('url', $url);
        if ($blogs->count()) {
            return $blogs->first();
        } else if ($this->feedService->validateUrl($url)) {
            $blog = Blog::create(['url' => $url]);
            $blog->save();
            return $blog;
        }
        return null;
    }

    public function add(User $user, String $url): bool
    {
        $blog = $this->create($url);
        if ($blog) {
            $userBlogsIds = $this->getAllByUser($user)->pluck('id')->toArray();

            if (!in_array($blog->id, $userBlogsIds)) {
                $blogUser= BlogUser::create(['user_id' => $user->id, 'blog_id' => $blog->id]);

                $blogUser->save();
            }
            return true;
        }
        return false;
    }

    public function delete(User $user, Blog $blog): bool
    {
        return false;
    }




}
