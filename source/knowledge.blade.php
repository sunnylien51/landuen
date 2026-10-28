---
title: 床墊知識
description: 床墊知識——結構、材質與睡眠科學
---
@extends('_layouts.main')

@section('body')
    @include('_components.page-banner', [
        'enTitle' => 'KNOWLEDGE',
        'crumbs' => [
            ['name' => '床墊知識'],
        ],
    ])

    <div class="content-panel content-panel--plain">
        <section class="layout-grid inner-page-padding flex flex-col gap-16 lg:gap-20">
            @foreach ($page->knowledgeArticles as $article)
                <article
                    class="w-full flex flex-col lg:flex-row lg:items-start gap-8 lg:gap-16 xl:gap-20"
                    data-aos="fade-up"
                >
                    <div
                        class="w-full lg:w-[min(100%,620px)] lg:max-w-[48%] shrink-0 h-64 md:h-80 lg:h-96 bg-gray1 overflow-hidden flex flex-col justify-center items-center {{ $loop->index % 2 ? 'about-media-tr' : 'about-media-tl' }}"
                    >
                        <p class="text-cb3 text-gray4">待換（示意圖）</p>
                    </div>

                    <div class="flex-1 min-w-0 pt-0 lg:pt-6 flex flex-col gap-8 lg:gap-10">
                        <p class="font-display text-[72px] leading-none text-gray2" aria-hidden="true">{{ $article['num'] }}</p>

                        <div class="flex flex-col gap-6 lg:gap-7">
                            <div class="flex flex-col gap-4">
                                <h2 class="text-ch4 text-gray5 tracking-widest">{{ $article['title'] }}</h2>
                                <p class="text-cb2 text-gray4 line-clamp-2">{{ $article['excerpt'] }}</p>
                            </div>

                            <a
                                href="{{ $page->baseUrl }}/knowledge/{{ $article['slug'] }}/"
                                class="btn-back-top w-40 py-[10px] justify-between pl-6 pr-5 shadow-none"
                            >
                                <span>閱讀全文</span>
                                <i data-lucide="arrow-up-right" class="w-4 h-4" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>
    </div>
@endsection
