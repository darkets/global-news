<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Api;
use App\Response;

class ArticleController
{
    private Api $api;

    public function __construct()
    {
        $this->api = new Api();
    }
    public function index(): Response
    {
        return new Response('articles/index', [
            'header' => 'TOP NEWS!!!',
            'articles' => $this->api->fetchTopHeadlines()->get()
        ]);
    }
}