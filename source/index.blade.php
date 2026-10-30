@extends('_layouts.main')

@section('body')
    {{-- Hero：sticky 被中段壓過；內層慢速位移 + 滾動模糊；背景淡入淡出輪播 --}}
    @php
        $homeHeroSlides = $page->homeHeroSlides ?? [];
        $homeHeroTotal = max(count($homeHeroSlides), 1);
        $homeHeroCopy = $page->homeHeroCopy ?? [];
        $homeHeroBody = $homeHeroCopy['body'] ?? [];
        if (is_string($homeHeroBody)) {
            $homeHeroBody = [$homeHeroBody];
        }
    @endphp
    <section id="home-hero" class="sticky top-0 z-0 w-full h-[100svh] overflow-hidden" data-home-hero-slider>
        <div id="home-hero-motion" class="absolute inset-0 flex flex-col justify-center items-center will-change-transform">
            <div class="home-hero-slides absolute inset-0 scale-110" aria-hidden="true">
                @foreach ($homeHeroSlides as $i => $slide)
                    <picture
                        class="home-hero-slide absolute inset-0 block size-full {{ $i === 0 ? 'is-active' : '' }}"
                        data-home-hero-slide
                    >
                        @if (!empty($slide['srcMb']))
                            <source
                                media="(max-width: 799px)"
                                srcset="{{ $page->baseUrl }}/images/{{ $slide['srcMb'] }}"
                            >
                        @endif
                        <img
                            src="{{ $page->baseUrl }}/images/{{ $slide['src'] }}"
                            alt="{{ $slide['alt'] ?? '' }}"
                            class="absolute inset-0 size-full object-cover object-center"
                            @if ($i === 0) fetchpriority="high" @else loading="lazy" @endif
                        >
                    </picture>
                @endforeach
            </div>
            <div class="absolute inset-0 bg-overlay/40 z-[1]" aria-hidden="true"></div>

            <div class="layout-grid relative z-10 flex flex-col justify-center items-center gap-6 py-28 lg:py-32">
                <div class="w-full flex flex-col items-center gap-3 text-center">
                    <h1 class="text-eh2 lg:text-eh1 text-white tracking-wider">{{ $homeHeroCopy['title'] ?? '' }}</h1>
                    <p class="text-cb1 md:text-ch5 text-white tracking-widest">{{ $homeHeroCopy['subtitle'] ?? '' }}</p>
                </div>

                <div class="w-px h-14 bg-white/30" aria-hidden="true"></div>

                <p class="w-full max-w-2xl text-center text-cb3 text-white/70">
                    @foreach ($homeHeroBody as $lineIndex => $line)
                        @if ($lineIndex > 0)<br class="hidden md:block">@endif{{ $line }}
                    @endforeach
                </p>
            </div>
        </div>

        @if ($homeHeroTotal > 1)
            <div class="home-hero-controls" data-home-hero-controls>
                <button
                    type="button"
                    class="home-hero-controls__btn"
                    data-home-hero-prev
                    aria-label="上一張"
                >
                    <i data-lucide="chevron-left" class="w-5 h-5" aria-hidden="true"></i>
                </button>

                <div class="home-hero-progress flex items-center gap-3 md:gap-4 min-w-[9.5rem] md:min-w-[12rem]">
                    <span class="text-eb3 text-white tabular-nums" data-home-hero-current>01</span>
                    <div class="home-hero-progress__track flex-1" aria-hidden="true">
                        <div class="home-hero-progress__fill" data-home-hero-progress></div>
                    </div>
                    <span class="text-eb3 text-white/55 tabular-nums" data-home-hero-total>{{ str_pad((string) $homeHeroTotal, 2, '0', STR_PAD_LEFT) }}</span>
                </div>

                <button
                    type="button"
                    class="home-hero-controls__btn"
                    data-home-hero-next
                    aria-label="下一張"
                >
                    <i data-lucide="chevron-right" class="w-5 h-5" aria-hidden="true"></i>
                </button>
            </div>
        @endif
    </section>

    {{-- 中段：整塊蓋過 hero，最後再讓底下 footer 露出 --}}
    <div class="home-panel relative z-10 w-full rounded-t-[36px] md:rounded-t-[60px] shadow-[0_-24px_64px_rgba(12,23,43,0.18)]">
        <div class="relative overflow-hidden rounded-t-[36px] md:rounded-t-[60px]">
            <img
                src="{{ $page->baseUrl }}/images/bg_mattress.jpg"
                alt=""
                class="absolute inset-0 size-full object-cover object-center"
                aria-hidden="true"
            >

            <div class="layout-grid relative z-10 pt-16 lg:pt-20 pb-20 lg:pb-28 flex flex-col items-center">
                {{-- 三欄亮點：手機短標可另編；桌機說明＋主標 --}}
                <div class="w-full pb-10 md:pb-16 lg:pb-20 flex flex-row justify-center items-stretch md:items-center gap-0 md:gap-10 lg:gap-14" data-aos="fade-up">
                    <div class="flex-1 md:flex-none md:w-60 flex flex-col items-center justify-center text-center px-2 md:px-0">
                        <p class="hidden md:block text-cb2 text-gray4">導入自動化生產設備</p>
                        <p class="md:hidden text-cb2 text-gray5 tracking-wider">智慧製造</p>
                        <p class="hidden md:block text-ch5 text-gray5 tracking-widest">工業 4.0 智慧製造</p>
                    </div>
                    <div class="w-px self-stretch md:h-16 md:self-auto bg-main1/20 shrink-0" aria-hidden="true"></div>
                    <div class="flex-1 md:flex-none md:w-60 flex flex-col items-center justify-center text-center px-2 md:px-0">
                        <p class="hidden md:block text-cb2 text-gray4">通過國際認證檢驗</p>
                        <p class="md:hidden text-cb2 text-gray5 tracking-wider">品質控管</p>
                        <p class="hidden md:block text-ch5 text-gray5 tracking-widest">嚴格品質控管</p>
                    </div>
                    <div class="w-px self-stretch md:h-16 md:self-auto bg-main1/20 shrink-0" aria-hidden="true"></div>
                    <div class="flex-1 md:flex-none md:w-60 flex flex-col items-center justify-center text-center px-2 md:px-0">
                        <p class="hidden md:block text-cb2 text-gray4">台灣製造、在地服務</p>
                        <p class="md:hidden text-cb2 text-gray5 tracking-wider">售後保障</p>
                        <p class="hidden md:block text-ch5 text-gray5 tracking-widest">在地售後保障</p>
                    </div>
                </div>

                {{-- MIT --}}
                <div class="w-full relative flex flex-col items-center gap-10 lg:gap-12">
                    <div class="relative z-10 section-title section-title--center" data-aos="fade-up" data-aos-delay="200">
                        <div class="page-intro-rule" aria-hidden="true"></div>
                        <h2 class="section-title-heading">
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

                {{-- 核心支柱卡：showOnHome，最多 4 筆 --}}
                @php
                    $homeAboutPillarsLimit = (int) ($page->homeAboutPillarsLimit ?? 4);
                    $homeAboutPillars = array_values(array_filter(
                        $page->aboutPillars ?? [],
                        fn ($card) => !empty($card['showOnHome'])
                    ));
                    $homeAboutPillars = array_slice($homeAboutPillars, 0, max($homeAboutPillarsLimit, 0));
                    $homeAboutCount = count($homeAboutPillars);
                @endphp
                @if ($homeAboutCount > 0)
                <div class="w-full max-w-[1280px] grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-7 mt-12 lg:mt-16">
                    @foreach ($homeAboutPillars as $i => $card)
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
                                        <p class="text-cb3 text-gray4 line-clamp-1">{{ $card['desc'] }}</p>
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
                @endif
            </div>
        </div>

        {{-- OEM：三軌＋大圖縮放共用一張底圖（勿加 overflow-hidden，以免打斷 sticky） --}}
        <div class="relative z-10 w-full">
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

                @php
                    $homeOem = $page->homeOem ?? [];
                    $oemTracks = $homeOem['tracks'] ?? [];
                @endphp
                <div class="layout-grid relative z-10 w-full flex flex-col items-center gap-10 lg:gap-12 pt-[clamp(5rem,12vw,8.5rem)]">
                @include('_components.page-intro', [
                    'title' => $homeOem['title'] ?? '',
                    'body' => $homeOem['body'] ?? '',
                    'onDark' => true,
                ])

                    <div class="w-full max-w-[1000px] flex flex-col gap-2.5 md:gap-3" data-aos="fade-up" data-aos-delay="120">
                        @foreach ($oemTracks as $track)
                            {{-- 手機：中等圓角卡片；桌機：膠囊橫列 --}}
                            <div class="w-full px-6 py-5 md:pl-5 md:pr-10 bg-white rounded-2xl md:rounded-full flex flex-col md:flex-row md:items-center gap-2.5 md:gap-4">
                                <div class="w-full md:w-56 flex items-center gap-3 md:gap-4 shrink-0">
                                    <div class="size-10 md:size-12 bg-gray1 rounded-2xl md:rounded-3xl flex justify-center items-center text-main1 shrink-0">
                                        <i data-lucide="{{ $track['icon'] }}" class="w-5 h-5 md:w-6 md:h-6"></i>
                                    </div>
                                    <span class="text-cb1 text-main1">{{ $track['title'] }}</span>
                                </div>
                                <div class="hidden md:block w-px h-4 bg-gray2 shrink-0" aria-hidden="true"></div>
                                <p class="flex-1 text-cb3 md:text-cb2 text-gray4">{{ $track['desc'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- OEM 大圖：250vh sticky 縮放，0→70% 放大，70→100% 停住後解除 --}}
            @php
                $oemZoom = $homeOem['zoom'] ?? [];
                $oemZoomTitle = $oemZoom['title'] ?? '';
                $oemZoomBody = $oemZoom['body'] ?? '';
                if (is_string($oemZoomTitle)) {
                    $oemZoomTitle = [$oemZoomTitle];
                }
                if (is_string($oemZoomBody)) {
                    $oemZoomBody = [$oemZoomBody];
                }
                $oemZoomAlt = $oemZoom['alt'] ?? '';
                $oemZoomVideo = $oemZoom['video'] ?? 'company_video.mp4';
                $oemZoomPoster = $oemZoom['poster'] ?? 'video_index.jpg';
            @endphp
            <section
                class="oem-zoom relative z-10 w-full"
                data-oem-zoom
                aria-label="{{ $oemZoomAlt !== '' ? $oemZoomAlt : '蘭頓智造場景' }}"
            >
                <div class="oem-zoom__pin sticky top-0 h-[100vh] w-full flex items-center justify-center">
                    {{-- 桌機播影片；手機／平板只顯示封面圖（見 CSS max 1199 + JS） --}}
                    <div class="oem-zoom__media" data-oem-zoom-media>
                        <video
                            class="oem-zoom__image"
                            data-oem-zoom-image
                            data-src="{{ $page->baseUrl }}/images/{{ $oemZoomVideo }}"
                            muted
                            loop
                            playsinline
                            webkit-playsinline
                            preload="none"
                            aria-label="{{ $oemZoomAlt }}"
                        ></video>
                        <img
                            class="oem-zoom__poster"
                            data-oem-zoom-poster
                            src="{{ $page->baseUrl }}/images/{{ $oemZoomPoster }}"
                            alt="{{ $oemZoomAlt }}"
                            decoding="async"
                        >
                        <div class="oem-zoom__overlay" data-oem-zoom-overlay aria-hidden="true"></div>
                        <div class="oem-zoom__copy">
                            <h3 class="oem-zoom__title text-eh3 md:text-eh2 lg:text-eh1 text-white/90" data-oem-zoom-title>
                                @foreach ($oemZoomTitle as $lineIndex => $line)
                                    @if ($lineIndex > 0)<br>@endif{{ $line }}
                                @endforeach
                            </h3>
                            <p class="oem-zoom__body text-cb1 text-white/80" data-oem-zoom-body>
                                @foreach ($oemZoomBody as $lineIndex => $line)
                                    @if ($lineIndex > 0)<br>@endif{{ $line }}
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    {{-- 材料＋夥伴：上方圓角接影片區；底部圓角蓋住 footer --}}
    @php
        $homeMaterials = $page->materialSystems;
        $homeMatFirst = $homeMaterials[0] ?? null;
    @endphp
    <div class="relative z-10 w-full -mt-[60px] bg-white rounded-t-[36px] md:rounded-t-[60px] rounded-b-[36px] md:rounded-b-[60px] shadow-[0_-24px_64px_rgba(12,23,43,0.18)] overflow-hidden">
    <section
        class="relative w-full"
        aria-labelledby="home-materials-title"
        data-home-materials
    >
        <img
            src="{{ $page->baseUrl }}/images/bg_materials.webp"
            alt=""
            class="absolute inset-0 size-full object-cover object-top"
            aria-hidden="true"
        >
        <div class="layout-grid relative z-10 flex flex-col items-center gap-16 lg:gap-[7.5rem] py-20 lg:py-[7.5rem]">
            @include('_components.page-intro', [
                'title' => '六大模組化材料矩陣',
                'body' => '結合前沿材料科學與工業 4.0 智造，蘭頓整合支撐、緩衝與包覆系統，以高規格無毒環保材料，全面滿足您的品牌在高階代工與客製研發上的需求。',
            ])

            <div
                class="w-full flex flex-col lg:flex-row items-center gap-10 lg:gap-20 xl:gap-20"
                data-aos="fade-up"
                data-aos-delay="80"
            >
                <div class="relative w-full max-w-sm mx-auto lg:mx-0 lg:max-w-none lg:w-[520px] xl:w-[600px] lg:shrink-0 overflow-hidden aspect-[1/1] about-media-tr bg-gray1">
                    <img
                        src="{{ $page->baseUrl }}/images/{{ $homeMatFirst['img'] ?? 'materials1.jpg' }}"
                        alt="{{ $homeMatFirst['title'] ?? '' }}"
                        class="w-full h-full object-cover transition-opacity duration-500"
                        data-home-mat-img
                        width="400"
                        height="500"
                        decoding="async"
                    >
                    <div class="absolute inset-0 bg-overlay/10 pointer-events-none" aria-hidden="true"></div>
                </div>

                <div class="w-full lg:flex-1 min-w-0 flex flex-col justify-center" role="list">
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
                            <span class="text-eh4 text-main1 shrink-0 pt-0.5" aria-hidden="true">{{ sprintf('%02d', $i + 1) }}</span>
                            <span class="flex-1 min-w-0 flex flex-col items-stretch">
                                <span class="w-full flex flex-wrap items-center justify-between gap-x-4 gap-y-1">
                                    <span class="text-ch5 md:text-ch4 text-main1 tracking-wide">{{ $mat['title'] }}</span>
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

    {{-- 戰略夥伴 logo 列（與 partners 連動；點進夥伴頁） --}}
    @php
        $homePartnersLimit = (int) ($page->homePartnersLimit ?? 18);
        $homePartners = array_values(array_filter(
            $page->partners ?? [],
            fn ($partner) => !empty($partner['showOnHome'])
        ));
        $homePartners = array_slice($homePartners, 0, max($homePartnersLimit, 0));
    @endphp
    <section class="relative w-full" aria-label="戰略夥伴">
        <div class="layout-grid pb-20 lg:pb-[7.5rem] pt-4 lg:pt-8">
            <div
                class="home-partners-scroll w-full overflow-x-auto cursor-grab select-none"
                data-drag-scroll
                data-aos="fade-up"
            >
                <div class="home-partners-scroll__track min-w-max flex items-center gap-5 md:gap-6 lg:gap-8" data-drag-scroll-track>
                    @foreach ($homePartners as $partner)
                        <a
                            href="{{ $page->baseUrl }}/partners/"
                            class="home-partners-scroll__item shrink-0 block w-36 md:w-40 lg:w-[200px] h-16 lg:h-20"
                            data-drag-scroll-item
                            aria-label="{{ $partner['name'] ?? '戰略夥伴' }}"
                        >
                            <img
                                src="{{ $page->baseUrl }}/images/{{ $partner['img'] }}"
                                alt="{{ $partner['name'] ?? '' }}"
                                class="w-full h-full object-contain mix-blend-luminosity pointer-events-none"
                                loading="lazy"
                                decoding="async"
                                draggable="false"
                            >
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection
