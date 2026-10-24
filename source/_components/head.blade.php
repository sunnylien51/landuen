<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="canonical" href="{{ $page->getUrl() }}">
<title>{{ $page->title ? $page->title . ' | ' . $page->siteName : $page->siteName }}</title>
<meta name="description" content="{{ $page->description ?? $page->siteDescription }}">

<link rel="icon" type="image/png" href="{{ $page->baseUrl }}/images/favicon.png">
<link rel="apple-touch-icon" href="{{ $page->baseUrl }}/images/favicon.png">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@400;500;600;700&family=Noto+Serif+TC:wght@400;500;600;700&family=Tenor+Sans&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

@viteRefresh()
<link rel="stylesheet" href="{{ vite('source/_assets/css/main.css', '/static') }}">
<script defer type="module" src="{{ vite('source/_assets/js/main.js', '/static') }}"></script>

<script src="https://unpkg.com/lucide@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://unpkg.com/@studio-freight/lenis@1.0.34/dist/lenis.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
