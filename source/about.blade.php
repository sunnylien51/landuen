---
title: 企業理念
description: 企業理念——40 載踏實匠心與現代睡眠科學
---
@extends('_layouts.main')

@section('body')
    @include('_components.page-banner', [
        'enTitle' => 'ABOUT',
        'crumbs' => [
            ['name' => '關於蘭頓'],
            ['name' => '企業理念'],
        ],
    ])

    <div class="content-panel">
        @include('_components.about-subnav', ['active' => 'mit'])

        <div class="layout-grid pt-10 md:pt-14 pb-20 lg:pb-36 flex flex-col gap-20 lg:gap-[130px]">
            {{-- 1. 開篇・使命：置中編輯感（呼應首頁 MIT 開場，與子頁左文右圖區隔） --}}
            <section class="w-full flex flex-col items-center gap-12 lg:gap-16">
                <div class="relative w-full flex flex-col items-center pt-4 lg:pt-8" data-aos="fade-up">
                    <div class="relative z-10 w-full max-w-3xl flex flex-col items-center gap-5 lg:gap-6 text-center">
                        <div class="section-title-eyebrow">
                            <span aria-hidden="true">/</span>
                            <span>匠心與使命</span>
                            <span aria-hidden="true">/</span>
                        </div>

                        <div class="relative w-full flex flex-col items-center gap-5 lg:gap-6">
                            
                            <h2 class="relative z-10 section-title-heading">
                                40 載踏實匠心 <span class="text-main2">×</span> 現代睡眠科學
                            </h2>
                            <p class="relative z-10 text-cb2 text-gray4 max-w-4xl">
                                堅持純粹的台灣製造（MIT），以誠信為骨幹、科技為經緯，守護每一晚踏實的安睡。蘭頓深耕台灣製床領域逾四十年。四十年間，市場潮流瞬息萬變，但我們對「一張好床」的敬畏從未改變。我們從早期老師傅的手感淬鍊，逐步邁向智慧化精密智造，將在地扎根的踏實精神融入現代睡眠科學，致力為台灣家庭築起一張長達十年安心無虞的健康防線。
                            </p>
                        </div>
                    </div>
                </div>

                <div class="w-full max-w-[1200px] self-stretch mx-auto" data-aos="fade-up" data-aos-delay="80">
                    <div
                        class="about-youtube"
                        data-youtube-facade
                        data-youtube-id="_g1WUWEE4vI"
                    >
                        <img
                            src="{{ $page->baseUrl }}/images/video_about.jpg"
                            alt="蘭頓床墊企業形象"
                            class="about-youtube__poster"
                            width="1280"
                            height="720"
                            loading="lazy"
                            decoding="async"
                        >
                        <span class="about-youtube__shade" aria-hidden="true"></span>
                        <button type="button" class="about-youtube__hit" aria-label="播放影片">
                            <span class="about-youtube__play" aria-hidden="true">
                                <svg class="about-youtube__play-icon" viewBox="0 0 24 24" width="28" height="28" aria-hidden="true">
                                    <path fill="currentColor" d="M8 5.14v13.72L19 12 8 5.14z"/>
                                </svg>
                            </span>
                        </button>
                    </div>
                    <script>
                        (function () {
                            var root = document.currentScript && document.currentScript.previousElementSibling;
                            if (!root || root.dataset.youtubeBound === '1') return;
                            var id = root.getAttribute('data-youtube-id');
                            var hit = root.querySelector('.about-youtube__hit');
                            if (!id || !hit) return;
                            root.dataset.youtubeBound = '1';
                            hit.addEventListener('click', function (e) {
                                e.preventDefault();
                                if (root.classList.contains('is-playing')) return;
                                var iframe = document.createElement('iframe');
                                iframe.src = 'https://www.youtube.com/embed/' + encodeURIComponent(id) +
                                    '?autoplay=1&rel=0&modestbranding=1&playsinline=1&iv_load_policy=3';
                                iframe.title = hit.getAttribute('aria-label') || 'YouTube video';
                                iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share');
                                iframe.setAttribute('allowfullscreen', '');
                                iframe.setAttribute('referrerpolicy', 'strict-origin-when-cross-origin');
                                root.appendChild(iframe);
                                root.classList.add('is-playing');
                            });
                        })();
                    </script>
                </div>


                {{-- 2. 三大核心價值觀：首頁亮點列節奏 --}}
                <div class="w-full max-w-[1100px] flex flex-col md:flex-row md:items-start justify-center gap-10 md:gap-0 pt-4 lg:pt-6" data-aos="fade-up" data-aos-delay="160">
                    @php
                        $values = [
                            [
                                'num' => '01',
                                'title' => '匠心質造',
                                'body' => '傳承老師傅對細節與結構手感的極致要求，結合現代化數位智造管理，確保每一張交付出廠的床墊，都具備始終如一的高精密品質。',
                            ],
                            [
                                'num' => '02',
                                'title' => '在地風土',
                                'body' => '跳脫歐美床墊的設計框架，專注研究台灣海島型高溫高濕氣候與國人生活習慣，讓透氣、支撐與耐用性真正契合在地需求。',
                            ],
                            [
                                'num' => '03',
                                'title' => '永續責任',
                                'body' => '以產業先行者為己任，全面導入無毒工法與綠色低碳製程，對睡眠者的身體負責，更對孕育我們的土地許下共好承諾。',
                            ],
                        ];
                    @endphp
                    @foreach ($values as $i => $value)
                        @if ($i > 0)
                            <div class="hidden md:block w-px self-stretch bg-main1/15 mx-6 lg:mx-10 shrink-0" aria-hidden="true"></div>
                        @endif
                        <div class="w-full md:flex-1 flex flex-col items-center text-center gap-3 min-w-0">
                            <span class="text-eb3 text-main2 tracking-wider">{{ $value['num'] }}</span>
                            <h3 class="text-ch5 text-gray5 tracking-widest">{{ $value['title'] }}</h3>
                            <p class="text-cb3 text-gray4">{{ $value['body'] }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- 3. 雙重權威與綠色承諾 --}}
            <section class="w-full flex flex-col lg:flex-row lg:items-center gap-10 lg:gap-20" data-aos="fade-up">
                <div class="w-full lg:flex-1 flex flex-col gap-6 lg:gap-8 min-w-0">
                    <div class="section-title">
                        <div class="section-title-eyebrow">
                            <span aria-hidden="true">/</span>
                            <span>綠色與品質權威</span>
                            <span aria-hidden="true">/</span>
                        </div>
                        <h2 class="section-title-heading">
                            以科學立標竿 <span class="text-main2">×</span> 綠色低碳轉型
                        </h2>
                    </div>
                    <p class="text-cb2 text-gray4">
                        真正的信賴，來自嚴謹數據的檢驗與對未來的敬畏。
