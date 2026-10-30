---
title: 材料介紹
description: 蘭頓床墊材料介紹——布料、泡綿、彈簧、乳膠、新世代材料與 PUR 熱熔膠六大系統
---
@extends('_layouts.main')

@section('body')
    @include('_components.page-banner', [
        'enTitle' => 'MATERIALS',
        'crumbs' => [
            ['name' => '材料介紹'],
        ],
    ])

    <div class="content-panel content-panel--plain">
        @php
            $systems = $page->materialSystems;
        @endphp

        <section class="layout-grid layout-grid--fluid inner-page-padding flex flex-col gap-16 lg:gap-24" data-process-flow>
            @include('_components.page-intro', [
                'title' => $page->pageIntros['materials']['title'] ?? '',
                'body' => $page->pageIntros['materials']['body'] ?? '',
            ])

            {{-- 剖面床：對應六大系統的整體結構示意（與首頁共用素材／動效） --}}
            <div class="w-full relative flex flex-col items-center" data-aos="fade-up">
                <div class="relative z-10 w-full max-w-[1200px]" data-mit-stage>
                    <div
                        class="mit-watermark pointer-events-none absolute left-1/2 top-[65%] font-display text-[clamp(3rem,12vw,8.2rem)] leading-none tracking-[0.035em] select-none whitespace-nowrap will-change-transform"
                        data-mit-watermark
                        aria-hidden="true"
                    >
                        MADE IN TAIWAN
                    </div>
                    <div class="relative z-10 w-full will-change-transform" data-mit-mattress>
                        <div class="mit-mattress-float relative w-full" data-mit-float>
                            <img
                                src="{{ $page->baseUrl }}/images/mattress.webp"
                                alt="床墊剖面結構與六大材料系統"
                                class="block w-full h-auto"
                            >
                            <img
                                src="{{ $page->baseUrl }}/images/mattress_intro.svg"
                                alt=""
                                class="mit-intro absolute inset-0 size-full object-contain pointer-events-none"
                                data-mit-intro
                                aria-hidden="true"
                            >
                        </div>
                    </div>
                </div>
            </div>

            {{-- 手機橫向錨點（translateY 置頂；content-panel overflow 無法用 sticky） --}}
            <div class="lg:hidden -mx-6 md:-mx-12" data-process-nav-mobile-wrap>
                <nav
                    class="process-nav-mobile relative hide-scrollbar z-20 bg-white/95 backdrop-blur-sm overflow-x-auto px-6 md:px-12 will-change-transform"
                    aria-label="材料系統"
                    data-process-nav-mobile
                    data-drag-scroll="free"
                >
                    <ul class="flex items-center gap-1 min-w-max py-3">
                        @foreach ($systems as $system)
                            <li class="shrink-0" data-drag-scroll-item>
                                <a
                                    href="#{{ $system['id'] }}"
                                    data-process-link
                                    data-process-id="{{ $system['id'] }}"
                                    class="process-nav-link px-3 py-1.5 text-cb3 whitespace-nowrap"
                                >
                                    <span class="process-nav-dash" aria-hidden="true"></span>
                                    <span>{{ $system['title'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>

            <div class="w-full flex border-t border-gray1" data-process-rail>
                <div class="hidden lg:block w-52 shrink-0">
                    <aside class="pb-14 will-change-transform" data-process-aside>
                        <p class="text-cb1 text-gray5 pb-6 mb-6 border-b border-gray1">材料系統</p>
                        <nav aria-label="材料系統" data-process-nav>
                            <ul class="flex flex-col gap-2.5">
                                @foreach ($systems as $system)
                                    <li>
                                        <a
                                            href="#{{ $system['id'] }}"
                                            data-process-link
                                            data-process-id="{{ $system['id'] }}"
                                            class="process-nav-link text-cb2"
                                        >
                                            <span class="process-nav-dash" aria-hidden="true"></span>
                                            <span>{{ $system['title'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </aside>
                </div>

                <div class="hidden lg:flex relative w-32 min-[1440px]:w-48 shrink-0 justify-center" aria-hidden="true">
                    <span class="process-gutter-line absolute inset-y-0 left-1/2 w-px bg-gray1" data-process-line></span>
                    <div class="h-fit flex flex-col items-center gap-3 will-change-transform" data-process-counter-wrap>
                        <div class="process-counter font-display text-[72px] text-center leading-none text-gray2">
                            <div class="process-counter-strip" data-process-counter>
                                @foreach ($systems as $i => $system)
                                    <div class="h-[1em]">{{ sprintf('%02d', $i + 1) }}</div>
                                @endforeach
                            </div>
                        </div>
                        <span class="text-eb3 text-main3">/ {{ sprintf('%02d', count($systems)) }}</span>
                    </div>
                </div>

                <div class="flex-1 min-w-0">
                    @foreach ($systems as $i => $system)
                        <article
                            id="{{ $system['id'] }}"
                            data-process-step
                            class="flex flex-col gap-8 lg:gap-10 py-12 md:py-16 lg:py-24 scroll-mt-24 lg:scroll-mt-10 {{ $i ? 'border-t border-gray1' : '' }}"
                        >
                            <div class="flex flex-col md:flex-row md:items-center gap-8 lg:gap-12 xl:gap-16">
                                <div class="flex-1 min-w-0 flex flex-col gap-5 lg:gap-6">
                                    <div class="flex items-center gap-4">
                                        <span class="w-10 h-px bg-main3" aria-hidden="true"></span>
                                        <span class="text-eb3 text-main3"><span class="lg:hidden">{{ sprintf('%02d', $i + 1) }} · </span>{{ $system['en'] }}</span>
                                    </div>
                                    <h3 class="text-ch4 min-[1600px]:text-ch3 text-gray5">{{ $system['title'] }}</h3>
                                    <p class="text-cb2 text-gray4">{{ $system['intro'] }}</p>
                                </div>

                                @if (!empty($system['img']))
                                    <div class="shrink-0 w-full md:w-60 lg:w-64 xl:w-72 aspect-[4/3.2] overflow-hidden rounded-tl-[130px] rounded-[8px] bg-gray1">
                                        <img
                                            src="{{ $page->baseUrl }}/images/{{ $system['img'] }}"
                                            alt="{{ $system['title'] }}"
                                            class="size-full object-cover"
                                            loading="lazy"
                                            decoding="async"
                                        >
                                    </div>
                                @endif
                            </div>

                            @if (!empty($system['items']))
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-0.5 overflow-hidden">
                                    @foreach ($system['items'] as $item)
                                        <div class="flex flex-col gap-0.5 p-6 bg-bg rounded-2xl lg:rounded-[16px]">
                                            <p class="text-cb1 text-gray5">{{ $item['title'] }}</p>
                                            <p class="text-cb3 text-gray4">{{ $item['body'] }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <a
                                href="{{ $page->baseUrl }}/files/{{ $system['pdf'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="btn btn--main2 w-fit px-8 py-2.5"
                            >
                                <span>查看詳細說明</span>
                                <i data-lucide="arrow-up-right" class="w-4 h-4" aria-hidden="true"></i>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
