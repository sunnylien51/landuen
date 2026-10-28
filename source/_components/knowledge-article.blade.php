@include('_components.page-banner', [
    'enTitle' => 'KNOWLEDGE',
    'crumbs' => [
        ['name' => '床墊知識', 'link' => $page->baseUrl . '/knowledge/'],
        ['name' => '文章 ' . $article['num']],
    ],
])

<div class="content-panel content-panel--plain">
    <section class="layout-grid pt-10 md:pt-14 lg:pt-20 pb-20 lg:pb-36 flex justify-center">
        <div class="w-full max-w-4xl min-w-0 flex flex-col gap-10 lg:gap-14">
            {{-- 標題／摘要：來自 config（之後可改接後台欄位） --}}
            <header class="w-full flex flex-col gap-8" data-aos="fade-up">
                <div class="flex items-center gap-4">
                    <span class="w-10 h-px bg-main3" aria-hidden="true"></span>
                    <span class="text-eb3 text-main3">{{ $article['num'] }}</span>
                </div>
                <h1 class="text-ch4 lg:text-ch3 lg:leading-[1.5] text-gray5 tracking-widest">{{ $article['title'] }}</h1>
                <p class="text-cb2 text-gray4 w-full py-5 px-5 md:py-6 md:px-[28px] bg-gray1 rounded-[8px]">{{ $article['excerpt'] }}</p>
            </header>

            {{-- 內文：各篇文章 blade 傳入的富文本 HTML --}}
            <article class="knowledge-richtext" data-aos="fade-up">
                {!! $slot !!}
            </article>

            <div class="pt-4">
                <a href="{{ $page->baseUrl }}/knowledge/" class="btn-back-top shadow-none">
                    <i data-lucide="arrow-left" class="w-4 h-4" aria-hidden="true"></i>
                    <span>返回床墊知識</span>
                </a>
            </div>
        </div>
    </section>
</div>
