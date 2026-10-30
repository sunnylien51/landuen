---
title: 合作洽詢
description: 合作洽詢——開啟全球商機，歡迎提出多元合作或戰略採購企劃
---
@extends('_layouts.main')

@section('body')
    @include('_components.page-banner', [
        'enTitle' => 'CONTACT',
        'crumbs' => [
            ['name' => '合作洽詢'],
        ],
    ])

    @php
        $partnershipTypes = [
            '跨境電商代工',
            '飯店大宗採購',
            '品牌聯名',
            '其他',
        ];
        $contactInfo = $page->asArray($page->contactInfo);
    @endphp

    <div class="content-panel content-panel--bg">
        <section class="layout-grid inner-page-padding flex flex-col items-center gap-12 lg:gap-16">
            @include('_components.page-intro', [
                'title' => $page->pageIntros['contact']['title'] ?? '',
                'body' => $page->pageIntros['contact']['body'] ?? '',
            ])

            {{-- 送出成功 --}}
            <div
                id="partnership-success"
                class="w-full max-w-[1000px] p-10 md:p-14 bg-white rounded-[10px] flex-col items-center gap-5 text-center hidden"
                role="status"
            >
                <div class="size-14 rounded-full bg-gray1 flex items-center justify-center text-main1" aria-hidden="true">
                    <i data-lucide="check" class="w-7 h-7"></i>
                </div>
                <h3 class="text-ch4 text-main1">合作提案已送出</h3>
                <p class="text-cb2 text-gray4 max-w-xl">
                    感謝您的來信，蘭頓 B2B 專業團隊已收到資料，將盡快與您聯繫。
                </p>
                <button type="button" class="btn mt-2" data-partnership-reset>
                    <span>再次填寫</span>
                </button>
            </div>

            {{-- 合作提案表單（Netlify Forms） --}}
            <form
                id="partnership-form"
                name="partnership"
                method="POST"
                data-netlify="true"
                data-netlify-honeypot="bot-field"
                class="w-full max-w-[1000px] p-6 md:p-14 bg-white rounded-[10px] flex flex-col items-center gap-5"
                data-aos="fade-up"
                novalidate
            >
                <input type="hidden" name="form-name" value="partnership">
                <p class="hidden" aria-hidden="true">
                    <label>不要填寫此欄位 <input name="bot-field" tabindex="-1" autocomplete="off"></label>
                </p>

                <h3 class="self-stretch text-ch4 text-main1">合作提案表單</h3>

                <div class="self-stretch flex flex-col gap-0">
                    <div class="form-field">
                        <label for="company" class="form-label">
                            公司名稱<span class="form-required" aria-hidden="true">*</span>
                        </label>
                        <input
                            id="company"
                            name="company"
                            type="text"
                            class="form-control"
                            autocomplete="organization"
                            required
                            placeholder="請輸入公司名稱"
                        >
                    </div>

                    <div class="form-field">
                        <label for="contact-name" class="form-label">
                            聯絡人<span class="form-required" aria-hidden="true">*</span>
                        </label>
                        <input
                            id="contact-name"
                            name="contact_name"
                            type="text"
                            class="form-control"
                            autocomplete="name"
                            required
                            placeholder="請輸入聯絡人姓名"
                        >
                    </div>

                    <div class="form-field">
                        <label for="contact-phone" class="form-label">
                            電話<span class="form-required" aria-hidden="true">*</span>
                        </label>
                        <input
                            id="contact-phone"
                            name="phone"
                            type="tel"
                            class="form-control"
                            autocomplete="tel"
                            inputmode="tel"
                            required
                            placeholder="請輸入聯絡電話"
                        >
                    </div>

                    <div class="form-field">
                        <label for="contact-email" class="form-label">
                            Email<span class="form-required" aria-hidden="true">*</span>
                        </label>
                        <input
                            id="contact-email"
                            name="email"
                            type="email"
                            class="form-control"
                            autocomplete="email"
                            required
                            placeholder="name@company.com"
                        >
                    </div>
                </div>

                <div class="form-field self-stretch">
                    <label for="partnership-type" class="form-label">
                        合作類型<span class="form-required" aria-hidden="true">*</span>
                    </label>
                    <div class="form-select-wrap">
                        <select id="partnership-type" name="partnership_type" class="form-control form-select" required>
                            <option value="" disabled selected>請選擇：跨境電商代工 / 飯店大宗採購 / 品牌聯名 / 其他</option>
                            @foreach ($partnershipTypes as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                        <i data-lucide="chevron-down" class="form-select-icon" aria-hidden="true"></i>
                    </div>
                </div>

                <div class="form-field form-field--textarea self-stretch">
                    <label for="purpose" class="form-label">
                        01 合作主旨與核心目的（如：跨境電商代工、飯店大宗採購、品牌聯名）
                    </label>
                    <textarea id="purpose" name="purpose" rows="3" class="form-control" placeholder="請填寫…"></textarea>
                </div>

                <div class="form-field form-field--textarea self-stretch">
                    <label for="timeline" class="form-label">
                        02 預計專案啟動時間與交期期待
                    </label>
                    <textarea id="timeline" name="timeline" rows="3" class="form-control" placeholder="請填寫…"></textarea>
                </div>

                <div class="form-field form-field--textarea self-stretch">
                    <label for="plan" class="form-label">
                        03 合作執行方式、流程或初步規劃
                    </label>
                    <textarea id="plan" name="plan" rows="3" class="form-control" placeholder="請填寫…"></textarea>
                </div>

                <div class="form-field form-field--textarea self-stretch">
                    <label for="scale" class="form-label">
                        04 預期首批產出規模（如：預估打樣數量 / 貨櫃量）
                    </label>
                    <textarea id="scale" name="scale" rows="3" class="form-control" placeholder="請填寫…"></textarea>
                </div>

                <div class="form-field form-field--textarea self-stretch">
                    <label for="benefit" class="form-label">
                        05 本項合作對雙方預期的商業效益與市場期待
                    </label>
                    <textarea id="benefit" name="benefit" rows="3" class="form-control" placeholder="請填寫…"></textarea>
                </div>

                <div class="form-field self-stretch">
                    <label for="quantity" class="form-label">預計首批數量</label>
                    <input
                        id="quantity"
                        name="quantity"
                        type="text"
                        class="form-control"
                        placeholder="如：打樣 10 床 / 1 個 40 呆櫃"
                    >
                </div>

                <p class="self-stretch text-cb3 text-gray4">
                    此網站受 Google reCAPTCHA 保護，適用
                    <a
                        href="https://policies.google.com/privacy"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-main1 underline underline-offset-2 hover:opacity-80"
                    >隱私權政策</a>
                    與
                    <a
                        href="https://policies.google.com/terms"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-main1 underline underline-offset-2 hover:opacity-80"
                    >服務條款</a>。
                </p>

                <button type="submit" class="btn h-[50px] text-cb2 w-48 justify-between pl-7 pr-6 gap-3">
                    <span>送出合作提案</span>
                    <i data-lucide="arrow-up-right" class="w-4 h-4" aria-hidden="true"></i>
                </button>
            </form>

            {{-- 聯絡資訊＋地圖：單一白底區塊；桌機左資訊右滿版地圖 --}}
            <div
                class="w-full max-w-[1000px] grid grid-cols-1 lg:grid-cols-12 bg-white rounded-[10px] overflow-hidden lg:min-h-[420px]"
                data-aos="fade-up"
            >
                <div class="lg:col-span-5 flex flex-col justify-center gap-10 p-8 md:p-10 lg:p-12">
                   <h3 class="self-stretch text-ch4 text-main1">與我們聯繫</h3>

                    <ul class="flex flex-col">
                        @if (!empty($contactInfo['address']))
                            <li class="flex flex-col gap-1 py-4 border-t border-gray1 first:border-t-0 first:pt-0">
                                <span class="text-eb3 text-main3 tracking-[0.14em] uppercase">Address</span>
                                <p class="text-cb2 text-gray5">{{ $contactInfo['address'] }}</p>
                            </li>
                        @endif
                        @if (!empty($contactInfo['tel']))
                            <li class="flex flex-col gap-1 py-4 border-t border-gray1">
                                <span class="text-eb3 text-main3 tracking-[0.14em] uppercase">Tel</span>
                                <a
                                    href="tel:{{ $contactInfo['telHref'] ?? preg_replace('/\D+/', '', $contactInfo['tel']) }}"
                                    class="text-cb2 text-gray5 transition-colors duration-300 hover:text-main1"
                                >{{ $contactInfo['tel'] }}</a>
                            </li>
                        @endif
                        @if (!empty($contactInfo['email']))
                            <li class="flex flex-col gap-1 py-4 border-t border-gray1 last:pb-0">
                                <span class="text-eb3 text-main3 tracking-[0.14em] uppercase">Email</span>
                                <a
                                    href="mailto:{{ $contactInfo['email'] }}"
                                    class="text-cb2 text-gray5 break-all transition-colors duration-300 hover:text-main1"
                                >{{ $contactInfo['email'] }}</a>
                            </li>
                        @endif
                    </ul>
                </div>

                <div class="relative lg:col-span-7 min-h-[280px] lg:min-h-full bg-gray1">
                    @if (!empty($contactInfo['mapEmbed']))
                        <iframe
                            title="公司位置地圖"
                            src="{{ $contactInfo['mapEmbed'] }}"
                            class="absolute inset-0 size-full border-0"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            allowfullscreen
                        ></iframe>
                    @else
                        <div class="absolute inset-0 flex items-center justify-center px-6 text-center">
                            <p class="text-cb2 text-gray4">請於後台貼上 Google 地圖嵌入連結</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection
