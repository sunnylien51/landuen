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
    @endphp

    <div class="content-panel content-panel--bg">
        <section class="layout-grid inner-page-padding flex flex-col items-center gap-12 lg:gap-16">
            @include('_components.page-intro', [
                'title' => '開啟全球商機',
                'body' => '歡迎各界公司行號、跨境電商、連鎖飯店、品牌渠道商提出多元合作或戰略採購企劃。請於下方表單提供完整的合作構想，您的資料愈具體，蘭頓 B2B 專業團隊愈能以高效率為您評估最適合的產能排程與客製化解決方案。',
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
        </section>
    </div>
@endsection
