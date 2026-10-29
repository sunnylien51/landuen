@php
    $bannerImage = $image ?? 'banner_default.jpg';
@endphp
{{-- sticky：中段往上蓋過；內層視差 + 模糊（同首頁 hero） --}}
<section
    class="page-banner sticky top-0 z-0 w-full overflow-hidden"
    data-page-hero
>
    <div id="page-banner-motion" class="absolute inset-0 flex flex-col justify-center items-center will-change-transform">
        <img
            src="{{ $page->baseUrl }}/images/{{ $bannerImage }}"
            alt=""
            class="absolute inset-0 size-full object-cover object-center scale-110"
            aria-hidden="true"
        >
        <div class="absolute inset-0 bg-overlay/40 z-[1]" aria-hidden="true"></div>

        <div class="layout-grid relative z-10 w-full h-full flex flex-col justify-center items-center pb-8 md:pb-10">
            <div class="w-full flex flex-col items-center gap-3">
                @if (!empty($enTitle))
                    <h1 class="page-banner-title text-white text-center uppercase">
                        {{ $enTitle }}
                    </h1>
                @elseif (!empty($zhTitle))
                    <h1 class="page-banner-title page-banner-title--zh text-ch3 text-white text-center">{{ $zhTitle }}</h1>
                @endif

                <nav class="page-banner-crumbs flex flex-wrap items-center justify-center gap-2" aria-label="麵包屑">
                    <a
                        href="{{ $page->baseUrl }}/"
                        class="inline-flex text-white hover:opacity-80 transition-opacity"
                        aria-label="首頁"
                    >
                        <i data-lucide="home" class="w-4 h-4"></i>
                    </a>
                    @if (!empty($crumbs))
                        @foreach ($crumbs as $crumb)
                            <span class="text-cb3 text-white/40" aria-hidden="true">/</span>
                            @if (!empty($crumb['link']))
                                <a
                                    href="{{ $crumb['link'] }}"
                                    class="text-cb3 text-white hover:opacity-80 transition-opacity"
                                >{{ $crumb['name'] }}</a>
                            @else
                                <span class="text-cb3 text-white">{{ $crumb['name'] }}</span>
                            @endif
                        @endforeach
                    @endif
                </nav>
            </div>
        </div>
    </div>
</section>
