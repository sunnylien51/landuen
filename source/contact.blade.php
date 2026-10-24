---
title: 合作洽詢
description: 合作洽詢——歡迎與蘭頓聯繫
---
@extends('_layouts.main')

@section('body')
    @include('_components.page-banner', [
        'enTitle' => 'CONTACT',
        'crumbs' => [
            ['name' => '合作洽詢'],
        ],
    ])

    <div class="content-panel">
        <section class="layout-grid inner-page-padding">
            <div class="max-w-3xl flex flex-col gap-6" data-aos="fade-up">
                <p class="text-cb2 text-gray4">在此放入合作洽詢的內容。</p>
            </div>
        </section>
    </div>
@endsection
