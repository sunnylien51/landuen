@php
    $active = $active ?? 'mit';
@endphp
<div class="bg-white">
    <div class="layout-grid">
        <div class="flex items-center gap-8 lg:gap-10 max-w-[1280px] w-full mx-auto overflow-x-auto pt-12">
            <a
                href="{{ $page->baseUrl }}/about/"
                class="shrink-0 flex flex-col items-center gap-1 py-1 text-cb1 {{ $active === 'mit' ? 'text-main1' : 'text-gray4 hover:text-main1' }} transition-colors"
            >
                <span>MIT精神</span>
                <span
                    class="block w-full h-[1.5px] {{ $active === 'mit' ? 'bg-main3' : 'bg-transparent' }}"
                    aria-hidden="true"
                ></span>
            </a>
            <a
                href="{{ $page->baseUrl }}/about/company/"
                class="shrink-0 flex flex-col items-center gap-1 py-1 text-cb1 {{ $active === 'company' ? 'text-main1' : 'text-gray4 hover:text-main1' }} transition-colors"
            >
                <span>公司簡介</span>
                <span
                    class="block w-full h-[1.5px] {{ $active === 'company' ? 'bg-main3' : 'bg-transparent' }}"
                    aria-hidden="true"
                ></span>
            </a>
        </div>
    </div>
</div>
