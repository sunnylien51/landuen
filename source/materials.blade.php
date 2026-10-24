---
title: 材料介紹
description: 材料介紹——床墊核心材質與工藝
---
@extends('_layouts.main')

@section('body')
    @include('_components.page-banner', [
        'enTitle' => 'MATERIALS',
        'crumbs' => [
            ['name' => '材料介紹'],
        ],
    ])

    <div class="content-panel">
        <section class="layout-grid inner-page-padding">
            <div class="max-w-3xl flex flex-col gap-6" data-aos="fade-up">
                <p class="text-cb2 text-gray4">在此放入材料介紹的內容。</p>
            </div>
        </section>
    </div>
@endsection
