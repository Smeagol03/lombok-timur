@props([
    'title',
    'description',
    'keywords',
    'author',
    'noIndex' => false,
    'type' => 'website',
    'url',
    'image',
    'siteName',
    'publishedTime' => null,
    'modifiedTime' => null,
    'section' => null,
])

<!-- SEO Meta Tags -->
<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="author" content="{{ $author }}">
<meta name="robots" content="{{ $noIndex ? 'noindex, nofollow' : 'index, follow' }}">
<meta name="revisit-after" content="7 days">
<meta name="language" content="Indonesian">
<meta name="geo.region" content="ID-NB">
<meta name="geo.placename" content="Lombok Timur">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $type }}">
<meta property="og:url" content="{{ $url }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="id_ID">
@if($publishedTime)
<meta property="article:published_time" content="{{ $publishedTime }}">
@endif
@if($modifiedTime)
<meta property="article:modified_time" content="{{ $modifiedTime }}">
@endif
@if($section)
<meta property="article:section" content="{{ $section }}">
@endif

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ $url }}">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ $url }}">

@php
$setting = app(\App\Models\Setting::class)::first();
$logo = $setting?->getFirstMediaUrl('logo') ?: asset('images/logo-lombok-timur.png');
$phone = $setting?->contact_phone ?? '(0376) 21450';
$address = $setting?->contact_address ?? 'Selong, Kabupaten Lombok Timur, NTB';
$facebook = $setting?->social_facebook ?? 'https://facebook.com/pemkablomboktimur';
$instagram = $setting?->social_instagram ?? 'https://instagram.com/pemkablomboktimur';
$twitter = $setting?->social_twitter ?? 'https://twitter.com/lomboktimur';

$orgData = [
    '@context' => 'https://schema.org',
    '@type' => 'GovernmentOrganization',
    'name' => $siteName,
    'alternateName' => 'Pemkab Lombok Timur',
    'url' => url('/'),
    'logo' => $logo,
    'areaServed' => [
        '@type' => 'AdministrativeArea',
        'name' => 'Kabupaten Lombok Timur',
        'containedInPlace' => [
            '@type' => 'State',
            'name' => 'Nusa Tenggara Barat'
        ]
    ],
    'contactPoint' => [
        '@type' => 'ContactPoint',
        'telephone' => $phone,
        'contactType' => 'customer service',
        'areaServed' => 'ID',
        'availableLanguage' => ['Indonesian']
    ],
    'address' => $address,
    'sameAs' => [$facebook, $instagram, $twitter]
];
@endphp

<!-- Structured Data - Organization -->
<script type="application/ld+json">{{ json_encode($orgData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) }}</script>