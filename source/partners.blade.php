---
title: 戰略夥伴
description: 戰略夥伴——與品牌、通路共創睡眠體驗
---
@extends('_layouts.main')

@section('body')
    @include('_components.page-banner', [
        'enTitle' => 'PARTNERS',
        'crumbs' => [
            ['name' => '戰略夥伴'],
        ],
    ])

    <div class="content-panel">
        <section class="layout-grid inner-page-padding">
            <div class="max-w-3xl flex flex-col gap-6" data-aos="fade-up">
                <p class="text-cb2 text-gray4">在此放入戰略夥伴的內容。</p>
            </div>
        </section>
    </div>
@endsection
