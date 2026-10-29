{{-- 深入探索四大核心支柱（資料：$page->aboutPillars） --}}
<section class="w-full flex flex-col gap-10 lg:gap-12" data-aos="fade-up">
    <div class="section-title section-title--center">
        <div class="section-title-eyebrow section-title-eyebrow--upper">
            <span aria-hidden="true">/</span>
            <span>EXPLORE MORE</span>
            <span aria-hidden="true">/</span>
        </div>
        <h2 class="section-title-heading">深入探索四大核心支柱</h2>
    </div>

    <div class="w-full max-w-[1280px] mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-7">
        @foreach ($page->aboutPillars as $i => $card)
            <a
                href="{{ $page->baseUrl }}{{ $card['href'] }}"
                class="block"
                data-aos="fade-right"
                data-aos-delay="{{ $i * 100 }}"
            >
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
</section>
