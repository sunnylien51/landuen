---
title: 公司簡介
description: 蘭頓企業公司簡介
---
@extends('_layouts.main')

@section('body')
    @include('_components.page-banner', [
        'enTitle' => 'ABOUT',
        'crumbs' => [
            ['name' => '關於蘭頓', 'link' => $page->baseUrl . '/about/'],
            ['name' => '公司簡介'],
        ],
    ])

    <div class="content-panel">
        @include('_components.about-subnav', ['active' => 'company'])

        <section class="layout-grid pt-10 md:pt-14 pb-20 lg:pb-24">
            <div class="max-w-3xl flex flex-col gap-6" data-aos="fade-up">
                <p class="text-cb2 text-gray4">在此放入公司簡介的內容。</p>
            </div>
        </section>
    </div>
@endsection
