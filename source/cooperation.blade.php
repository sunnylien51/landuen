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
            $steps = [
                [
                    'id' => 'step-01',
                    'num' => '01',
                    'en' => 'CONSULTATION',
                    'title' => '需求訪談',
                    'body' => [
                        '國內電商爆款策略：深入分析品牌定位、機能需求與視覺風格，結合市場大數據（如開箱話題、捲包床技術），提供高變現力的產品行銷建議。',
                        '跨境外貿戰略：對接歐美極簡美學與美規尺寸（Amazon 爆款規格），提供 CFR 1633 阻燃法規諮詢與裝櫃空間最佳化建議，大幅降低跨國物流成本。',
                    ],
                    'img' => 'process1.jpg',
                ],
                [
                    'id' => 'step-02',
                    'num' => '02',
                    'en' => 'SPECIFICATION',
                    'title' => '規格與結構確認',
                    'body' => [
                        'OEM / ODM 頂級代工：精準對接國際尺寸與環保認證材料，進行真空壓縮捲包（Roll-pack）疲勞測試與裝櫃容積率計算，確保 100% 回彈並極大化運費效益。',
                        '專屬研發提案：融合歐美美學、人體工學與美規阻燃標準，打造兼具合規、高利潤與話題性的跨境爆款。',
                    ],
                    'img' => 'process2.jpg',
                ],
                [
                    'id' => 'step-03',
                    'num' => '03',
                    'en' => 'PROTOTYPING',
                    'title' => '產品打樣',
                    'body' => [
                        '打造 1:1 實體樣品進行外觀、舒適度與支撐力評估。',
                        '通過實驗室模擬 long-haul 海運高壓壓縮與防破損測試，確保抵達海外消費者手中時能完美瞬間回彈。',
                    ],
                    'img' => 'process3.jpg',
                ],
                [
                    'id' => 'step-04',
                    'num' => '04',
                    'en' => 'SAMPLE REVIEW',
                    'title' => '樣品確認',
                    'body' => [
                        '依客戶回饋調整產品細節，確認最終規格與設計。',
                    ],
                    'img' => 'process4.jpg',
                ],
                [
                    'id' => 'step-05',
                    'num' => '05',
                    'en' => 'PRODUCTION TEST',
                    'title' => '智慧量產與極限測試',
                    'body' => [
                        '匠人與科技結合：46 年經驗資深工程師監修，搭配智慧化工廠嚴格控管。',
                        'ISO 質量與雙重防燃：落實全程數據化品質監控，符合美英雙重防燃標準（CFR 1633 / BS 7177），確保結構長效不塌陷。',
                    ],
                    'img' => 'process5.jpg',
                ],
                [
                    'id' => 'step-06',
                    'num' => '06',
                    'en' => 'TERMS',
                    'title' => '交易條件確認',
                    'body' => [
                        '確認階梯報價、付款條件、生產交期、國際防摔包裝與 FOB/CIF 物流渠道，簽訂透明合規的國際貿易合約，控管隱形成本。',
                    ],
                    'img' => 'process6.jpg',
                ],
                [
                    'id' => 'step-07',
                    'num' => '07',
                    'en' => 'MANUFACTURING',
                    'title' => '下單生產',
                    'body' => [
                        '接單後啟動 SMART AUTOMATIC 自動化流水線與 SAP ERP 智慧排產，進行規模化量產，確保高良率與準時交貨。',
                    ],
                    'img' => 'process7.jpg',
                ],
                [
                    'id' => 'step-08',
                    'num' => '08',
                    'en' => 'DELIVERY',
                    'title' => '檢驗與交貨',
                    'body' => [
                        '從產線到港口，全程零風險。逐床品質複檢、全自動壓縮包裝，無縫銜接 FOB/CIF 海運報關。',
                    ],
                    'img' => 'process8.jpg',
                ],
            ];
        @endphp

        <section class="layout-grid layout-grid--fluid pt-10 md:pt-14 lg:pt-20 pb-20 lg:pb-36 flex flex-col gap-16 lg:gap-32" data-process-flow>
            {{-- 導言 --}}
            <div class="w-full flex flex-col items-center gap-5 pt-10 pb-5" data-aos="fade-up">
                <div class="w-12 h-[3px] bg-main3" aria-hidden="true"></div>
                <h2 class="text-ch4 text-gray5 text-center max-w-4xl">
                    從市場需求、產品研發到智慧製造與全球物流，<br class="hidden md:inline">
                    蘭頓提供完整的一站式床墊 OEM／ODM 代工服務。
                </h2>
            </div>

            {{-- 手機橫向錨點 --}}
            <nav
                class="lg:hidden -mx-6 md:-mx-12 px-6 md:px-12 sticky top-0 z-20 bg-white/95 backdrop-blur-sm border-b border-gray2 overflow-x-auto"
                aria-label="床墊代工流程"
                data-process-nav-mobile
            >
                <ul class="flex items-center gap-1 min-w-max py-3">
                    @foreach ($steps as $step)
                        <li>
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
                                @foreach ($steps as $step)
                                    <div class="h-[1em]">{{ $step['num'] }}</div>
                                @endforeach
                            </div>
                        </div>
                        <span class="text-eb3 text-main3">/ {{ sprintf('%02d', count($steps)) }}</span>
                    </div>
                </div>

                <div class="flex-1 min-w-0">
                    @foreach ($steps as $i => $step)
                        <article
                            id="{{ $step['id'] }}"
                            data-process-step
                            class="lg:min-h-[80vh] grid grid-cols-1 lg:grid-cols-2 min-[1440px]:grid-cols-[minmax(0,5fr)_minmax(0,7fr)] items-center gap-8 lg:gap-12 min-[1440px]:gap-20 py-12 md:py-16 lg:py-24 scroll-mt-24 lg:scroll-mt-10 {{ $i ? 'border-t border-gray1' : '' }}"
                        >
                            <div class="flex flex-col gap-5 lg:gap-6">
                                <div class="flex items-center gap-4">
                                    <span class="w-10 h-px bg-main3" aria-hidden="true"></span>
                                    <span class="text-eb3 text-main3"><span class="lg:hidden">{{ $step['num'] }} · </span>{{ $step['en'] }}</span>
                                </div>
                                <h3 class="text-ch4 min-[1600px]:text-ch3 text-gray5">{{ $step['title'] }}</h3>
                                <div class="flex flex-col gap-5 max-w-md">
                                    @foreach ($step['body'] as $para)
                                        @php [$lead, $rest] = array_pad(explode('：', $para, 2), 2, null); @endphp
                                        @if ($rest)
                                            <div class="flex flex-col gap-1.5">
                                                <p class="text-cb2 text-gray5">{{ $lead }}</p>
                                                <p class="text-cb2 text-gray4">{{ $rest }}</p>
                                            </div>
                                        @else
                                            <p class="text-cb2 text-gray4">{{ $para }}</p>
                                        @endif
                                    @endforeach
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
                                <div class="absolute inset-0 bg-gradient-to-t from-overlay/30 to-transparent pointer-events-none" aria-hidden="true"></div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
