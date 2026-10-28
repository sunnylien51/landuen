---
title: 戰略夥伴
description: 戰略夥伴——與供應鏈核心廠商共創睡眠品質
---
@extends('_layouts.main')

@section('body')
    @include('_components.page-banner', [
        'enTitle' => 'PARTNERS',
        'crumbs' => [
            ['name' => '戰略夥伴'],
        ],
    ])

    <div class="content-panel content-panel--plain">
        @php
            $partners = [
                [
                    'name' => '雙弘有限公司',
                    'tagline' => '彈簧與鋼線核心製造',
                    'advantage' => '深耕金屬加工與五金領域逾三十年，具備卓越的生產與客製化供應實力。',
                    'focus' => '各類型精密彈簧、床用彈簧骨架（高支撐力與穩定結構）、高品質鋼線原料加工與五金零組件。',
                    'img' => 'partner1.jpg',
                ],
                [
                    'name' => '偉儷貿易',
                    'tagline' => '頂級針織與面料自主研發',
                    'advantage' => '國內少數從源頭掌握織布技術的床墊品牌，不外購現成低價布料，兼具高品質與價格競爭力。',
                    'focus' => '引進德國 Mayer & Cie. 頂級圓針織機；專門開發涼感、透氣、抗菌及機能性床墊專用布料。',
                    'img' => 'partner2.jpg',
                ],
                [
                    'name' => '全益布業',
                    'tagline' => '車花加工與紡織後加工',
                    'advantage' => '結合原布採購、布料開發與車花加工的一條龍整合服務，簡化採購並精準控管品質。',
                    'focus' => '提供多樣化立體車花、精密刺繡、床墊與家飾布料絎縫（Quilting）加工，確保針腳密合與高對齊度。',
                    'img' => 'partner3.jpg',
                ],
                [
                    'name' => '喬福泡綿',
                    'tagline' => '全球軟質泡綿與發泡材料龍頭',
                    'advantage' => '創立於 1976 年，深耕台灣半世紀的國際化集團，生產基地遍布亞澳多國。',
                    'focus' => '聚醚與聚酯泡綿（泛用、高彈性及記憶泡綿）、健康床墊與人體工學枕頭、醫療級減壓泡綿與照護輔具。',
                    'img' => 'partner4.jpg',
                ],
                [
                    'name' => '君達有限公司',
                    'tagline' => '工業級膠材與高效固定方案',
                    'advantage' => '深耕氣動工具與固定設備逾三十年，提供自動化與半自動化生產線的專業粘合解決方案。',
                    'focus' => '工業級熱熔膠槍與環保無毒熱熔膠材，廣泛應用於床墊獨立筒貼合、泡綿固定、包裝封箱及木工組裝。',
                    'img' => 'partner5.jpg',
                ],
                [
                    'name' => '宏盛自動化機械',
                    'tagline' => '床墊與海綿自動化設備',
                    'advantage' => '專注於海綿壓縮、床墊自動化包裝與整廠車間流水線規劃的高新企業。',
                    'focus' => '全自動床墊壓縮機、真空卷包機、海綿壓縮打包設備及枕頭寢具自動化袋裝機械。',
                    'img' => 'partner6.jpg',
                ],
                [
                    'name' => '源田機械',
                    'tagline' => '高效床墊圍邊機專家',
                    'advantage' => '知名床墊機械製造商，專為席夢思與軟床墊上下面料與側邊圍邊縫合打造高效設備。',
                    'focus' => '具備自動翻床與自動轉角功能（如 YT-WB-4A），實現單人高效化流暢操作，並支援 PLC 數位化多組配方記憶。',
                    'img' => 'partner7.jpg',
                ],
                [
                    'name' => '科華智縫設備',
                    'tagline' => '智慧絎縫與自動化車縫',
                    'advantage' => '專注於軟體床具、家紡用品及自動化車縫的高新技術企業，導入工業 4.0 與 MES 數據管理。',
                    'focus' => '多針/連續式智慧絎縫機、自動模板縫紉機（適用複雜輪廓與車縫一致性），提供一站式機械支援。',
                    'img' => 'partner8.jpg',
                ],
            ];
        @endphp

        <section class="layout-grid inner-page-padding flex flex-col">
            @foreach ($partners as $i => $partner)
                <article
                    class="w-full flex flex-col lg:flex-row lg:items-start gap-8 lg:gap-12 py-10 md:py-12 lg:py-16 {{ $i ? 'border-t border-gray1' : '' }}"
                    data-aos="fade-up"
                >
                    <div class="w-full lg:w-60 shrink-0 flex flex-col gap-0.5">
                        <h2 class="text-ch5 text-gray5">{{ $partner['name'] }}</h2>
                        <p class="text-cb2 text-main1">{{ $partner['tagline'] }}</p>
                    </div>

                    <div class="flex-1 min-w-0 grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-10 lg:gap-12">
                        <div class="flex flex-col gap-1.5">
                            <p class="text-cb3 text-main3">核心優勢</p>
                            <p class="text-cb2 text-gray4">{{ $partner['advantage'] }}</p>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <p class="text-cb3 text-main3">主力項目</p>
                            <p class="text-cb2 text-gray4">{{ $partner['focus'] }}</p>
                        </div>
                    </div>

                    <div class="w-full lg:w-72 shrink-0 flex lg:justify-end">
                        <img
                            src="{{ $page->baseUrl }}/images/{{ $partner['img'] }}"
                            alt="{{ $partner['name'] }}"
                            class="w-72 max-w-full h-28 object-contain object-left lg:object-right"
                        >
                    </div>
                </article>
            @endforeach
        </section>
    </div>
@endsection
