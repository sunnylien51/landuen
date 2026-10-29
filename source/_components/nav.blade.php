@php
    $isHome = trim($page->getPath(), '/') === '';
@endphp
{{-- 全站透明疊在深色 hero／banner 上；內頁滾過 banner 後由 JS 改回白底 --}}
<header id="main-header" class="absolute left-0 right-0 top-0 w-full z-[100] bg-transparent is-over-hero {{ $isHome ? '' : 'js-nav-over-hero' }}">
    <nav class="nav-bar justify-between items-center transition-all duration-300 relative min-h-16 lg:min-h-20" id="main-nav">
        <a href="{{ $page->baseUrl }}/" class="flex items-center z-50 shrink-0">
            <img
                src="{{ $page->baseUrl }}/images/logo.svg"
                alt="{{ $page->siteName }}"
                class="nav-logo h-7 md:h-8 w-auto"
            >
        </a>

        <button id="mobile-menu-btn" class="lg:hidden py-2 pl-2 pr-0 focus:outline-none z-50 flex items-center justify-center cursor-pointer transition-colors" aria-label="開啟選單">
            <i data-lucide="menu" id="mobile-menu-icon" class="w-6 h-6"></i>
        </button>

        <div id="nav-menu" class="nav-menu-panel is-closed fixed lg:static top-0 right-0 lg:w-auto h-screen max-h-[100dvh] lg:h-auto shadow-2xl lg:shadow-none p-6 md:px-12 pt-24 pb-12 lg:p-0 flex flex-col lg:flex-row lg:items-center gap-6 lg:gap-10 z-40 overflow-y-auto lg:overflow-visible">
            <ul class="flex flex-col lg:flex-row lg:items-center gap-0 lg:gap-6 w-full lg:w-auto">
                <li class="py-1 lg:py-0">
                    <a href="{{ $page->baseUrl }}/about/" class="nav-link {{ $page->isActive('/about') }}">關於蘭頓</a>
                </li>
                <li class="py-1 lg:py-0">
                    <a href="{{ $page->baseUrl }}/cooperation/" class="nav-link {{ $page->isActive('/cooperation') }}">合作方式</a>
                </li>
                <li class="py-1 lg:py-0">
                    <a href="{{ $page->baseUrl }}/knowledge/" class="nav-link {{ $page->isActive('/knowledge') }}">床墊知識</a>
                </li>
                <li class="py-1 lg:py-0">
                    <a href="{{ $page->baseUrl }}/materials/" class="nav-link {{ $page->isActive('/materials') }}">材料介紹</a>
                </li>
                <li class="py-1 lg:py-0">
                    <a href="{{ $page->baseUrl }}/partners/" class="nav-link {{ $page->isActive('/partners') }}">戰略夥伴</a>
                </li>
            </ul>

            <a href="{{ $page->baseUrl }}/contact/" class="btn-cta w-full lg:w-44 justify-center">
                <i data-lucide="mail" class="w-5 h-5 shrink-0"></i>
                <span>合作洽詢</span>
            </a>
        </div>

        <div id="mobile-menu-overlay" class="nav-menu-overlay fixed inset-0 bg-overlay/50 z-30 lg:hidden opacity-0 pointer-events-none"></div>
    </nav>
</header>
