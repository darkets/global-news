<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Api;
use App\Response;

class FilterController
{
    private Api $api;

    public function __construct()
    {
        $this->api = new Api();
    }

    public function index(): Response
    {
        $headline = $_GET['headline'] ?? '';
        $fromDate = $_GET['from_date'] ?? '';
        $toDate = $_GET['to_date'] ?? '';

        $articles = $this->api->fetchFilteredArticles(
            $headline,
            $fromDate,
            $toDate,
        );

        return new Response('articles/index', [
            'header' => 'Filtered Articles',
            'articles' => $articles->get(),
        ]);
    }
}