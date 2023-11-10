<?php

namespace App\Controllers;

use App\Api;
use App\Response;

class CountryController
{
    private Api $api;

    public function __construct()
    {
        $this->api = new Api();
    }

    public function index(): Response
    {
        $country = $_GET['country'] ?? '';

        return new Response('articles/index', [
            'header' => "Headlines in $country",
            'articles' => $this->api->fetchByCountry($country)->get(),
        ]);
    }
}