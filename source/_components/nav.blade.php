<header id="main-header" class="w-full sticky top-0 z-[100] bg-transparent transition-all duration-300">
    <nav class="layout-grid py-5 justify-between items-center transition-all duration-300 relative" id="main-nav">
        <a href="{{ $page->baseUrl }}/" class="flex items-center z-50">
            <span class="text-ch5 text-main1">{{ $page->siteName }}</span>
        </a>

        <button id="mobile-menu-btn" class="lg:hidden text-main1 p-2 focus:outline-none z-50 flex items-center justify-center cursor-pointer" aria-label="開啟選單">
            <i data-lucide="menu" id="mobile-menu-icon" class="w-6 h-6"></i>
        </button>

        <div id="nav-menu" class="fixed lg:static top-0 right-0 max-w-full w-full sm:w-[320px] lg:w-auto h-screen max-h-[100dvh] lg:h-auto bg-white lg:bg-transparent shadow-2xl lg:shadow-none p-6 md:px-12 pt-24 pb-12 lg:p-0 flex flex-col lg:flex-row lg:items-center gap-6 lg:gap-10 translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-40 overflow-y-auto lg:overflow-visible">
            <ul class="flex flex-col lg:flex-row lg:items-center gap-0 lg:gap-7 w-full lg:w-auto">
                <li class="py-1 lg:py-0">
                    <a href="{{ $page->baseUrl }}/about/" class="nav-link {{ $page->isActive('/about') }}">關於我們</a>
                </li>
                <li class="py-1 lg:py-0">
                    <a href="{{ $page->baseUrl }}/news/" class="nav-link {{ $page->isActive('/news') }}">最新消息</a>
                </li>
                <li class="relative group py-1 lg:py-0 mobile-dropdown">
                    <a href="#" class="nav-link justify-between lg:justify-start mobile-dropdown-toggle">
                        <span>服務項目</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-gray4 group-hover:text-main2 transition-transform duration-200 group-hover:rotate-180 icon-arrow"></i>
                    </a>
                    <div class="dropdown-menu-wrapper">
                        <div class="dropdown-menu-inner">
                            <div class="w-full lg:w-48 bg-gray1/60 lg:bg-white rounded-[10px] lg:shadow-lg flex flex-col overflow-hidden">
                                <a href="{{ $page->baseUrl }}/services/" class="dropdown-item">
                                    <span>服務項目一</span>
                                    <i data-lucide="chevron-right" class="w-4 h-4 dropdown-item-arrow"></i>
                                </a>
                                <a href="{{ $page->baseUrl }}/services/" class="dropdown-item">
                                    <span>服務項目二</span>
                                    <i data-lucide="chevron-right" class="w-4 h-4 dropdown-item-arrow"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="py-1 lg:py-0">
                    <a href="{{ $page->baseUrl }}/contact/" class="nav-link {{ $page->isActive('/contact') }}">聯絡我們</a>
                </li>
            </ul>

            <a href="{{ $page->baseUrl }}/contact/" class="btn-primary w-full lg:w-auto justify-center">
                <span>立即諮詢</span>
            </a>
        </div>

        <div id="mobile-menu-overlay" class="fixed inset-0 bg-overlay/40 hidden z-30 lg:hidden"></div>
    </nav>
</header>
