<?php
declare(strict_types=1);

namespace App;

use App\Collections\ArticleCollection;
use App\Models\Article;
use Carbon\Carbon;
use jcobhams\NewsApi\NewsApi;
use jcobhams\NewsApi\NewsApiException;

class Api
{
    private NewsApi $api;

    public function __construct(NewsApi $api)
    {
        $this->api = $api;
        //$this->api = new NewsApi($_ENV['API_KEY']);
    }
    private function fetchArticles(array $articles): ArticleCollection
    {
        $articleCollection = new ArticleCollection();

        foreach ($articles as $article) {
            $articleCollection->add(new Article(
                $article['title'],
                $article['description'],
                $article['author'],
                $article['url'],
                $article['urlToImage'],
                Carbon::parse($article['publishedAt'])
            ));
        }

        return $articleCollection;
    }

    public function fetchTopHeadlines(): ?ArticleCollection
    {
        try {
            $articles = $this->api->getTopHeadLines(null, 'bbc-news');
        } catch (NewsApiException $e) {
            echo $e->errorMessage();
            return null;
        }
        return $this->fetchArticles($articles);
    }

    public function fetchByCountry(string $country): ?ArticleCollection
    {
        try {
            $articles = $this->api->getTopHeadLines(null, null, $country);
        } catch (NewsApiException $e) {
            echo $e->errorMessage();
            return null;
        }
        return $this->fetchArticles($articles);
    }

    public function fetchFilteredArticles(
        string $headline,
        string $fromDate,
        string $toDate
    ): ?ArticleCollection
    {
        try {
            $articles = $this->api->getEverything(
                $headline,
                null,
                null,
                null,
                $fromDate,
                $toDate
            );
        } catch (NewsApiException $e) {
            echo $e->getMessage();
            return null;
        }
        return $this->fetchArticles($articles);
    }
}