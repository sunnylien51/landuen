---
title: 品質永續
description: 蘭頓品質永續——ISO 認證、碳足跡標籤與耐久測試
---
@extends('_layouts.main')

@section('body')
    @include('_components.page-banner', [
        'enTitle' => 'ABOUT',
        'crumbs' => [
            ['name' => '關於蘭頓', 'link' => $page->baseUrl . '/about/'],
            ['name' => '品質永續'],
        ],
    ])

    <div class="content-panel">
        @include('_components.about-subnav', ['active' => 'quality'])

        <div class="layout-grid pt-10 md:pt-14 pb-20 lg:pb-36 flex flex-col gap-20 lg:gap-[130px]">
            <section class="w-full flex flex-col gap-12 lg:gap-16" data-aos="fade-up">
                <div class="w-full grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-20 lg:items-center">
                    <div class="lg:col-span-5 flex flex-col gap-6 lg:gap-8 min-w-0">
                        <div class="section-title">
                            <div class="section-title-eyebrow section-title-eyebrow--upper">
                                <span aria-hidden="true">/</span>
                                <span>Quality &amp; Sustainability</span>
                                <span aria-hidden="true">/</span>
                            </div>
                            <h2 class="section-title-heading">
                                國際標準 <span class="text-main2">×</span> 綠色承諾
                            </h2>
                        </div>
                        <p class="text-cb2 text-gray4">
                            一張真正的好床，禁得起時間與科學數據的嚴苛檢視。蘭頓企業堅持以國際最高標準落實品質控管，並將企業社會責任（CSR）與綠色低碳製程融入每一張床墊的生命週期中，實現真正的永續承諾。
                        </p>
                    </div>
                    <div class="lg:col-span-7 min-w-0 overflow-hidden aspect-[4/3] about-media-tl">
                        <img
                            src="{{ $page->baseUrl }}/images/mit_link4.jpg"
                            alt="品質永續"
                            class="w-full h-full object-cover"
                        >
                    </div>
                </div>

                <div class="w-full flex flex-col">
                    @php
                        $blocks = [
                            [
                                'num' => '01',
                                'title' => '雙重國際權威認證',
                                'subtitle' => 'ISO-9001 與 ISPA 國際雙認證',
                                'body' => '連續逾 20 年通過 ISO-9001 國際品質管理體系認證，從管理、生產到出貨皆具備嚴密規範；並具備 ISPA 國際睡眠產品協會認證，與全球頂尖睡眠產業標準接軌。',
                            ],
                            [
                                'num' => '02',
                                'title' => '台灣首創綠色低碳標竿',
                                'subtitle' => '環境部產品碳足跡標籤認證',
                                'body' => '成為台灣首家榮獲國家環境部「產品碳足跡標籤」驗證的床墊製造商。透過生命週期評估（LCA）追溯從原料開採、製造到運輸的碳排放量，全面實踐低碳製程，落實循環經濟。',
                            ],
                            [
                                'num' => '03',
                                'title' => '十年耐久模擬測試',
                                'subtitle' => '150kg 睡眠機器人 8 萬次動態碾壓',
                                'body' => '與國際第三方權威檢測機構深度合作，引進高規格的耐久性模擬測試設備。模擬 150 公斤重之睡眠機器人，於床墊上進行高達 8 萬次的動態滾動與強力碾壓，以嚴苛的科學化數據確保床墊結構十年如一日。',
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
                            <div class="lg:col-span-7 min-w-0">
                                <p class="text-cb2 text-gray4">{{ $block['body'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            @include('_components.about-pillars')
        </div>
    </div>
@endsection
