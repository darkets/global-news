<?php
declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;

class Article
{
    const PLACEHOLDER_IMAGE_URL = 'https://i0.wp.com/thinkfirstcommunication.com/wp-content/uploads/2022/05/placeholder-1-1.png?fit=1200%2C800&ssl=1';

    private ?string $title;
    private ?string $description;
    private ?string $author;
    private ?string $url;
    private ?string $urlToImage;
    private ?Carbon $publishedAt;

    public function __construct(
        string $title,
        ?string $description,
        ?string $author,
        string $url,
        ?string $urlToImage,
        ?Carbon $publishedAt
    )
    {
        $this->title = $title;
        $this->description = $description;
        $this->author = $author;
        $this->url = $url;
        $this->urlToImage = $urlToImage;
        $this->publishedAt = $publishedAt;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description ?? 'No Description';
    }

    public function getAuthor(): string
    {
        return $this->author ?? 'Unknown';
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getUrlToImage(): string
    {
        return $this->urlToImage ?? $this::PLACEHOLDER_IMAGE_URL;
    }

    public function getPublishedAt(): Carbon
    {
        return $this->publishedAt;
    }
}