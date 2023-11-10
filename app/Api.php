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

    public function __construct()
    {
        $this->api = new NewsApi($_ENV['API_KEY']);
    }

    public function fetchTopHeadlines(): ?ArticleCollection
    {
        try {
            $articles = $this->api->getTopHeadLines(null, 'bbc-news');
        } catch (NewsApiException $e) {
            echo $e->errorMessage();
            return null;
        }

        $articleCollection = new ArticleCollection();

        foreach ($articles->articles as $article) {
            $articleCollection->add(new Article(
                $article->title,
                $article->description,
                $article->author,
                $article->url,
                $article->urlToImage,
                Carbon::parse($article->publishedAt)
            ));
        }

        return $articleCollection;
    }

    public function fetchByCountry(string $country): ?ArticleCollection
    {
        try {
            $articles = $this->api->getTopHeadLines(null, null, $country);
        } catch (NewsApiException $e) {
            echo $e->errorMessage();
            return null;
        }

        $articleCollection = new ArticleCollection();

        foreach($articles->articles as $article) {
            $articleCollection->add(new Article(
                $article->title,
                $article->description,
                $article->author,
                $article->url,
                $article->urlToImage,
                Carbon::parse($article->publishedAt)
            ));
        }

        return $articleCollection;
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

//        echo '<pre>';
//        var_dump($articles);

        $articleCollection = new ArticleCollection();

        foreach($articles->articles as $article) {
            $articleCollection->add(new Article(
                $article->title,
                $article->description,
                $article->author,
                $article->url,
                $article->urlToImage,
                Carbon::parse($article->publishedAt)
            ));
        }

        return $articleCollection;
    }
}