</br>
                        蘭頓不僅連續 20 年通過 ISO-9001 國際品質管理體系認證，更成為台灣首家取得國家環境部「產品碳足跡標籤」認證的床墊製造商。這代表我們不只追求產品本身的無瑕，更將永續視野延伸至原料開採、製造生產到物流包材的全生命週期，為台灣床墊產業樹立綠色轉型的新高度。
                    </p>
                </div>
                <div class="w-full lg:flex-1 min-w-0 overflow-hidden aspect-[4/3] about-media-tl">
                    <img
                        src="{{ $page->baseUrl }}/images/img_about2.jpg"
                        alt="以科學立標竿與綠色低碳轉型"
                        class="w-full h-full object-cover"
                    >
                </div>
            </section>

            {{-- 4. 企業社會責任 --}}
            <section class="w-full flex flex-col lg:flex-row lg:items-center gap-10 lg:gap-20" data-aos="fade-up">
                <div class="w-full lg:flex-1 min-w-0 overflow-hidden aspect-[4/3] about-media-tr order-2 lg:order-1">
                    <img
                        src="{{ $page->baseUrl }}/images/img_about3.jpg"
                        alt="深耕在地聚落與守護世代共好"
                        class="w-full h-full object-cover"
                    >
                </div>
                <div class="w-full lg:flex-1 flex flex-col gap-6 lg:gap-8 min-w-0 order-1 lg:order-2">
                    <div class="section-title">
                        <div class="section-title-eyebrow">
                            <span aria-hidden="true">/</span>
                            <span>社會責任與願景</span>
                            <span aria-hidden="true">/</span>
                        </div>
                        <h2 class="section-title-heading">
                            深耕在地聚落 <span class="text-main2">×</span> 守護世代共好
                        </h2>
                    </div>
                    <div class="text-cb2 text-gray4 flex flex-col gap-4">
                        <p>蘭頓始終相信，企業的價值不在於規模大小，而在於為社會帶來多少正向改變。我們扎根台灣在地產業鏈，培育在地技工人才與專業工匠，推動傳統製造業的智慧升級與技術傳承。</p>
                        <p>面對氣候變遷，我們積極朝向少毒、低碳、循環經濟邁進，降低生產對環境的負擔，與土地、員工及合作夥伴攜手，實現人與自然永續共存的健康未來。</p>
                    </div>
                </div>
            </section>

            {{-- 5. 戰略生態 --}}
            <section class="w-full flex flex-col lg:flex-row lg:items-center gap-10 lg:gap-20" data-aos="fade-up">
                <div class="w-full lg:flex-1 flex flex-col gap-6 lg:gap-8 min-w-0">
                    <div class="section-title">
                        <div class="section-title-eyebrow">
                            <span aria-hidden="true">/</span>
                            <span>產業生態共創</span>
                            <span aria-hidden="true">/</span>
                        </div>
                        <h2 class="section-title-heading">
                            自主品牌引領 <span class="text-main2">×</span> 戰略後盾共創
                        </h2>
                    </div>
                    <p class="text-cb2 text-gray4">
                        蘭頓身兼高品質自主品牌（OBM）的推動者，也是國內外大型家具品牌與電商通路背後最堅實的戰略代工（OEM / ODM）夥伴。我們以彈性智慧產線與保密誠信，協助合作夥伴將創新構想化為真實，共同成就多元繁榮的睡眠產業生態圈。
                    </p>
                </div>
                <div class="w-full lg:flex-1 min-w-0 overflow-hidden aspect-[4/3] about-media-tl">
                    <img
                        src="{{ $page->baseUrl }}/images/img_about4.jpg"
                        alt="自主品牌引領與戰略後盾共創"
                        class="w-full h-full object-cover"
                    >
                </div>
            </section>

            @include('_components.about-pillars')
        </div>
    </div>
@endsection
