{{-- 內頁導言：金色短線 + 大標 + 引言（蘭頓精神除外之統一樣式） --}}
{{-- 深色底加 'onDark' => true --}}
<div class="page-intro{{ !empty($onDark) ? ' page-intro--on-dark' : '' }}" data-aos="fade-up">
    <div class="page-intro-rule" aria-hidden="true"></div>
    <h2 class="page-intro-heading">{{ $title }}</h2>
    <p class="page-intro-body">{{ $body }}</p>
</div>
