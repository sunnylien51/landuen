@php
    $active = $active ?? 'mit';
    $items = [
        ['key' => 'mit', 'label' => '企業理念', 'href' => '/about/'],
        ['key' => 'manufacturing', 'label' => '智慧智造', 'href' => '/about/manufacturing/'],
        ['key' => 'ergonomics', 'label' => '人因設計', 'href' => '/about/ergonomics/'],
        ['key' => 'oem', 'label' => '戰略代工', 'href' => '/about/oem/'],
        ['key' => 'quality', 'label' => '品質永續', 'href' => '/about/quality/'],
    ];
@endphp
<div class="bg-white">
    <div class="layout-grid">
        <nav
            class="about-subnav-scroll hide-scrollbar w-full min-w-0 overflow-x-auto cursor-grab select-none pt-12 pb-1"
            aria-label="關於蘭頓"
            data-drag-scroll="free"
        >
            <div class="flex items-center gap-6 lg:gap-8 min-w-max">
                @foreach ($items as $item)
                    <a
                        href="{{ $page->baseUrl }}{{ $item['href'] }}"
                        class="shrink-0 flex flex-col items-center gap-1 py-1 text-cb1 {{ $active === $item['key'] ? 'text-main1' : 'text-gray4 hover:text-main1' }} transition-colors"
                        data-drag-scroll-item
                        @if ($active === $item['key']) aria-current="page" @endif
                    >
                        <span>{{ $item['label'] }}</span>
                        <span
                            class="block w-full h-[1.5px] {{ $active === $item['key'] ? 'bg-main3' : 'bg-transparent' }}"
                            aria-hidden="true"
                        ></span>
                    </a>
                @endforeach
            </div>
        </nav>
    </div>
</div>
