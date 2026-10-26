---
title: 人因設計
description: 蘭頓人因設計——對應台灣氣候與居住環境的床墊設計
---
@extends('_layouts.main')

@section('body')
    @include('_components.page-banner', [
        'enTitle' => 'ABOUT',
        'crumbs' => [
            ['name' => '關於蘭頓', 'link' => $page->baseUrl . '/about/'],
            ['name' => '人因設計'],
        ],
    ])

    <div class="content-panel">
        @include('_components.about-subnav', ['active' => 'ergonomics'])

        <div class="layout-grid pt-10 md:pt-14 pb-20 lg:pb-36 flex flex-col gap-20 lg:gap-[130px]">
            <section class="w-full flex flex-col gap-12 lg:gap-16" data-aos="fade-up">
                {{-- 導言／清單共用 12 欄：右欄皆 col-span-7（約 58%），左右對齊 --}}
                <div class="w-full grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-20 lg:items-center">
                    <div class="lg:col-span-5 flex flex-col gap-6 lg:gap-8 min-w-0">
                        <div class="flex flex-col gap-3">
                            <div class="inline-flex items-center gap-3 text-eb2 text-main2 uppercase">
                                <span aria-hidden="true">/</span>
                                <span>Designed for Taiwan</span>
                                <span aria-hidden="true">/</span>
                            </div>
                            <h2 class="text-ch3 text-gray5">
                                在地氣候 <span class="text-main2">×</span> 舒適支撐
                            </h2>
                        </div>
                        <p class="text-cb2 text-gray4">
                            歐美進口床墊不一定適合台灣的氣候與居住環境。蘭頓企業深耕在地數十年，透過龐大的人體工學數據庫與環境科學研究，將台灣獨特的「高溫濕熱氣候」與「都會空間結構」轉化為底層設計邏輯，打造真正懂亞洲人的舒適支撐系統。
                        </p>
                    </div>
                    <div class="lg:col-span-7 min-w-0 overflow-hidden aspect-[4/3] about-media-tl">
                        <img
                            src="{{ $page->baseUrl }}/images/mit_link2.jpg"
                            alt="人因設計"
                            class="w-full h-full object-cover"
                        >
                    </div>
                </div>

                <div class="w-full flex flex-col">
                    @php
                        $blocks = [
                            [
                                'num' => '01',
                                'title' => '台灣氣候解剖學',
                                'subtitle' => '熱擴散優化與專利三維導流',
                                'points' => [
                                    ['label' => '熱擴散率優化', 'text' => '表布與表層採用高傳導瞬涼纖維，能快速帶走入睡初期的皮膚表面熱能。'],
                                    ['label' => '專利三維溝槽排濕結構', 'text' => '內部採用立體導流孔洞與三維溝槽設計，當人體在睡眠中翻動時，自動產生類似幫浦的擠壓效應，加速床體內部空氣對流。'],
                                    ['label' => '濕度鎖定機制', 'text' => '有效將睡眠微環境的相對濕度維持在最舒適的 50% 至 60% 區間，徹底告別黏膩悶熱的流汗惡夢。'],
                                ],
                            ],
                            [
                                'num' => '02',
                                'title' => '在地住宅空間力學',
                                'subtitle' => '強效護邊支撐與空間搬運優化',
                                'points' => [
                                    ['label' => '強效邊框抗折力學', 'text' => '針對現代人習慣坐在床緣穿鞋、或多人口家庭的側邊支撐需求，強化床體四週的硬式護邊結構，防止滑落與塌陷。'],
                                    ['label' => '空間搬運優化', 'text' => '考量台灣都會區大樓電梯、狹窄樓道與轉角的空間限制，優化床體結構的韌性與可彎曲度，完美兼顧居家搬運與長期使用的耐用度。'],
                                ],
                            ],
                        ];
                    @endphp
                    @foreach ($blocks as $i => $block)
                        <div class="w-full grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-20 py-8 lg:py-12 {{ $i > 0 ? 'border-t border-gray2' : '' }}">
                            <div class="lg:col-span-5 flex items-start gap-6 min-w-0">
                                <span class="font-display text-main2 tracking-wider shrink-0 pt-1">{{ $block['num'] }}</span>
                                <div class="flex flex-col gap-1 min-w-0">
                                    <h3 class="text-ch4 text-gray5 tracking-widest">{{ $block['title'] }}</h3>
                                    <p class="text-cb1 text-main2">{{ $block['subtitle'] }}</p>
                                </div>
                            </div>
                            <div class="lg:col-span-7 flex flex-col gap-5 min-w-0">
                                @foreach ($block['points'] as $point)
                                    <div class="flex flex-col gap-2">
                                        <p class="text-ch5 text-gray5 self-start border-b-2 border-gray2">{{ $point['label'] }}</p>
                                        <p class="text-cb2 text-gray4">{{ $point['text'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@endsection
