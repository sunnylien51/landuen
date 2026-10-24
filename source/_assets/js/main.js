function getAosDuration() {
    return (
        Number.parseInt(
            getComputedStyle(document.documentElement).getPropertyValue('--aos-duration'),
            10
        ) || 800
    );
}

function initAos() {
    if (typeof AOS === 'undefined') {
        return;
    }

    AOS.init({
        duration: getAosDuration(),
        once: true,
        offset: 80,
        easing: 'ease-out-cubic',
    });
}

/** Lenis 平滑捲動時補強 AOS：以 IO 確保進場 class 一定會加上 */
function bindAosRevealFallback() {
    if (!('IntersectionObserver' in window)) {
        return;
    }

    const items = document.querySelectorAll('[data-aos]:not(.aos-animate)');
    if (!items.length) {
        return;
    }

    const io = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }
                entry.target.classList.add('aos-animate');
                io.unobserve(entry.target);
            });
        },
        {
            root: null,
            rootMargin: '0px 0px -8% 0px',
            threshold: 0.05,
        }
    );

    items.forEach((el) => io.observe(el));
}

function onReady(fn) {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', fn, { once: true });
    } else {
        fn();
    }
}

onReady(function () {
    initAos();
    bindAosRevealFallback();

    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    if (typeof Fancybox !== 'undefined') {
        Fancybox.bind('[data-fancybox]', {});
    }

    const mitStage = document.querySelector('[data-mit-stage]');
    const mitWatermark = mitStage && mitStage.querySelector('[data-mit-watermark]');
    if (mitStage && mitWatermark && 'IntersectionObserver' in window) {
        const mitObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) {
                        return;
                    }
                    mitWatermark.classList.add('is-inview');
                    mitObserver.disconnect();
                });
            },
            { threshold: 0.35 }
        );
        mitObserver.observe(mitStage);
    }
});

window.addEventListener(
    'load',
    function () {
        if (typeof AOS !== 'undefined') {
            AOS.refresh();
        }
        bindAosRevealFallback();
    },
    { once: true }
);

if (typeof Lenis !== 'undefined') {
    const lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        direction: 'vertical',
        gestureDirection: 'vertical',
        smooth: true,
        mouseMultiplier: 1,
        smoothTouch: false,
        touchMultiplier: 2,
        infinite: false,
    });

    window.lenis = lenis;

    function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
    }

    requestAnimationFrame(raf);
}

const mainHeader = document.getElementById('main-header');
const mainNav = document.getElementById('main-nav');

/** Hero／內頁 banner：慢速視差 + 往下滾逐漸模糊（圖與文字同一層） */
function updateStickyHeroMotion(hero, motion) {
    if (!hero || !motion) {
        return;
    }

    const heroH = hero.offsetHeight || window.innerHeight || 1;
    const scrolled = window.scrollY;
    const progress = Math.min(Math.max(scrolled / heroH, 0), 1);

    // 約 0.35 倍滾動速度往上移（比中段慢）
    const y = scrolled * -0.35;
    const blur = progress * 10;

    motion.style.transform = `translate3d(0, ${y}px, 0)`;
    motion.style.filter = blur > 0.05 ? `blur(${blur}px)` : 'none';
}

function updateHomeHero() {
    updateStickyHeroMotion(
        document.getElementById('home-hero'),
        document.getElementById('home-hero-motion')
    );
}

function updatePageBannerHero() {
    updateStickyHeroMotion(
        document.querySelector('[data-page-hero]'),
        document.getElementById('page-banner-motion')
    );
}

/** MIT：床墊慢、浮水印快的雙層視差 */
function updateMitParallax() {
    const stage = document.querySelector('[data-mit-stage]');
    const mattress = stage && stage.querySelector('[data-mit-mattress]');
    const watermark = stage && stage.querySelector('[data-mit-watermark]');
    if (!stage || !mattress || !watermark) {
        return;
    }

    const rect = stage.getBoundingClientRect();
    const view = window.innerHeight || 1;
    if (rect.bottom < 0 || rect.top > view) {
        return;
    }

    const progress = (view - rect.top) / (view + rect.height);
    const offset = (Math.min(Math.max(progress, 0), 1) - 0.5) * 2;

    // 床墊只做 CSS 飄移，避免與視差 transform 叠加速度卡頓
    mattress.style.transform = '';
    watermark.style.transform = `translate3d(-50%, ${offset * 64}px, 0)`;
}

