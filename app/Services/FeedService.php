<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Vedmant\FeedReader\Facades\FeedReader;

class FeedService
{
    public function validateUrl(String $url): bool
    {
        $validatorUrl = 'https://validator.w3.org/feed/check.cgi?url=';
        $validatorResponse = file_get_contents($validatorUrl . urlencode($url));

        if ($validatorResponse) {
            if (stristr($validatorResponse , 'This is a valid RSS feed') !== false ) {
                $blogs = $this->getBlogs($url);
                if ($blogs && $blogs[0]->get_content())
                    return true;
                else
                    return false;
            }
            else
                return false;
        }
        else
            return false;
    }

    public function getBlogs($url): array
    {
        return FeedReader::read($url)->get_items();
    }

    public function getBlogTitle($url): String
    {
        return FeedReader::read($url)->get_title();
    }

}
