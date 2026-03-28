<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class JsonLd extends Component
{
    public function __construct(
        public string $type = 'Article',
        public ?string $title = null,
        public ?string $description = null,
        public ?string $image = null,
        public ?string $url = null,
        public ?string $datePublished = null,
        public ?string $dateModified = null,
        public ?string $author = null,
        public ?string $publisher = null,
        public ?string $address = null,
        public ?string $telephone = null,
        public ?string $priceRange = null,
        public ?array $geo = null,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.json-ld', [
            'type' => $this->type,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'url' => $this->url ?? url()->current(),
            'datePublished' => $this->datePublished,
            'dateModified' => $this->dateModified,
            'author' => $this->author,
            'publisher' => $this->publisher,
            'address' => $this->address,
            'telephone' => $this->telephone,
            'priceRange' => $this->priceRange,
            'geo' => $this->geo,
        ]);
    }
}
