---
title: 合作方式
description: 蘭頓企業合作方式——從需求訪談到檢驗交貨的一站式床墊 OEM／ODM 代工流程
---
@extends('_layouts.main')

@section('body')
    @include('_components.page-banner', [
        'enTitle' => 'COOPERATION',
        'crumbs' => [
            ['name' => '合作方式'],
        ],
    ])

    <div class="content-panel">
        @php
            $steps = $page->cooperationSteps ?? [];
        @endphp

        <section class="layout-grid layout-grid--fluid inner-page-padding flex flex-col gap-12 lg:gap-16" data-process-flow>
            @include('_components.page-intro', [
                'title' => $page->pageIntros['cooperation']['title'] ?? '',
                'body' => $page->pageIntros['cooperation']['body'] ?? '',
            ])

            {{-- 手機橫向錨點（translateY 置頂；content-panel overflow 無法用 sticky） --}}
            <div class="lg:hidden -mx-6 md:-mx-12" data-process-nav-mobile-wrap>
                <nav
                    class="process-nav-mobile relative hide-scrollbar z-20 bg-white/95 backdrop-blur-sm overflow-x-auto px-6 md:px-12 will-change-transform"
                    aria-label="床墊代工流程"
                    data-process-nav-mobile
                    data-drag-scroll="free"
                >
                    <ul class="flex items-center gap-1 min-w-max py-3">
                        @foreach ($steps as $step)
                            <li class="shrink-0" data-drag-scroll-item>
                                <a
                                    href="#{{ $step['id'] }}"
                                    data-process-link
                                    data-process-id="{{ $step['id'] }}"
                                    class="process-nav-link px-3 py-1.5 text-cb3 whitespace-nowrap"
                                >
                                    <span class="process-nav-dash" aria-hidden="true"></span>
                                    <span>{{ $step['title'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>

            {{-- 左側壁掛與中間計數器：JS translateY（保留 content-panel overflow，banner 效果才正常） --}}
            <div class="w-full flex border-t border-gray1" data-process-rail>
                <div class="hidden lg:block w-52 shrink-0 ">
                    <aside class="pb-14 will-change-transform" data-process-aside>
                        <p class="text-cb1 text-gray5 pb-6 mb-6 border-b border-gray1">床墊代工流程</p>
                        <nav aria-label="床墊代工流程" data-process-nav>
                            <ul class="flex flex-col gap-2.5">
                                @foreach ($steps as $step)
                                    <li>
                                        <a
                                            href="#{{ $step['id'] }}"
                                            data-process-link
                                            data-process-id="{{ $step['id'] }}"
                                            class="process-nav-link text-cb2"
                                        >
                                            <span class="process-nav-dash" aria-hidden="true"></span>
                                            <span>{{ $step['title'] }}</span>
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
                                @foreach ($steps as $i => $step)
                                    <div class="h-[1em]">{{ sprintf('%02d', $i + 1) }}</div>
                                @endforeach
                            </div>
                        </div>
                        <span class="text-eb3 text-main3">STEP</span>
                    </div>
                </div>

                <div class="flex-1 min-w-0">
                    @foreach ($steps as $i => $step)
                        @php
                            $stepNum = sprintf('%02d', $i + 1);
                        @endphp
                        <article
                            id="{{ $step['id'] }}"
                            data-process-step
                            class="lg:min-h-[80vh] grid grid-cols-1 lg:grid-cols-2 min-[1440px]:grid-cols-[minmax(0,5fr)_minmax(0,7fr)] items-center gap-8 lg:gap-12 min-[1440px]:gap-20 py-12 md:py-16 lg:py-24 scroll-mt-24 lg:scroll-mt-10 {{ $i ? 'border-t border-gray1' : '' }}"
                        >
                            <div class="flex flex-col gap-5 lg:gap-6">
                                <div class="flex items-center gap-4">
                                    <span class="w-10 h-px bg-main3" aria-hidden="true"></span>
                                    <span class="text-eb3 text-main3"><span class="lg:hidden">{{ $stepNum }} · </span>{{ $step['en'] }}</span>
                                </div>
                                <h3 class="text-ch4 min-[1600px]:text-ch3 text-gray5">{{ $step['title'] }}</h3>
                                <div class="cooperation-step-body">
                                    {!! $step['bodyHtml'] ?? '' !!}
                                </div>
                            </div>
                            <div class="relative h-72 md:h-[420px] lg:h-[52vh] min-[1440px]:h-[62vh] overflow-hidden {{ $i % 2 ? 'about-media-tl' : 'about-media-tr' }}">
                                <div class="absolute inset-x-0 -top-[3%] h-[106%] will-change-transform" data-process-parallax>
                                    <img
                                        src="{{ $page->baseUrl }}/images/{{ $step['img'] }}"
                                        alt="{{ $step['title'] }}"
                                        class="size-full object-cover"
                                        loading="lazy"
                                    >
                                </div>
                                <div class="absolute inset-0 bg-overlay/10 pointer-events-none" aria-hidden="true"></div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
