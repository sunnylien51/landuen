@php
    $active = $active ?? 'mit';
    $items = [
        ['key' => 'mit', 'label' => 'MIT精神', 'href' => '/about/'],
        ['key' => 'manufacturing', 'label' => '智慧智造', 'href' => '/about/manufacturing/'],
        ['key' => 'ergonomics', 'label' => '人因設計', 'href' => '/about/ergonomics/'],
        ['key' => 'oem', 'label' => '專業代工', 'href' => '/about/oem/'],
        ['key' => 'quality', 'label' => '品質永續', 'href' => '/about/quality/'],
        ['key' => 'company', 'label' => '公司簡介', 'href' => '/about/company/'],
    ];
@endphp
<div class="bg-white">
    <div class="layout-grid">
        <div class="flex items-center gap-6 lg:gap-8 max-w-[1280px] w-full mx-auto overflow-x-auto pt-12">
            @foreach ($items as $item)
                <a
                    href="{{ $page->baseUrl }}{{ $item['href'] }}"
                    class="shrink-0 flex flex-col items-center gap-1 py-1 text-cb1 {{ $active === $item['key'] ? 'text-main1' : 'text-gray4 hover:text-main1' }} transition-colors"
                >
                    <span>{{ $item['label'] }}</span>
                    <span
                        class="block w-full h-[1.5px] {{ $active === $item['key'] ? 'bg-main3' : 'bg-transparent' }}"
                        aria-hidden="true"
                    ></span>
                </a>
            @endforeach
        </div>
    </div>
</div>
