---
title: 隱私權政策
description: 隱私權政策
---
@extends('_layouts.main')

@section('body')
    @include('_components.page-banner', [
        'enTitle' => 'PRIVACY',
        'crumbs' => [
            ['name' => '隱私權政策'],
        ],
    ])

    <div class="content-panel">
        <section class="layout-grid inner-page-padding">
            <div class="max-w-3xl flex flex-col gap-6" data-aos="fade-up">
                <p class="text-cb2 text-gray4">在此放入隱私權政策的內容。</p>
            </div>
        </section>
    </div>
@endsection
