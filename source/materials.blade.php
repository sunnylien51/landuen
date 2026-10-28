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
            $systems = [
                [
                    'id' => 'mat-01',
                    'num' => '01',
                    'en' => 'FABRIC',
                    'title' => '床墊布料系統',
                    'intro' => '床墊最外層的表層面料，是人體感官與舒適系統的第一道能量交換界面。我們全面揚棄傳統石化纖維，創新融合航太級相變恆溫、奈米咖啡紗除臭、有機棉與環保再生紗，打造出兼具主動溫控、高效透氣與低碳足跡的極致親膚體驗。',
                    'items' => [
                        ['title' => 'CBD 布料', 'body' => '資源循環／吸濕排汗／輕盈親膚'],
                        ['title' => 'PCM 布料', 'body' => '主動調溫／吸熱降悶／放熱保暖'],
                        ['title' => '石墨烯布料', 'body' => '快速導熱／均勻散熱／抗靜電'],
                        ['title' => '特長匹馬棉布料', 'body' => '柔軟細緻／抗起毛球／不易變形'],
                        ['title' => '高模量環保紗布料（rPET）', 'body' => '回收低碳／耐磨抗撕裂／減少變形'],
                        ['title' => '竹纖維布料', 'body' => '吸濕透氣／水分管理／天然抑菌'],
                        ['title' => '天絲布料（Tencel™）', 'body' => '柔滑親膚／快速排濕／清爽柔軟'],
                        ['title' => '有機棉布料', 'body' => '天然親膚／低化學殘留／柔軟舒適'],
                        ['title' => '奈米咖啡紗布料', 'body' => '吸濕除味／咖啡渣再利用／耐用機能'],
                        ['title' => 'Outlast 布料', 'body' => '相變調溫／減少忽冷忽熱／穩定微氣候'],
                        ['title' => '亞麻布料', 'body' => '天然環保／散熱佳／吸水乾爽'],
                        ['title' => '負離子布料', 'body' => '負離子效果／清新舒適／健康生活'],
                    ],
                    'pdf' => 'materials-01-fabric.pdf',
                ],
                [
                    'id' => 'mat-02',
                    'num' => '02',
                    'en' => 'LATEX',
                    'title' => '歐洲天然乳膠系統',
                    'intro' => '嚴選 100% 歐洲原產純淨天然乳膠，遵循歐盟極其嚴苛的純物理發泡工藝，結合天然防蟎抗菌蛋白與微米級蜂巢排濕矩陣。全面通過各項國際權威無毒認證，在零 VOCs 的前提下，打造出頂級且令人安心的健康睡眠圈。',
                    'items' => [
                        ['title' => '天然純淨乳膠', 'body' => '歐洲原裝進口／柔韌有彈性／貼合釋壓'],
                        ['title' => '天然抑菌防護', 'body' => '天然抗微生物／降低塵蟎細菌／減少化學抗菌劑'],
                        ['title' => '低氣味、低 VOC', 'body' => '多道洗滌處理／降低製程殘留／純淨睡眠環境'],
                        ['title' => '針孔透氣結構', 'body' => '蜂巢式針孔／排濕散熱／適合台灣潮濕氣候'],
                        ['title' => '歐洲安全認證', 'body' => 'ECO-Institut、OEKO-TEX®／原料到使用安全檢測／安心貼身使用'],
                    ],
                    'pdf' => 'materials-04-latex.pdf',
                ],
                [
                    'id' => 'mat-03',
                    'num' => '03',
                    'en' => 'FOAM',
                    'title' => '泡綿支撐系統',
                    'intro' => '作為舒適層與應力緩衝的核心支柱，泡綿系統完美平衡了全身釋壓與精準撐托。透過水冷膠提供瞬時降溫、記憶綿進行慢回彈包覆，並搭配高密度泡綿與環保邊框結構強化，實現長效穩定、乾爽且無毒的深層睡眠環境。',
                    'items' => [
                        ['title' => '科技水冷膠泡綿', 'body' => '降溫排濕／透氣乾爽／柔韌減壓'],
                        ['title' => '科技應反差記憶綿', 'body' => '慢回彈包覆／均勻分壓／降低干擾'],
                        ['title' => '高密度聚氨酯泡綿', 'body' => '高密度支撐／維持脊椎／耐久抗塌'],
                        ['title' => 'EPE 環保聚乙烯', 'body' => '強化床沿／緩衝支撐／防潮耐用'],
                        ['title' => 'EVA 密閉高分子', 'body' => '結構支撐／吸震靜音／耐久抗變形'],
                    ],
                    'pdf' => 'materials-02-foam.pdf',
                ],
                [
                    'id' => 'mat-04',
                    'num' => '04',
                    'en' => 'SPRING',
                    'title' => '核心彈簧系統',
                    'intro' => '彈簧結構是決定床墊動態支撐力與耐久極限的核心命脈。針對亞熱帶氣候特性與多元身形需求，我們提供從高剛性連結式、點對點零干擾獨立筒到中鋼高碳鋼二次淬火等六大尖端工藝，精準滿足各種身形與睡眠習慣的承托期待。',
                    'items' => [
                        ['title' => '連結式高剛性彈簧（Bonnell）', 'body' => '高剛性／紮實支撐／適合偏硬床感'],
                        ['title' => '獨立筒彈簧（Pocketed Coil）', 'body' => '點對點支撐／降低翻身干擾／均勻釋壓'],
                        ['title' => '蜂巢式高密度錯位獨立筒', 'body' => '交錯高密度／強化回彈／貼合 S 型曲線'],
                        ['title' => '一線鋼連續縱向纏繞', 'body' => '整體支撐網／壓力分散／抗疲勞耐用'],
                        ['title' => '高彈力中鋼高碳鋼系統', 'body' => '精密熱處理／抗變形／Q 彈快速回彈'],
                        ['title' => '高密度精煉高碳鋼獨立筒', 'body' => '加粗高碳鋼／高支撐釋壓／顆數多三倍以上'],
                    ],
                    'pdf' => 'materials-03-spring.pdf',
                ],
                [
                    'id' => 'mat-05',
                    'num' => '05',
                    'en' => 'NEW MATERIALS',
                    'title' => '新世代材料系統',
                    'intro' => '呼應當代節能減碳與智慧調節的綠色趨勢，我們引入 3D／4D 立體織物與可回收 TPE 特殊材質。這些新世代材料同時具備高透氣、動態微氣候調節與優異緩衝機能，為現代睡眠體驗注入前沿的科技感與永續價值。',
                    'items' => [
                        ['title' => '3D／4D 材料', 'body' => '立體支撐透氣／感應溫濕壓力動態反應／調節空氣及濕度'],
                        ['title' => 'TPE 材料', 'body' => '柔韌回彈／耐磨支撐緩衝／可回收再利用'],
                    ],
                    'pdf' => 'materials-05-new.pdf',
                ],
                [
                    'id' => 'mat-06',
                    'num' => '06',
                    'en' => 'ADHESIVE',
                    'title' => 'PUR 熱熔膠系統',
                    'intro' => '為了徹底革新傳統床墊的黏合製程，我們揚棄揮發性溶劑，全面採用 100% 固含量 PUR 熱熔膠與 AI 自動化精密噴膠。從源頭實現無毒、無味、零甲醛殘留，完美對接歐盟最嚴格環保規範，成就抗老化期長達數十年的醫療級潔淨度。',
                    'items' => [
                        ['title' => '無溶劑製程', 'body' => '100% 固含量／不用有機溶劑／低異味低殘留'],
                        ['title' => '安全環保', 'body' => '不含苯、甲醛等有害物質／符合 REACH、RoHS 2.0'],
                        ['title' => '防潮防霉', 'body' => '物理降溫凝固／降低霉變風險'],
                        ['title' => '耐久抗老化', 'body' => '抗疲勞抗老化／降低長期脫層'],
                        ['title' => 'AI 自動化精密噴膠', 'body' => '多軸自動化噴塗／精準均勻穩定'],
                    ],
                    'pdf' => 'materials-06-pur.pdf',
                ],
            ];
        @endphp

        <section class="layout-grid layout-grid--fluid pt-10 md:pt-14 lg:pt-20 pb-20 lg:pb-36 flex flex-col gap-16 lg:gap-24" data-process-flow>
            {{-- 導言（暫定，待客戶確認） --}}
            <div class="w-full flex flex-col items-center gap-5 pt-10 pb-5" data-aos="fade-up">
                <div class="w-12 h-[3px] bg-main3" aria-hidden="true"></div>
                <h2 class="text-ch4 text-gray5 text-center max-w-4xl">
                    從表布、支撐層到黏合工藝，<br class="hidden md:inline">
                    蘭頓整合六大材料系統，為每張床墊打下舒適與耐久的基礎。
                </h2>
            </div>

            

            {{-- 手機橫向錨點 --}}
            <nav
                class="lg:hidden -mx-6 md:-mx-12 px-6 md:px-12 sticky top-0 z-20 bg-white/95 backdrop-blur-sm border-b border-gray2 overflow-x-auto"
                aria-label="材料系統"
                data-process-nav-mobile
            >
                <ul class="flex items-center gap-1 min-w-max py-3">
                    @foreach ($systems as $system)
                        <li>
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
                                @foreach ($systems as $system)
                                    <div class="h-[1em]">{{ $system['num'] }}</div>
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
                            class="grid grid-cols-1 gap-8 lg:gap-10 py-12 md:py-16 lg:py-24 scroll-mt-24 lg:scroll-mt-10 {{ $i ? 'border-t border-gray1' : '' }}"
                        >
                            <div class="flex flex-col gap-5 lg:gap-6 max-w-3xl">
                                <div class="flex items-center gap-4">
                                    <span class="w-10 h-px bg-main3" aria-hidden="true"></span>
                                    <span class="text-eb3 text-main3"><span class="lg:hidden">{{ $system['num'] }} · </span>{{ $system['en'] }}</span>
                                </div>
                                <h3 class="text-ch4 min-[1600px]:text-ch3 text-gray5">{{ $system['title'] }}</h3>
                                <p class="text-cb2 text-gray4">{{ $system['intro'] }}</p>
                            </div>

                            @if (!empty($system['items']))
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-0.5  overflow-hidden">
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
                                class="btn-outline w-fit"
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
