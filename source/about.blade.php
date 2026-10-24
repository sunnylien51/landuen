---
title: 蘭頓精神
description: 蘭頓精神——MIT 台灣製造與品質安心
---
@extends('_layouts.main')

@section('body')
    @include('_components.page-banner', [
        'enTitle' => 'ABOUT',
        'crumbs' => [
            ['name' => '關於蘭頓'],
            ['name' => 'MIT精神'],
        ],
    ])

    <div class="content-panel">
        @include('_components.about-subnav', ['active' => 'mit'])

        <div class="layout-grid pt-10 md:pt-14 pb-20 lg:pb-36 flex flex-col gap-20 lg:gap-[130px]">
            {{-- MIT 台灣製造 --}}
            <section class="w-full flex flex-col gap-12 lg:gap-16" data-aos="fade-up">
                <div class="w-full flex flex-col lg:flex-row lg:items-center gap-10 lg:gap-20">
                    <div class="flex-1 flex flex-col gap-6 lg:gap-8 min-w-0">
                        <div class="flex flex-col gap-3">
                            <div class="inline-flex items-center gap-3 text-eb2 text-main2 uppercase">
                                <span aria-hidden="true">/</span>
                                <span>MADE IN TAIWAN</span>
                                <span aria-hidden="true">/</span>
                            </div>
                            <h2 class="text-ch3 text-gray5">
                                MIT 台灣製造<br>
                                智慧智造 <span class="text-main2">×</span> 品質安心
                            </h2>
                        </div>
                        <p class="text-cb2 text-gray4">
                            蘭頓企業以「工業 4.0 智能生產設備」為核心，將傳統代工升級為高精密的睡眠科學智造。我們堅持在地研發與嚴格品質控管，結合人因工程與在地氣候需求，打造最符合台灣家庭的安心床墊防線。
                        </p>
                    </div>
                    <div class="w-full lg:w-[min(52%,680px)] shrink-0">
                        <img
                            src="{{ $page->baseUrl }}/images/img_about1.jpg"
                            alt="MIT 台灣製造床墊結構"
                            class="w-full h-auto object-cover"
                        >
                    </div>
                </div>

                <div class="w-full h-px bg-gray2" aria-hidden="true"></div>

                <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                    <div class="w-full flex items-start gap-4" data-aos="fade-up">
                        <div class="about-num" aria-hidden="true">01</div>
                        <div class="flex-1 flex flex-col gap-2 min-w-0">
                            <h3 class="text-ch5 text-gray5 tracking-widest">台灣製造在地服務</h3>
                            <p class="text-cb2 text-gray4">堅持在台灣研發、生產與整合供應鏈，確保製程穩定、品質一致；台灣製造、台灣服務，提供更即時的技術支援與售後保障。</p>
                        </div>
                    </div>
                    <div class="w-full flex items-start gap-4" data-aos="fade-up">
                        <div class="about-num" aria-hidden="true">02</div>
                        <div class="flex-1 flex flex-col gap-2 min-w-0">
                            <h3 class="text-ch5 text-gray5 tracking-widest">工業 4.0 智慧製造</h3>
                            <p class="text-cb2 text-gray4">導入自動化生產設備，提升彈簧、墊材、車縫與組裝的精準度；從原料、製程到成品建立完整品質管理，降低產品品質差異。</p>
                        </div>
                    </div>
                    <div class="w-full flex items-start gap-4" data-aos="fade-up">
                        <div class="about-num" aria-hidden="true">03</div>
                        <div class="flex-1 flex flex-col gap-2 min-w-0">
                            <h3 class="text-ch5 text-gray5 tracking-widest">完整材料整合</h3>
                            <p class="text-cb2 text-gray4">整合記憶泡棉、天然乳膠、機能性布料與高規彈簧等多元材料，依不同需求打造合適的睡眠支撐。</p>
                        </div>
                    </div>
                    <div class="w-full flex items-start gap-4" data-aos="fade-up">
                        <div class="about-num" aria-hidden="true">04</div>
                        <div class="flex-1 flex flex-col gap-2 min-w-0">
                            <h3 class="text-ch5 text-gray5 tracking-widest">符合台灣環境需求</h3>
                            <p class="text-cb2 text-gray4">針對台灣高溫高濕的氣候與居住環境，強化床墊的透氣、舒適與耐用設計。</p>
                        </div>
                    </div>
                    <div class="w-full flex items-start gap-4" data-aos="fade-up">
                        <div class="about-num" aria-hidden="true">05</div>
                        <div class="flex-1 flex flex-col gap-2 min-w-0">
                            <h3 class="text-ch5 text-gray5 tracking-widest">更靈活的供應鏈</h3>
                            <p class="text-cb2 text-gray4">縮短跨境物流距離，降低運輸與潮濕環境造成的風險，同時提高交期穩定度。</p>
                        </div>
                    </div>
                    <div class="w-full flex items-start gap-4" data-aos="fade-up">
                        <div class="about-num" aria-hidden="true">06</div>
                        <div class="flex-1 flex flex-col gap-2 min-w-0">
                            <h3 class="text-ch5 text-gray5 tracking-widest">符合全球規範</h3>
                            <p class="text-cb2 text-gray4">取得碳足跡排放標籤，提升產品環保價值、品牌信任與市場競爭力。</p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- 完整產業鏈智造 --}}
            <section class="w-full flex flex-col gap-20 lg:gap-28">
                <div class="w-full flex flex-col lg:flex-row lg:items-center gap-10 lg:gap-20" data-aos="fade-up">
                    <div class="w-full lg:flex-1 min-w-0 overflow-hidden about-media-tr">
                        <img
                            src="{{ $page->baseUrl }}/images/img_about2.jpg"
                            alt="完整產業鏈智造"
                            class="w-full h-64 md:h-96 object-cover"
                        >
                    </div>
                    <div class="w-full lg:flex-1 flex flex-col gap-8 lg:gap-10 min-w-0">
                        <div class="flex flex-col gap-3">
                            <div class="inline-flex items-center gap-3 text-eb2 text-main2 uppercase">
                                <span aria-hidden="true">/</span>
                                <span>Smart Manufacturing</span>
                                <span aria-hidden="true">/</span>
                            </div>
                            <h2 class="text-ch3 text-gray5">完整產業鏈智造 <span class="text-main2">×</span> 高規墊材</h2>
                        </div>
                        <div class="text-cb2 text-gray4 flex flex-col gap-4">
                            <p>台灣擁有全球少數具備高精密度、完整垂直整合的床墊產業鏈區域。蘭頓企業結合大數據人因工學研發團隊與國際級 QC（品質控制）硬核標準，讓每張床墊不只是產品，更是一份長達十年的健康承諾。</p>
                            <p>相較於一般純貼牌的貿易商或傳統小型作坊，蘭頓企業引進工業 4.0 自動化智能生產設備，建立無可替代的商業代工硬實力。</p>
                        </div>
                    </div>
                </div>

                {{-- 工業 4.0 步驟：滿版淺底 --}}
                <div class="relative py-16 lg:py-20" data-aos="fade-up">
                    <div class="absolute inset-y-0 left-1/2 w-screen -translate-x-1/2 bg-gray1" aria-hidden="true"></div>
                    <div class="relative flex flex-col gap-8 lg:gap-10">
                        <div class="flex flex-col gap-3">
                            <div class="inline-flex items-center gap-3 text-eb2 text-main2 uppercase">
                                <span aria-hidden="true">/</span>
                                <span>SMART MANUFACTURING</span>
                                <span aria-hidden="true">/</span>
                            </div>
                            <h2 class="text-ch3 text-gray5">工業 4.0 <span class="text-main2">×</span> 智慧製造</h2>
                        </div>

                        <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                            <div class="flex flex-col gap-5">
                                <div class="flex items-center">
                                    <span class="size-2.5 shrink-0 rounded-full bg-main2" aria-hidden="true"></span>
                                    <span class="flex-1 h-px bg-gray2" aria-hidden="true"></span>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <p class="text-eb3 text-main2 tracking-wider">STEP 01</p>
                                    <h3 class="text-ch5 text-gray5 tracking-widest">瑞士進口精密彈簧成型機</h3>
                                    <p class="text-cb3 text-gray4">拒絕外購規格不一的彈簧，透過全自動設備將高碳鋼絲進行二次高溫電熱淬火，精準調校線徑、圈數與拉伸應力</p>
                                </div>
                            </div>
                            <div class="flex flex-col gap-5">
                                <div class="flex items-center">
                                    <span class="size-2.5 shrink-0 rounded-full bg-main2" aria-hidden="true"></span>
                                    <span class="flex-1 h-px bg-gray2" aria-hidden="true"></span>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <p class="text-eb3 text-main2 tracking-wider">STEP 02</p>
                                    <h3 class="text-ch5 text-gray5 tracking-widest">袋裝彈簧超音波焊接</h3>
                                    <p class="text-cb3 text-gray4">採用先進超音波熔接技術與防潮長纖不織布，精準控制袋裝張力，100% 消除金屬摩擦異音。</p>
                                </div>
                            </div>
                            <div class="flex flex-col gap-5">
                                <div class="flex items-center">
                                    <span class="size-2.5 shrink-0 rounded-full bg-main2" aria-hidden="true"></span>
                                    <span class="flex-1 h-px bg-gray2" aria-hidden="true"></span>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <p class="text-eb3 text-main2 tracking-wider">STEP 03</p>
                                    <h3 class="text-ch5 text-gray5 tracking-widest">電腦自動車花</h3>
                                    <p class="text-cb3 text-gray4">導入多針全自動電腦控制系統，依天絲、瞬涼纖維等布料延伸特性進行精密針距車縫，確保表布耐磨不起泡。</p>
                                </div>
                            </div>
                            <div class="flex flex-col gap-5">
                                <div class="flex items-center">
                                    <span class="size-2.5 shrink-0 rounded-full bg-main2" aria-hidden="true"></span>
                                    <span class="flex-1 h-px bg-gray2" aria-hidden="true"></span>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <p class="text-eb3 text-main2 tracking-wider">STEP 04</p>
                                    <h3 class="text-ch5 text-gray5 tracking-widest">智慧熱熔膠製程</h3>
                                    <p class="text-cb3 text-gray4">由機械手臂進行多點精準定量噴塗（使用符合 SGS/歐盟認證的 PUR 熱熔膠），摒棄傳統人工刷膠造成的甲醛/甲苯過量與黏合不均問題。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- 台灣環境需求 --}}
            <section class="w-full flex flex-col lg:flex-row lg:items-center gap-10 lg:gap-20" data-aos="fade-up">
                <div class="w-full lg:flex-1 flex flex-col gap-8 lg:gap-10 min-w-0">
                    <div class="flex flex-col gap-3">
                        <div class="inline-flex items-center gap-3 text-eb2 text-main2 uppercase">
                            <span aria-hidden="true">/</span>
                            <span>Designed for Taiwan</span>
                            <span aria-hidden="true">/</span>
                        </div>
                        <h2 class="text-ch3 text-gray5">台灣環境需求 <span class="text-main2">×</span> 人因設計</h2>
                    </div>
                    <p class="text-cb2 text-gray4">
                        不同於歐美乾燥且空間遼闊的居住環境，蘭頓針對台灣高溫、高濕與住宅空間有限的環境特性，將氣候與使用需求融入床墊設計。
                    </p>
                    <div class="w-full flex flex-col gap-6">
                        <div class="w-full flex items-start gap-4">
                            <div class="about-num" aria-hidden="true">01</div>
                            <div class="flex-1 flex flex-col gap-1 min-w-0">
                                <h3 class="text-ch5 text-gray5 tracking-widest">透氣散熱</h3>
                                <p class="text-cb3 text-gray4">運用瞬涼纖維與立體結構，提升空氣流通與散熱，減少悶熱與濕氣累積。</p>
                            </div>
                        </div>
                        <div class="w-full flex items-start gap-4">
                            <div class="about-num" aria-hidden="true">02</div>
                            <div class="flex-1 flex flex-col gap-1 min-w-0">
                                <h3 class="text-ch5 text-gray5 tracking-widest">符合台灣居住環境</h3>
                                <p class="text-cb3 text-gray4">強化床墊結構與邊框耐用度，方便應對狹窄樓梯、電梯及住宅空間。</p>
                            </div>
                        </div>
                        <div class="w-full flex items-start gap-4">
                            <div class="about-num" aria-hidden="true">03</div>
                            <div class="flex-1 flex flex-col gap-1 min-w-0">
                                <h3 class="text-ch5 text-gray5 tracking-widest">人因導向設計</h3>
                                <p class="text-cb3 text-gray4">從實際居家使用情境出發，兼顧長者、兒童與不同家庭成員的睡眠需求。</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:flex-1 min-w-0 overflow-hidden about-media-tl">
                    <img
                        src="{{ $page->baseUrl }}/images/img_about3.jpg"
                        alt="台灣環境需求與人因設計"
                        class="w-full h-64 md:h-[560px] object-cover"
                    >
                </div>
            </section>

            {{-- 三軌布局 --}}
            <section class="w-full flex flex-col lg:flex-row lg:items-center gap-10 lg:gap-20" data-aos="fade-up">
                <div class="w-full lg:flex-1 min-w-0 overflow-hidden about-media-tr order-2 lg:order-1">
                    <img
                        src="{{ $page->baseUrl }}/images/img_about4.jpg"
                        alt="OEM ODM OBM 三軌布局"
                        class="w-full h-64 md:h-[560px] object-cover"
                    >
                </div>
                <div class="w-full lg:flex-1 flex flex-col gap-8 lg:gap-10 min-w-0 order-1 lg:order-2">
                    <div class="flex flex-col gap-3">
                        <div class="inline-flex items-center gap-3 text-eb2 text-main2 uppercase">
                            <span aria-hidden="true">/</span>
                            <span>OBM × ODM × OEM</span>
                            <span aria-hidden="true">/</span>
                        </div>
                        <h2 class="text-ch3 text-gray5">OEM<span class="text-main2">×</span>ODM<span class="text-main2">×</span>OBM 三軌布局</h2>
                    </div>
                    <div class="text-cb2 text-gray4 flex flex-col gap-4">
                        <p>除了自主研發的頂級產品系列外，蘭頓企業（OBM）同時作為高階床墊 ODM/OEM 的產業巨擘，與多家本地知名品牌、實體連鎖家具大廠及新創跨境電商品牌深度合作，提供頂尖的結構設計研發與現代化智能生產線協助。</p>
                        <p>不論是少量、高精度的創新產品打樣，還是國際化的大規模長期產能開發，蘭頓皆能憑藉智能智慧化彈性生產線，快速切換不同規格、硬度與材料配置。我們秉持高度的供應鏈彈性與嚴苛的保密責任感，協助合作夥伴將具備「人因工學與材料科學」的產品構想化為市場現實。</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
