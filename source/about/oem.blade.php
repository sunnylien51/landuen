---
title: 專業代工
description: 蘭頓專業代工——OEM／ODM／OBM 戰略合作與保密機制
---
@extends('_layouts.main')

@section('body')
    @include('_components.page-banner', [
        'enTitle' => 'ABOUT',
        'crumbs' => [
            ['name' => '關於蘭頓', 'link' => $page->baseUrl . '/about/'],
            ['name' => '專業代工'],
        ],
    ])

    <div class="content-panel">
        @include('_components.about-subnav', ['active' => 'oem'])

        <div class="layout-grid pt-10 md:pt-14 pb-20 lg:pb-36 flex flex-col gap-20 lg:gap-[130px]">
            <section class="w-full flex flex-col gap-12 lg:gap-16" data-aos="fade-up">
                <div class="w-full grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-20 lg:items-center">
                    <div class="lg:col-span-5 flex flex-col gap-6 lg:gap-8 min-w-0">
                        <div class="section-title">
                            <div class="section-title-eyebrow section-title-eyebrow--upper">
                                <span aria-hidden="true">/</span>
                                <span>OEM × ODM × OBM</span>
                                <span aria-hidden="true">/</span>
                            </div>
                            <h2 class="section-title-heading">
                                戰略供應鏈 <span class="text-main2">×</span> 彈性智造
                            </h2>
                        </div>
                        <p class="text-cb2 text-gray4">
                            貫徹嚴苛的品質標準與彈性智造，蘭頓企業不只是自有品牌的創造者，更是國際各大知名家具品牌、連鎖通路、建案旅宿與跨境電商背後最信賴的戰略供應鏈夥伴。我們提供從前端結構研發到大規模量產的全方位代工服務。
                        </p>
                    </div>
                    <div class="lg:col-span-7 min-w-0 overflow-hidden aspect-[4/3] about-media-tl">
                        <img
                            src="{{ $page->baseUrl }}/images/mit_link3.jpg"
                            alt="專業代工"
                            class="w-full h-full object-cover"
                        >
                    </div>
                </div>

                <div class="w-full flex flex-col">
                    @php
                        $blocks = [
                            [
                                'num' => '01',
                                'title' => 'OEM 高效精準代工',
                                'subtitle' => '自動化智能產線，確保穩定交期',
                                'body' => '依託工業 4.0 智慧工廠的龐大產能，我們為全球夥伴構築了高度自動化且穩定可靠的生產線。從嚴選原物料進場到成品最終出貨，每一步皆落實嚴格的標準化作業程序（SOP），確保在大規模訂單與緊迫交期交織的挑戰下，依然能交付零失誤的高水準品質。',
                            ],
                            [
                                'num' => '02',
                                'title' => 'ODM 結構研發設計',
                                'subtitle' => '結合人因數據，量身打造創新產品',
                                'body' => '我們將前沿人因工學數據與國際材料科學深度融合，為客戶量身打造獨家規格。透過支援少量高精度的創新打樣與嚴苛結構測試，我們不僅滿足多元市場的定位需求，更將您的每一項創新構想，完美化為具備市場競爭力的實體睡眠產品。',
                            ],
                            [
                                'num' => '03',
                                'title' => 'OBM 自有品牌共創',
                                'subtitle' => '反哺國際大廠經驗，賦能通路發展',
                                'body' => '反哺數十年頂級製床的深厚經驗，我們致力於協助新創品牌與連鎖通路快速崛起。從前期概念成型到完整產品線規劃，我們提供全方位的專業技術支援；透過彈性的生產排程與全球物流網絡，成為您品牌長遠發展最強韌的後盾。',
                            ],
                            [
                                'num' => '04',
                                'title' => '嚴格專案保密機制',
                                'subtitle' => '恪守商業協議，守護智慧財產',
                                'body' => '我們始終秉持嚴謹的供應鏈與商業保密協議（NDA），為合作夥伴構築滴水不漏的防護網。透過嚴格隔離不同品牌的研發與生產資訊，全力維護獨家設計專利，讓每一位戰略夥伴都能全心投入市場拓展，享有絕對安心的信任基石。',
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
