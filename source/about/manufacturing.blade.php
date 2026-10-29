---
title: 智慧智造
description: 蘭頓智慧智造——自動化智能設備與精密製程
---
@extends('_layouts.main')

@section('body')
    @include('_components.page-banner', [
        'enTitle' => 'ABOUT',
        'crumbs' => [
            ['name' => '關於蘭頓', 'link' => $page->baseUrl . '/about/'],
            ['name' => '智慧智造'],
        ],
    ])

    <div class="content-panel">
        @include('_components.about-subnav', ['active' => 'manufacturing'])

        <div class="layout-grid pt-10 md:pt-14 pb-20 lg:pb-36 flex flex-col gap-20 lg:gap-[130px]">
            {{-- 導言：比照人因設計左文右圖 --}}
            <section class="w-full flex flex-col gap-12 lg:gap-16" data-aos="fade-up">
                {{-- 導言／清單共用 12 欄：右欄皆 col-span-7（約 58%），左右對齊 --}}
                <div class="w-full grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-20 lg:items-center">
                    <div class="lg:col-span-5 flex flex-col gap-6 lg:gap-8 min-w-0">
                        <div class="section-title">
                            <div class="section-title-eyebrow section-title-eyebrow--upper">
                                <span aria-hidden="true">/</span>
                                <span>Smart Manufacturing</span>
                                <span aria-hidden="true">/</span>
                            </div>
                            <h2 class="section-title-heading">
                                完整產業鏈<span class="text-main2">×</span> 自動化設備
                            </h2>
                        </div>
                        <p class="text-cb2 text-gray4">
                            傳統製床業往往仰賴人工與經驗，但在蘭頓企業，我們將 40 年的匠人底蘊轉化為精密的數位數據。全面引進國際頂級自動化智能設備與 MES 智慧生產管理系統，我們打造了高效率、高精準度的智慧工廠，重新定義現代床墊的製造極限。
                        </p>
                    </div>
                    <div class="lg:col-span-7 min-w-0 overflow-hidden aspect-[4/3] about-media-tl">
                        <img
                            src="{{ $page->baseUrl }}/images/mit_link1.jpg"
                            alt="蘭頓智慧智造"
                            class="w-full h-full object-cover"
                        >
                    </div>
                </div>

               

                {{-- 四工序：全寬清單列（編號｜標題／副標｜內文） --}}
                <div class="w-full flex flex-col">
                    @php
                        $blocks = [
                            [
                                'num' => '01',
                                'title' => '全自動瑞士精密彈簧成型',
                                'subtitle' => '二次高溫電熱淬火，極致抗疲勞',
                                'body' => '引進瑞士頂級自動化彈簧成型設備，從鋼絲抽線到成型一氣呵成。經由二次高溫電熱淬火處理，使彈簧金屬晶粒重新排列，具備極高的抗疲勞性與抗變形能力，確保每顆彈簧在經歷數萬次壓縮後，依然維持完美的彈性係數與支撐力。',
                            ],
                            [
                                'num' => '02',
                                'title' => '高精度超音波袋裝焊接',
                                'subtitle' => '100% 消除金屬異音，完美獨立支撐',
                                'body' => '打破傳統膠合或熱熔固定，全面採用高頻超音波袋裝焊接。100% 消除獨立筒在長期使用、摩擦時可能產生的金屬異音。結合高韌性、透氣的不織布無紡布袋，完美獨立包覆每顆彈簧，實現真正的零干擾靜音睡眠。',
                            ],
                            [
                                'num' => '03',
                                'title' => '電腦多元車花與立體充填',
                                'subtitle' => '多針自動化車縫，緊密貼合不起泡',
                                'body' => '搭載全自動電腦多針車縫系統，擁有極高精度的針距與走線軌跡。配合表布與內襯的多層立體充填工藝，確保內部泡綿與表布緊密貼合、不位移、不起泡，兼具視覺上的精緻立體美學與觸覺上的蓬鬆舒適感。',
                            ],
                            [
                                'num' => '04',
                                'title' => '機械手臂PUR無毒噴膠',
                                'subtitle' => '多點定量精準噴塗，嬰幼兒級純淨環保',
                                'body' => '告別傳統具刺鼻異味與有害物質的溶劑型膠水。斥資導入高精度機械手臂，搭載多點定量噴塗系統，均勻覆蓋 SGS 認證的環保 PUR 熱熔膠。實現零甲醛、無毒、無異味的嬰幼兒級純淨睡眠微環境，從製程源頭守護呼吸道健康。',
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
