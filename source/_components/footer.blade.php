@php
    $isHome = trim($page->getPath(), '/') === '';
@endphp
<footer class="w-full relative">
    {{--
      版面維持 480px／與上方面板重疊 60px（不會出現灰縫）。
      首頁圖用「視窗裁切＋反補償位移」做出釘住感：壞了最多變普通滾動，不會撐破版面。
    --}}
    <div
        id="footer-cta"
        class="relative z-0 w-full h-[520px] overflow-hidden -mt-[60px]"
    >
        <img
            src="{{ $page->baseUrl }}/images/banner_footer.jpg"
            alt=""
            class="absolute left-0 top-0 w-full {{ $isHome ? 'h-screen max-w-none object-cover object-center will-change-transform' : 'size-full object-cover object-center' }}"
            @if ($isHome) data-footer-pin-bg @endif
            aria-hidden="true"
        >
        <div class="absolute inset-0 bg-overlay/30" aria-hidden="true"></div>

        <div class="absolute inset-x-0 top-[60px] bottom-0 z-10 layout-grid flex flex-col justify-center items-center gap-8">
            <div class="w-full flex flex-col items-center gap-2 text-center" data-aos="fade-up">
                <div class="inline-flex items-center gap-3 text-eb2 text-main2 uppercase">
                    <span aria-hidden="true">/</span>
                    <span>COOPERATION</span>
                    <span aria-hidden="true">/</span>
                </div>
                <h2 class="text-ch2 text-white">攜手蘭頓，開啟品牌新藍圖</h2>
                <p class="text-cb2 text-white/80 max-w-2xl">從打樣到全球量產，以 40 年工藝成就您的市場優勢。</p>
            </div>

            <div
                class="flex flex-row flex-wrap items-center justify-center gap-3 sm:gap-4"
                data-aos="fade-up"
                data-aos-delay="100"
            >
                <a href="{{ $page->baseUrl }}/contact/" class="btn btn--main3 h-12 pl-6 pr-5 justify-between gap-3">
                    <span>啟動合作洽詢</span>
                    <i data-lucide="arrow-up-right" class="w-4 h-4" aria-hidden="true"></i>
                </a>
                <a href="{{ $page->baseUrl }}/cooperation/" class="btn-outline-light">
                    <span>了解合作流程</span>
                    <i data-lucide="arrow-up-right" class="w-4 h-4" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>

    <div id="footer-info" class="relative z-10 bg-gray5">
        <div class="layout-grid py-12 lg:py-14 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-10">
            <div class="flex-1 flex flex-col md:flex-row justify-start items-start gap-8 lg:gap-9 w-full">
                <div class="w-full md:w-72 shrink-0 flex flex-col items-start gap-5">
                    <a href="{{ $page->baseUrl }}/" class="inline-block">
                        <img
                            src="{{ $page->baseUrl }}/images/logo.svg"
                            alt="{{ $page->siteName }}"
                            class="h-8 w-auto"
                        >
                    </a>
                    <div class="inline-flex items-center gap-4 text-cb3 text-main2">
                        <a href="{{ $page->baseUrl }}/privacy/" class="hover:text-main2 transition-colors">隱私權政策</a>
                        <span aria-hidden="true">|</span>
                        <a href="{{ $page->baseUrl }}/terms/" class="hover:text-main2 transition-colors">服務條款</a>
                    </div>
                </div>

                <div class="flex-1 flex flex-col items-start gap-0.5 text-cb3 text-main2">
                    <p>桃園市中壢區龍東路597號</p>
                    <p>
                        E-mail：<a href="mailto:info@qupeng.com" class="hover:text-main2 transition-colors">info@qupeng.com</a>
                        <span class="mx-1">　</span>
                        TEL：<a href="tel:0229990000" class="hover:text-main2 transition-colors">02-2999-0000</a>
                    </p>
                    <p>© {{ date('Y') }} 蘭頓床墊｜Designed by
                        <a
                            href="https://ppnet.tw"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="hover:text-main2 transition-colors"
                        >PPNET</a>
                    </p>
                </div>
            </div>

            <button
                id="back-to-top"
                type="button"
                class="btn-outline shrink-0 self-end lg:self-center"
                aria-label="返回頁首"
            >
                <span>TOP</span>
                <i data-lucide="arrow-up" class="w-4 h-4"></i>
            </button>
        </div>
    </div>
</footer>
