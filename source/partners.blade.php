---
title: 戰略夥伴
description: 戰略夥伴——與供應鏈核心廠商共創睡眠品質
---
@extends('_layouts.main')

@section('body')
    @include('_components.page-banner', [
        'enTitle' => 'PARTNERS',
        'crumbs' => [
            ['name' => '戰略夥伴'],
        ],
    ])

    <div class="content-panel content-panel--plain">
        @php
            $partners = $page->partners ?? [];
        @endphp

        <section class="layout-grid inner-page-padding flex flex-col gap-14 lg:gap-16">
            @include('_components.page-intro', [
                'title' => '與供應鏈核心廠商共創睡眠品質',
                'body' => '蘭頓攜手彈簧、布料、泡綿、膠材與自動化設備等領域夥伴，以穩定供應與專業製程，共同打造具備市場競爭力的睡眠產品。',
            ])

            <div class="w-full flex flex-col">
                @foreach ($partners as $i => $partner)
                    <article
                        class="w-full flex flex-col lg:flex-row lg:items-start gap-8 lg:gap-12 py-10 md:py-12 lg:py-16 {{ $i ? 'border-t border-gray1' : '' }}"
                        data-aos="fade-up"
                    >
                        <div class="w-full lg:w-60 shrink-0 flex flex-col gap-0.5">
                            <h2 class="text-ch5 text-gray5">{{ $partner['name'] }}</h2>
                            <p class="text-cb2 text-main1">{{ $partner['tagline'] }}</p>
                        </div>

                        <div class="flex-1 min-w-0 grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-10 lg:gap-12">
                            <div class="flex flex-col gap-1.5">
                                <p class="text-cb3 text-main3">核心優勢</p>
                                <p class="text-cb2 text-gray4">{{ $partner['advantage'] }}</p>
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <p class="text-cb3 text-main3">主力項目</p>
                                <p class="text-cb2 text-gray4">{{ $partner['focus'] }}</p>
                            </div>
                        </div>

                        <div class="w-full lg:w-72 shrink-0 flex lg:justify-end">
                            <img
                                src="{{ $page->baseUrl }}/images/{{ $partner['img'] }}"
                                alt="{{ $partner['name'] }}"
                                class="w-72 max-w-full h-28 object-contain object-left lg:object-right"
                            >
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    </div>
@endsection
