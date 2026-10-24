---
title: 服務條款
description: 服務條款
---
@extends('_layouts.main')

@section('body')
    @include('_components.page-banner', [
        'enTitle' => 'TERMS',
        'crumbs' => [
            ['name' => '服務條款'],
        ],
    ])

    <div class="content-panel">
        <section class="layout-grid inner-page-padding">
            <div class="max-w-3xl flex flex-col gap-6" data-aos="fade-up">
                <p class="text-cb2 text-gray4">在此放入服務條款的內容。</p>
            </div>
        </section>
    </div>
@endsection
