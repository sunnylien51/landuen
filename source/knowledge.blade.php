---
title: 床墊知識
description: 床墊知識——結構、材質與睡眠科學
---
@extends('_layouts.main')

@section('body')
    @include('_components.page-banner', [
        'enTitle' => 'KNOWLEDGE',
        'crumbs' => [
            ['name' => '床墊知識'],
        ],
    ])

    <div class="content-panel">
        <section class="layout-grid inner-page-padding">
            <div class="max-w-3xl flex flex-col gap-6" data-aos="fade-up">
                <p class="text-cb2 text-gray4">在此放入床墊知識的內容。</p>
            </div>
        </section>
    </div>
@endsection
