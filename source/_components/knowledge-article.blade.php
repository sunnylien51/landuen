@php
    $knowledgeKeys = array_keys($page->knowledgeArticles ?? []);
    $knowledgeIndex = array_search($article['slug'] ?? '', $knowledgeKeys, true);
    $articleNum = sprintf('%02d', $knowledgeIndex === false ? 1 : $knowledgeIndex + 1);
    $articleTitle = $article['title'] ?? '';
    $crumbTitle = mb_strlen($articleTitle) > 6
        ? mb_substr($articleTitle, 0, 6) . '...'
        : $articleTitle;
@endphp
@include('_components.page-banner', [
    'enTitle' => 'KNOWLEDGE',
    'crumbs' => [
        ['name' => '床墊知識', 'link' => $page->baseUrl . '/knowledge/'],
        ['name' => $crumbTitle],
    ],
])

<div class="content-panel content-panel--plain">
    <section class="layout-grid pt-10 md:pt-14 lg:pt-20 pb-20 lg:pb-36 flex justify-center">
        <div class="w-full max-w-4xl min-w-0 flex flex-col gap-10 lg:gap-14">
            {{-- 標題／摘要：來自 config；編號依排序自動帶出 --}}
            <header class="w-full flex flex-col gap-8" data-aos="fade-up">
                <div class="flex items-center gap-4">
                    <span class="w-10 h-px bg-main3" aria-hidden="true"></span>
                    <span class="text-eb3 text-main3">{{ $articleNum }}</span>
                </div>
                <h1 class="text-ch4 lg:text-ch3 lg:leading-[1.5] text-gray5 tracking-widest">{{ $article['title'] }}</h1>
                <p class="text-cb2 text-gray4 w-full py-5 px-5 md:py-6 md:px-[28px] bg-gray1 rounded-[8px]">{{ $article['excerpt'] }}</p>
                @if (!empty($article['img']))
                    <div class="relative w-full aspect-[16/10] md:aspect-[2/1] bg-gray1 overflow-hidden about-media-tl">
                        <img
                            src="{{ $page->baseUrl }}/images/{{ $article['img'] }}"
                            alt="{{ $article['title'] }}"
                            class="w-full h-full object-cover object-center"
                            loading="lazy"
                            decoding="async"
                        >
                        <div class="absolute inset-0 bg-overlay/10 pointer-events-none" aria-hidden="true"></div>
                    </div>
                @endif
            </header>

            {{-- 內文：各篇文章 blade 傳入的富文本 HTML --}}
            <article class="knowledge-richtext" data-aos="fade-up">
                {!! $slot !!}
            </article>

            {{-- B2B 轉化引導模組 --}}
            <div class="mt-8 p-8 md:p-10 bg-gray1 rounded-2xl flex flex-col md:flex-row items-center justify-between gap-6" data-aos="fade-up">
                <div class="flex flex-col gap-2 text-center md:text-left">
                    <div class="inline-flex items-center justify-center md:justify-start gap-2 text-eb3 text-main3 uppercase">
                        <span aria-hidden="true">/</span>
                        <span>OEM • ODM SOLUTION</span>
                        <span aria-hidden="true">/</span>
                    </div>
                    <h3 class="text-ch4 text-main1 tracking-wide">正在規劃具備市場說服力的高端床墊系列？</h3>
                    <p class="text-cb2 text-gray4 max-w-xl">
                        蘭頓提供客製化人因結構研發、高規格打樣測試與國際認證支援，為您的品牌築起技術護城河。
                    </p>
                </div>
                <a href="{{ $page->baseUrl }}/contact/" class="btn shrink-0 px-7 py-3">
                    <span>洽詢研發打樣</span>
                    <i data-lucide="arrow-up-right" class="w-4 h-4" aria-hidden="true"></i>
                </a>
            </div>

            <div class="pt-4">
                <a href="{{ $page->baseUrl }}/knowledge/" class="btn-outline shadow-none">
                    <i data-lucide="arrow-left" class="w-4 h-4" aria-hidden="true"></i>
                    <span>返回床墊知識</span>
                </a>
            </div>
        </div>
    </section>
</div>
