---
title: 關於我們
description: 關於我們
---
@extends('_layouts.main')

@section('body')
    @include('_components.page-banner', [
        'enTitle' => 'ABOUT',
        'zhTitle' => '關於我們',
        'crumbs' => [['name' => '關於我們']],
    ])

    <section class="layout-grid inner-page-padding">
        <div class="max-w-3xl flex flex-col gap-6" data-aos="fade-up">
            <p class="text-cb2 text-gray4">在此放入關於我們的內容。複製此頁作為其他內頁的起點，並依需求調整 page-banner 的標題與麵包屑。</p>
        </div>
    </section>
@endsection
