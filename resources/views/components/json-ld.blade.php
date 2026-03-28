@php
$setting = app(\App\Models\Setting::class)::first();
$publisherName = $setting?->site_name ?? config('app.name');
$publisherLogo = $setting?->getFirstMediaUrl('logo') ?: asset('images/logo-lombok-timur.png');

$data = [];

if ($type === 'NewsArticle' || $type === 'Article') {
    $data = [
        '@context' => 'https://schema.org',
        '@type' => 'NewsArticle',
        'headline' => $title,
        'description' => Str::limit(strip_tags($description), 200),
        'url' => $url,
    ];
    if ($image) {
        $data['image'] = $image;
    }
    if ($datePublished) {
        $data['datePublished'] = $datePublished;
    }
    if ($dateModified) {
        $data['dateModified'] = $dateModified;
    }
    $data['author'] = [
        '@type' => $author ? 'Person' : 'Organization',
        'name' => $author ?? $publisherName
    ];
    $data['publisher'] = [
        '@type' => 'Organization',
        'name' => $publisherName,
        'logo' => [
            '@type' => 'ImageObject',
            'url' => $publisherLogo
        ]
    ];
    $data['mainEntityOfPage'] = [
        '@type' => 'WebPage',
        '@id' => $url
    ];
}

if ($type === 'TouristAttraction' || $type === 'Place') {
    $data = [
        '@context' => 'https://schema.org',
        '@type' => 'TouristAttraction',
        'name' => $title,
        'description' => Str::limit(strip_tags($description), 200),
        'url' => $url,
    ];
    if ($image) {
        $data['image'] = $image;
    }
    if ($address) {
        $data['address'] = [
            '@type' => 'PostalAddress',
            'addressLocality' => $address,
            'addressRegion' => 'Nusa Tenggara Barat',
            'addressCountry' => 'ID'
        ];
    }
    if ($geo && isset($geo['lat']) && isset($geo['lng'])) {
        $data['geo'] = [
            '@type' => 'GeoCoordinates',
            'latitude' => $geo['lat'],
            'longitude' => $geo['lng']
        ];
    }
    $data['touristType'] = ['Cultural', 'Nature'];
}

if ($type === 'GovernmentService' || $type === 'Service') {
    $data = [
        '@context' => 'https://schema.org',
        '@type' => 'GovernmentService',
        'name' => $title,
        'description' => Str::limit(strip_tags($description), 200),
        'url' => $url,
        'serviceType' => 'Public Service',
        'provider' => [
            '@type' => 'GovernmentOrganization',
            'name' => $publisherName
        ]
    ];
    if ($telephone) {
        $data['telephone'] = $telephone;
    }
}

if ($type === 'Event') {
    $data = [
        '@context' => 'https://schema.org',
        '@type' => 'Event',
        'name' => $title,
        'description' => Str::limit(strip_tags($description), 200),
        'url' => $url,
    ];
    if ($datePublished) {
        $data['startDate'] = $datePublished;
    }
    if ($dateModified) {
        $data['endDate'] = $dateModified;
    }
    if ($address) {
        $data['location'] = [
            '@type' => 'Place',
            'name' => $address
        ];
    }
    $data['organizer'] = [
        '@type' => 'Organization',
        'name' => $publisherName
    ];
}
@endphp

@if(!empty($data))
<script type="application/ld+json">{!! json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}</script>
@endif