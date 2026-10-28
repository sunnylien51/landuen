@extends('_layouts.main')

@section('body')
    {{-- Hero：sticky 被中段壓過；內層慢速位移 + 滾動模糊 --}}
    <section id="home-hero" class="sticky top-0 z-0 w-full h-[100svh] overflow-hidden">
        <div id="home-hero-motion" class="absolute inset-0 flex flex-col justify-center items-center will-change-transform">
            <img
                src="{{ $page->baseUrl }}/images/main1.jpg"
                alt=""
                class="absolute inset-0 size-full object-cover object-bottom scale-110"
                aria-hidden="true"
            >
            <div class="absolute inset-0 bg-overlay/40 z-[1]" aria-hidden="true"></div>

            <div class="layout-grid relative z-10 flex flex-col justify-center items-center gap-6 py-28 lg:py-32">
                <div class="w-full flex flex-col items-center gap-3 text-center">
                    <h1 class="text-eh2 lg:text-eh1 text-white tracking-wider">Strategic Partnership</h1>
                    <p class="text-ch5 text-white tracking-widest">以精密智造，承載您的品牌承諾</p>
                </div>

                <div class="w-px h-14 bg-white/30" aria-hidden="true"></div>

                <p class="w-full max-w-2xl text-center text-cb3 text-white/70">
                    從前沿結構研發到大規模精準代工，<br class="hidden md:block">
                    緩慢而堅定地，成為您開拓市場最強韌的供應鏈後盾。
                </p>
            </div>
        </div>
    </section>

    {{-- 中段：整塊蓋過 hero，最後再讓底下 footer 露出 --}}
    <div class="home-panel relative z-10 w-full rounded-[60px] shadow-[0_-24px_64px_rgba(12,23,43,0.18)]">
        <div class="relative overflow-hidden rounded-t-[60px]">
            <img
                src="{{ $page->baseUrl }}/images/bg_mattress.jpg"
                alt=""
                class="absolute inset-0 size-full object-cover object-center"
                aria-hidden="true"
            >

            <div class="layout-grid relative z-10 pt-16 lg:pt-20 pb-20 lg:pb-28 flex flex-col items-center">
                {{-- 三欄亮點 --}}
                <div class="w-full pb-16 lg:pb-20 flex flex-col md:flex-row justify-center items-center gap-8 md:gap-10 lg:gap-14" data-aos="fade-up">
                    <div class="w-full md:w-60 flex flex-col items-center text-center">
                        <p class="text-cb2 text-gray4">導入自動化生產設備</p>
                        <p class="text-ch5 text-gray5 tracking-widest">工業 4.0 智慧製造</p>
                    </div>
                    <div class="hidden md:block w-px h-16 bg-main1/20" aria-hidden="true"></div>
                    <div class="w-full md:w-60 flex flex-col items-center text-center">
                        <p class="text-cb2 text-gray4">通過國際認證檢驗</p>
                        <p class="text-ch5 text-gray5 tracking-widest">嚴格品質控管</p>
                    </div>
                    <div class="hidden md:block w-px h-16 bg-main1/20" aria-hidden="true"></div>
                    <div class="w-full md:w-60 flex flex-col items-center text-center">
                        <p class="text-cb2 text-gray4">台灣製造、在地服務</p>
                        <p class="text-ch5 text-gray5 tracking-widest">在地售後保障</p>
                    </div>
                </div>

                {{-- MIT --}}
                <div class="w-full relative flex flex-col items-center gap-10 lg:gap-12">
                    <div class="relative z-10 w-full flex flex-col items-center gap-3 text-center">
                        <div class="inline-flex items-center gap-3 text-eb2 text-main2" data-aos="fade-up" data-aos-delay="0">
                            <span aria-hidden="true">/</span>
                            <span>MADE IN TAIWAN</span>
                            <span aria-hidden="true">/</span>
                        </div>
                        <h2 class="text-ch3 text-gray5" data-aos="fade-up" data-aos-delay="150">
                            MIT 台灣製造<br>
                            安心與工藝的承諾
                        </h2>
                    </div>

                    <div class="relative z-10 w-full max-w-[1200px]" data-mit-stage data-aos="fade-up" data-aos-delay="280">
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
                                    alt="MIT 台灣製造床墊剖面結構"
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

                {{-- 四卡片 --}}
                <div class="w-full max-w-[1280px] grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-7 mt-12 lg:mt-16">
                    @php
                        $mitCards = [
                            ['num' => '01', 'title' => '智慧智造', 'desc' => '完整產業鏈與自動化設備', 'img' => 'mit_link1.jpg', 'href' => '/about/manufacturing/'],
                            ['num' => '02', 'title' => '人因設計', 'desc' => '對應在地風土與氣候', 'img' => 'mit_link2.jpg', 'href' => '/about/ergonomics/'],
                            ['num' => '03', 'title' => '專業代工', 'desc' => 'OEM / ODM / OBM 戰略合作', 'img' => 'mit_link3.jpg', 'href' => '/about/oem/'],
                            ['num' => '04', 'title' => '品質永續', 'desc' => 'ISO 認證與碳足跡標籤', 'img' => 'mit_link4.jpg', 'href' => '/about/quality/'],
                        ];
                    @endphp
                    @foreach ($mitCards as $i => $card)
                        <a
                            href="{{ $page->baseUrl }}{{ $card['href'] }}"
                            class="block"
                            data-aos="fade-right"
                            data-aos-delay="{{ $i * 100 }}"
                        >
                            {{-- hover 位移放內層，避免被 AOS 的 transform 蓋掉 --}}
                            <div class="bg-white flex flex-col overflow-hidden group transition-all duration-500 ease-out hover:-translate-y-3 hover:shadow-[0px_8px_24px_0px_rgba(25,43,68,0.14)]">
                                <div class="px-6 pt-8 pb-10 flex flex-col items-start gap-6">
                                    <div class="flex flex-col items-start gap-1">
                                        <span class="text-cb3 text-main1">{{ $card['num'] }}</span>
                                        <span class="block w-4 border-t border-main3" aria-hidden="true"></span>
                                    </div>
                                    <div class="w-full flex flex-col items-center gap-1 text-center">
                                        <h3 class="text-ch4 text-main1 tracking-widest">{{ $card['title'] }}</h3>
                                        <p class="text-cb3 text-gray4">{{ $card['desc'] }}</p>
                                    </div>
                                </div>
                                <div class="relative rounded-tr-[48px] overflow-hidden">
                                    <img
                                        src="{{ $page->baseUrl }}/images/{{ $card['img'] }}"
                                        alt="{{ $card['title'] }}"
                                        class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-105"
                                    >
                                    <div class="absolute inset-0 bg-gray5/10" aria-hidden="true"></div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- OEM：三軌＋大圖縮放共用一張底圖（勿加 overflow-hidden，以免打斷 sticky） --}}
        <div class="relative z-10 w-full rounded-b-[60px]">
            <img
                src="{{ $page->baseUrl }}/images/bg_oem.webp"
                alt=""
                class="absolute inset-0 size-full object-cover object-center"
                aria-hidden="true"
            >
            <div class="oem-bg-overlay absolute inset-0 z-[1]" aria-hidden="true"></div>

            <div class="relative z-10 w-full flex flex-col items-center gap-16 lg:gap-28">
                <div class="absolute top-0 left-0 w-full leading-none pointer-events-none z-[2]" aria-hidden="true">
                    <img
                        src="{{ $page->baseUrl }}/images/arc.svg"
                        alt=""
                        class="block w-full h-auto select-none"
                    >
                </div>

                <div class="layout-grid relative z-10 w-full flex flex-col items-center gap-10 lg:gap-12 pt-[clamp(5rem,12vw,8.5rem)]">
                    <div class="w-full flex flex-col items-center gap-3 text-center" data-aos="fade-up">
                        <div class="inline-flex items-center gap-3 text-eb2 text-main2">
                            <span aria-hidden="true">/</span>
                            <span>OEM • ODM • OBM STRATEGY</span>
                            <span aria-hidden="true">/</span>
                        </div>
                        <h2 class="text-ch3 text-white">OEM ｜ ODM ｜ OBM 三軌佈局</h2>
                    </div>

                    <p class="w-full max-w-[615px] text-center text-cb2 text-white" data-aos="fade-up" data-aos-delay="80">
                        依托 40 年國際大廠服務經驗與工業 4.0 彈性智造，蘭頓企業為全球家具品牌、連鎖通路與跨境電商提供全方位、高靈活度的戰略代工與共創解決方案。
                    </p>

                    <div class="w-full max-w-[1000px] flex flex-col gap-3" data-aos="fade-up" data-aos-delay="120">
                        @php
                            $tracks = [
                                ['icon' => 'factory', 'title' => 'OEM 精準代工', 'desc' => '依托自動化智能生產線與嚴格的 SOP 產程管控，提供大規模產能開發與穩定交期。'],
                                ['icon' => 'pencil-ruler', 'title' => 'ODM 研發設計', 'desc' => '結合前沿人因工學數據與國際材料科學，支援少量高精度打樣，量身打造創新產品。'],
                                ['icon' => 'sparkles', 'title' => 'OBM 品牌共創', 'desc' => '反哺數十年頂級製床經驗，協助新創與通路快速建立高品質的自有睡眠品牌。'],
                            ];
                        @endphp
                        @foreach ($tracks as $track)
                            <div class="w-full pl-5 pr-6 md:pr-10 py-5 bg-white rounded-full flex flex-col md:flex-row md:items-center gap-4">
                                <div class="w-full md:w-56 flex items-center gap-4 shrink-0">
                                    <div class="size-12 bg-gray1 rounded-3xl flex justify-center items-center text-main1 shrink-0">
                                        <i data-lucide="{{ $track['icon'] }}" class="w-6 h-6"></i>
                                    </div>
                                    <span class="text-cb1 font-bold text-main1">{{ $track['title'] }}</span>
                                </div>
                                <div class="hidden md:block w-px h-4 bg-gray2 shrink-0" aria-hidden="true"></div>
                                <p class="flex-1 text-cb2 text-gray4">{{ $track['desc'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- OEM 大圖：250vh sticky 縮放，0→70% 放大，70→100% 停住後解除 --}}
            <section
                class="oem-zoom relative z-10 w-full"
                data-oem-zoom
                aria-label="蘭頓智造場景"
            >
                <div class="oem-zoom__pin sticky top-0 h-[100vh] w-full flex items-center justify-center">
                    <div class="oem-zoom__media" data-oem-zoom-media>
                        <video
                            class="oem-zoom__image"
                            data-oem-zoom-image
                            src="{{ $page->baseUrl }}/images/company_video.mp4"
                            muted
                            loop
                            playsinline
                            preload="auto"
                            aria-label="蘭頓企業智慧製造與床墊產線"
                        ></video>
                        <img
                            class="oem-zoom__poster"
                            data-oem-zoom-poster
                            src="{{ $page->baseUrl }}/images/video_index.jpg"
                            alt=""
                            aria-hidden="true"
                            decoding="async"
                        >
                        <div class="oem-zoom__overlay" data-oem-zoom-overlay aria-hidden="true"></div>
                        <div class="oem-zoom__copy">
                            <h3 class="oem-zoom__title text-eh2 lg:text-eh1 text-white/90" data-oem-zoom-title>
                                Made in Taiwan,<br>Built for Your Brand
                            </h3>
                            <p class="oem-zoom__body text-cb1 text-white/80" data-oem-zoom-body>
                                蘭頓深耕台灣四十載的頂級製床工藝，<br>
                                從源頭精準優化成本與穩定交期，<br>
                                以強悍的智造實力全方位賦能您的專屬品牌。
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    {{-- 白底下半段：底部 60px 圓角蓋住 footer（與 content-panel 同邏輯） --}}
    @php
        $homeMaterials = $page->materialSystems;
        $homeMatFirst = $homeMaterials[0] ?? null;
    @endphp
    <div class="relative z-10 w-full bg-white rounded-b-[60px] overflow-hidden">
    <section
        class="relative w-full"
        aria-labelledby="home-materials-title"
        data-home-materials
    >
        <div class="layout-grid flex flex-col items-center gap-16 lg:gap-[7.5rem] py-20 lg:py-[7.5rem]">
            <div class="w-full flex flex-col items-center gap-5 pt-10 pb-12" data-aos="fade-up">
                <div class="w-12 h-[3px] bg-main3" aria-hidden="true"></div>
                <h2 id="home-materials-title" class="text-ch3 text-gray5 text-center max-w-5xl">
                    結合前沿材料科學與工業 4.0 智造，<br>
                    蘭頓打造涵蓋六大系統的模組化材料矩陣，<br>
                    滿足多元規格與高階代工需求，與您共創市場優勢。
                </h2>
            </div>

            <div
                class="w-full max-w-[1280px] flex flex-col lg:flex-row items-stretch gap-10 lg:gap-20"
                data-aos="fade-up"
                data-aos-delay="80"
            >
                <div class="w-full lg:flex-1 min-h-[20rem] lg:min-h-[36rem] overflow-hidden about-media-tr bg-gray1">
                    <img
                        src="{{ $page->baseUrl }}/images/{{ $homeMatFirst['img'] ?? 'process1.jpg' }}"
                        alt="{{ $homeMatFirst['title'] ?? '' }}"
                        class="w-full h-full object-cover transition-opacity duration-500"
                        data-home-mat-img
                        width="600"
                        height="584"
                        decoding="async"
                    >
                </div>

                <div class="w-full lg:flex-1 flex flex-col justify-center" role="list">
                    @foreach ($homeMaterials as $i => $mat)
                        <button
                            type="button"
                            role="listitem"
                            class="home-mat-item w-full flex items-start gap-6 md:gap-8 py-5 md:py-6 border-b border-main1/20 text-left {{ $i === 0 ? 'is-active border-t' : '' }}"
                            data-home-mat-item
                            data-img="{{ $page->baseUrl }}/images/{{ $mat['img'] }}"
                            data-alt="{{ $mat['title'] }}"
                            aria-expanded="{{ $i === 0 ? 'true' : 'false' }}"
                        >
                            <span class="text-eh4 text-main1 shrink-0 pt-0.5" aria-hidden="true">{{ $mat['num'] }}</span>
                            <span class="flex-1 min-w-0 flex flex-col items-stretch">
                                <span class="w-full flex flex-wrap items-center justify-between gap-x-4 gap-y-1">
                                    <span class="text-ch4 text-main1 tracking-wide">{{ $mat['title'] }}</span>
                                    <span class="text-eb3 text-main1/60 tracking-wider whitespace-nowrap">( {{ $mat['en'] }} )</span>
                                </span>
                                <span class="home-mat-item__panel" data-home-mat-panel>
                                    <span class="home-mat-item__panel-inner">
                                        <span class="home-mat-item__body text-cb2 text-main1/75 pt-2.5 block">
                                            {{ $mat['intro'] }}
                                        </span>
                                    </span>
                                </span>
                            </span>
                        </button>
                    @endforeach

                    <div class="pt-8">
                        <a href="{{ $page->baseUrl }}/materials/" class="btn-outline w-44 py-[10px] justify-between pl-6 pr-5 shadow-none">
                            <span>材料介紹</span>
                            <i data-lucide="arrow-up-right" class="w-4 h-4" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 戰略夥伴 logo 列（純 logo，點進夥伴頁） --}}
    <section class="relative w-full" aria-label="戰略夥伴">
        <div class="layout-grid pb-20 lg:pb-[7.5rem] pt-4 lg:pt-8">
            <div
                class="home-partners-scroll w-full overflow-x-auto cursor-grab select-none"
                data-drag-scroll
                data-aos="fade-up"
            >
                <div class="home-partners-scroll__track min-w-max flex items-center gap-5 md:gap-6 lg:gap-8" data-drag-scroll-track>
                    @for ($pi = 1; $pi <= 8; $pi++)
                        <a
                            href="{{ $page->baseUrl }}/partners/"
                            class="home-partners-scroll__item shrink-0 block w-36 md:w-40 lg:w-[200px] h-16 lg:h-20"
                            data-drag-scroll-item
                            aria-label="戰略夥伴 {{ $pi }}"
                        >
                            <img
                                src="{{ $page->baseUrl }}/images/partner{{ $pi }}.jpg"
                                alt=""
                                class="w-full h-full object-contain mix-blend-luminosity pointer-events-none"
                                loading="lazy"
                                decoding="async"
                                draggable="false"
                            >
                        </a>
                    @endfor
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection
