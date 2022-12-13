<?php

namespace App\Services;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Vedmant\FeedReader\Facades\FeedReader;

class FeedService
{
    public function validateUrl(String $url): bool
    {
        try {
            $contextOptions=array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );
            $validatorUrl = 'https://www.rssboard.org/rss-validator/check.cgi?url=';
            $validatorResponse = file_get_contents(
                $validatorUrl . urlencode($url),
                false,
                stream_context_create($contextOptions)
            );

            if ($validatorResponse) {
                if (stristr($validatorResponse , 'This is a valid RSS feed') !== false ) {
                    $articles = $this->getArticles($url);
                    if ($articles && $articles[0]->get_content())
                        return true;
                    else
                        return false;
                }
                else
                    return false;
            }
            else
                return false;

        } catch (Exception $e) {
            return false;
        }
    }

    public function getArticles($url): array
    {
        return FeedReader::read($url)->get_items();
    }

    public function getBlogTitle($url): String
    {
        return FeedReader::read($url)->get_title();
    }

    public function getBlogLink($url): String
    {
        return FeedReader::read($url)->get_link();
    }

}