/**
 * Footer 圖「視窗釘住」：用位移抵銷滾動，圖看起來不動；
 * 外層仍是固定 480px，不會再撐出灰縫。
 */
function updateFooterPinBg() {
    const cta = document.getElementById('footer-cta');
    const img = cta && cta.querySelector('[data-footer-pin-bg]');
    if (!cta || !img) {
        return;
    }

    const rect = cta.getBoundingClientRect();
    if (rect.bottom < 0 || rect.top > window.innerHeight) {
        return;
    }

    img.style.transform = `translate3d(0, ${-rect.top}px, 0)`;
}

/** 內頁 banner：中段蓋過後導覽改回白底主色（sticky 時改看 scrollY） */
function updateInnerNavOverHero() {
    const header = document.getElementById('main-header');
    const hero = document.querySelector('[data-page-hero]');
    if (!header || !header.classList.contains('js-nav-over-hero') || !hero) {
        return;
    }

    const headerH = header.offsetHeight || 80;
    const heroH = hero.offsetHeight || 0;
    const pastHero = window.scrollY + headerH >= heroH - 60;

    header.classList.toggle('is-over-hero', !pastHero);
    header.classList.toggle('bg-transparent', !pastHero);
    header.classList.toggle('bg-white', pastHero);
    header.classList.toggle('shadow-md', pastHero);
}

function onScrollFrame() {
    updateHomeHero();
    updatePageBannerHero();
    updateMitParallax();
    updateFooterPinBg();
    updateInnerNavOverHero();
}

window.addEventListener('scroll', onScrollFrame, { passive: true });
onScrollFrame();

// Lenis 平滑捲動時補發 scroll，讓 AOS 與視差邏輯跟上
if (window.lenis) {
    window.lenis.on('scroll', () => {
        window.dispatchEvent(new Event('scroll'));
    });
}

const backToTopBtn = document.getElementById('back-to-top');
if (backToTopBtn) {
    backToTopBtn.addEventListener('click', function () {
        if (window.lenis) {
            window.lenis.scrollTo(0);
        } else {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });
}

const mobileMenuBtn = document.getElementById('mobile-menu-btn');
const mobileMenuIcon = document.getElementById('mobile-menu-icon');
const navMenu = document.getElementById('nav-menu');
const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

function setMobileMenuIcon(name) {
    if (!mobileMenuIcon) {
        return;
    }

    mobileMenuIcon.setAttribute('data-lucide', name);
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
}

function closeMobileMenu() {
    if (!navMenu) {
        return;
    }

    navMenu.classList.add('translate-x-full');
    if (mobileMenuOverlay) {
        mobileMenuOverlay.classList.add('hidden');
    }
    setMobileMenuIcon('menu');
    document.body.classList.remove('overflow-hidden');
}

function openMobileMenu() {
    if (!navMenu) {
        return;
    }

    navMenu.classList.remove('translate-x-full');
    if (mobileMenuOverlay) {
        mobileMenuOverlay.classList.remove('hidden');
    }
    setMobileMenuIcon('x');
    document.body.classList.add('overflow-hidden');
}

function toggleMobileMenu() {
    const isOpen = navMenu && !navMenu.classList.contains('translate-x-full');
    if (isOpen) {
        closeMobileMenu();
    } else {
        openMobileMenu();
    }
}

if (mobileMenuBtn && navMenu) {
    mobileMenuBtn.addEventListener('click', toggleMobileMenu);
    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', closeMobileMenu);
    }
}

let resizeTimer;
window.addEventListener('resize', () => {
    if (mainHeader) {
        mainHeader.classList.add('resize-animation-stopper');
    }

    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
        if (mainHeader) {
            mainHeader.classList.remove('resize-animation-stopper');
        }
    }, 400);

    if (window.innerWidth >= 1200) {
        closeMobileMenu();
        document.querySelectorAll('.mobile-dropdown.active').forEach((item) => {
            item.classList.remove('active');
            const arrow = item.querySelector('.icon-arrow');
            if (arrow) {
                arrow.classList.remove('rotate-180');
            }
        });
    }
});

document.querySelectorAll('.mobile-dropdown-toggle').forEach((toggle) => {
    toggle.addEventListener('click', function (e) {
        if (window.innerWidth < 1200) {
            e.preventDefault();
            const parent = this.closest('.mobile-dropdown');
            const arrow = this.querySelector('.icon-arrow');

            if (parent) {
                parent.classList.toggle('active');
            }
            if (arrow) {
                arrow.classList.toggle('rotate-180');
            }
        }
    });
});
