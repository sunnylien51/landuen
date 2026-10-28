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

/**
 * 合作流程左側壁掛：用 translateY（不改 overflow／不用 fixed）
 * fixed 會被 .content-panel 的 overflow:hidden 裁切；改 overflow 又會弄壞 banner 蓋過效果。
 */
function initProcessAsidePin() {
    const rail = document.querySelector('[data-process-rail]');
    const aside = document.querySelector('[data-process-aside]');
    if (!rail || !aside) {
        return null;
    }

    const counter = rail.querySelector('[data-process-counter-wrap]');
    const line = rail.querySelector('[data-process-line]');
    const parallax = Array.from(rail.querySelectorAll('[data-process-parallax]'));
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    const LG = 1200;
    const LINE_GAP = 16;
    // 尚未捲到可置中時，不要貼在 rail 頂邊（對齊左側 aside 的 pt-16）
    const MIN_TOP = 64;

    function updateParallax() {
        const vh = window.innerHeight;
        parallax.forEach((el) => {
            if (reduceMotion.matches) {
                el.style.transform = '';
                return;
            }
            const rect = el.parentElement.getBoundingClientRect();
            if (rect.bottom < 0 || rect.top > vh) {
                return;
            }
            const progress = (vh - rect.top) / (vh + rect.height) - 0.5;
            el.style.transform = `translate3d(0, ${(progress * -5).toFixed(2)}%, 0)`;
        });
    }

    function pinToViewportCenter(el, railH, railTop) {
        const elH = el.offsetHeight;
        const elMax = Math.max(0, railH - elH);
        const centered = window.innerHeight / 2 - elH / 2 - railTop;
        return Math.min(Math.max(centered, MIN_TOP), elMax);
    }

    function updatePin() {
        updateParallax();

        if (window.innerWidth < LG) {
            aside.style.transform = '';
            if (counter) {
                counter.style.transform = '';
            }
            return;
        }

        const railH = rail.offsetHeight;
        const railTop = rail.getBoundingClientRect().top;

        const asideY = pinToViewportCenter(aside, railH, railTop);
        aside.style.transform = asideY ? `translate3d(0, ${asideY}px, 0)` : '';

        if (counter) {
            const counterY = pinToViewportCenter(counter, railH, railTop);
            const counterH = counter.offsetHeight;
            counter.style.transform = `translate3d(0, ${counterY}px, 0)`;
            if (line) {
                line.style.setProperty('--gap-start', `${counterY - LINE_GAP}px`);
                line.style.setProperty('--gap-end', `${counterY + counterH + LINE_GAP}px`);
            }
        }
    }

    window.__processAsidePin = updatePin;
    window.addEventListener('resize', updatePin);
    updatePin();
    return updatePin;
}

/** 合作流程：左側／手機錨點 scroll-spy + 平滑捲動 */
function initProcessFlowNav() {
    const root = document.querySelector('[data-process-flow]');
    if (!root) {
        return;
    }

    initProcessAsidePin();

    const steps = Array.from(root.querySelectorAll('[data-process-step]'));
    const links = Array.from(root.querySelectorAll('[data-process-link]'));
    const counter = root.querySelector('[data-process-counter]');
    if (!steps.length || !links.length) {
        return;
    }

    function setActive(id) {
        links.forEach((link) => {
            link.classList.toggle('is-active', link.getAttribute('data-process-id') === id);
        });

        const index = steps.findIndex((step) => step.id === id);
        if (counter && index >= 0) {
            counter.style.transform = `translate3d(0, ${-index}em, 0)`;
        }

        const mobileNav = root.querySelector('[data-process-nav-mobile]');
        const activeLink = mobileNav && mobileNav.querySelector(`[data-process-id="${id}"]`);
        if (activeLink && mobileNav) {
            const linkLeft = activeLink.offsetLeft;
            const linkWidth = activeLink.offsetWidth;
            const navWidth = mobileNav.clientWidth;
            mobileNav.scrollTo({
                left: linkLeft - (navWidth - linkWidth) / 2,
                behavior: 'smooth',
            });
        }
    }

    let currentId = steps[0].id;
    let scrollToken = 0;
    let unlockTimer = 0;
    setActive(currentId);

    // 點擊當下先標示目標，平滑捲動途中不要讓經過的上一項把高亮搶回去。
    function beginProgrammaticScroll(id) {
        const token = ++scrollToken;
        window.clearTimeout(unlockTimer);
        unlockTimer = window.setTimeout(() => finishProgrammaticScroll(token, id), 1600);
        currentId = id;
        setActive(id);
        return token;
    }

    function finishProgrammaticScroll(token, id) {
        if (token !== scrollToken) {
            return;
        }
        window.clearTimeout(unlockTimer);
        scrollToken = 0;
        currentId = id;
        setActive(id);
    }

    function activeIdFromScroll() {
        const line = Math.min(window.innerHeight * 0.3, 160);
        let id = steps[0].id;
        steps.forEach((step) => {
            if (step.getBoundingClientRect().top <= line) {
                id = step.id;
            }
        });
        return id;
    }

    function syncFromScroll() {
        if (scrollToken) {
            return;
        }
        const id = activeIdFromScroll();
        if (id === currentId) {
            return;
        }
        currentId = id;
        setActive(id);
    }

    links.forEach((link) => {
        link.addEventListener('click', (e) => {
            const id = link.getAttribute('data-process-id');
            const target = id && document.getElementById(id);
            if (!target) {
                return;
            }

            e.preventDefault();
            const token = beginProgrammaticScroll(id);

            if (window.lenis) {
                window.lenis.scrollTo(target, {
                    offset: -96,
                    onComplete: () => finishProgrammaticScroll(token, id),
                });
            } else {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                window.addEventListener(
                    'scrollend',
                    () => finishProgrammaticScroll(token, id),
                    { once: true }
                );
            }

            if (history.replaceState) {
                history.replaceState(null, '', `#${id}`);
            }
        });
    });

    window.addEventListener('scroll', syncFromScroll, { passive: true });
    syncFromScroll();
}

/**
 * 首頁 OEM 大圖：sticky 捲動縮放
 * 媒體固定 100vw×100vh，以 scale 放大（避免改 width/height 重排跳動）
 * 進度起點：視覺上影片上緣剛進視窗；0→70% 放大，70→100% 停住
 */
function initOemZoom() {
    const root = document.querySelector('[data-oem-zoom]');
    const media = root && root.querySelector('[data-oem-zoom-media]');
    if (!root || !media) {
        return;
    }

    const overlay = media.querySelector('[data-oem-zoom-overlay]');
    const title = media.querySelector('[data-oem-zoom-title]');
    const body = media.querySelector('[data-oem-zoom-body]');
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    const ZOOM_END = 0.7;
    const START_W = 960;
    const START_H = 540;
    const START_RADIUS = 20;

    function clamp01(n) {
        return Math.min(1, Math.max(0, n));
    }

    function fadeFrom(progress, start, dur = 0.16) {
        return clamp01((progress - start) / dur);
    }

    function applyText(el, t) {
        if (!el) {
            return;
        }
        el.style.opacity = String(t);
        el.style.transform = t >= 0.999 ? 'none' : `translate3d(0, ${(1 - t) * 16}px, 0)`;
    }

    function paint(progress) {
        const vw = window.innerWidth || 1;
        const vh = window.innerHeight || 1;
        const startW = Math.min(START_W, Math.max(280, vw - 32));
        const startH = startW * (START_H / START_W);
        const t = clamp01(progress / ZOOM_END);

        // 以寬為基準的 scale；視覺尺寸 ≈ startW → 100vw
        const scale0 = startW / vw;
        const scale = scale0 + (1 - scale0) * t;
        // border-radius 會被 scale 一起縮小，故除以 scale 維持視覺約 20→0
        const radius = scale > 0.001 ? (START_RADIUS * (1 - t)) / scale : 0;
        // 滿版約 0.7（原為 1），色遮仍在、影片仍可辨
        const o = 0.2 + 0.8 * t;

        media.style.setProperty('--zoom-scale', String(scale));
        media.style.setProperty('--zoom-r', `${radius}px`);
        media.style.setProperty('--zoom-o', String(o));
        if (overlay) {
            overlay.style.opacity = String(o);
        }

        applyText(title, fadeFrom(progress, 0.48, 0.16));
        applyText(body, fadeFrom(progress, 0.58, 0.16));
    }

    function updateOemZoom() {
        if (reduceMotion.matches) {
            return;
        }

        const vh = window.innerHeight || 1;
        const vw = window.innerWidth || 1;
        const startW = Math.min(START_W, Math.max(280, vw - 32));
        const startH = startW * (START_H / START_W);
        // 視覺上置中小片上緣進視窗底時開始
        const startAt = (vh + startH) / 2;
        const endTravel = root.offsetHeight - vh;
        const total = startAt + endTravel;
        if (total <= 0) {
            paint(1);
            return;
        }

        const top = root.getBoundingClientRect().top;
        const progress = clamp01((startAt - top) / total);
        paint(progress);
    }

    const video = media.querySelector('video[data-oem-zoom-image]');
    const poster = media.querySelector('[data-oem-zoom-poster]');
    if (video) {
        let posterHidden = false;
        const hidePoster = () => {
            if (posterHidden || !poster) {
                return;
            }
            posterHidden = true;
            poster.classList.add('is-hidden');
            window.setTimeout(() => {
                poster.setAttribute('hidden', '');
            }, 480);
        };

        const tryHidePoster = () => {
            if (video.readyState >= 2 && !video.paused && video.currentTime > 0.02) {
                hidePoster();
            }
        };

        video.addEventListener('playing', tryHidePoster);
        video.addEventListener('timeupdate', tryHidePoster);

        // 進場播放、離場暫停；有畫面後淡出封面
        if ('IntersectionObserver' in window) {
            const io = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            const play = video.play();
                            if (play && typeof play.then === 'function') {
                                play.then(tryHidePoster).catch(() => {});
                            }
                        } else if (!video.paused) {
                            video.pause();
                        }
                    });
                },
                { threshold: 0.12 }
            );
            io.observe(root);
        }
    }

    window.__updateOemZoom = updateOemZoom;
    window.addEventListener('resize', updateOemZoom, { passive: true });
    updateOemZoom();
}

/**
 * 橫向區：桌機拖曳一次只進一格；觸控靠 scroll-snap
 */
function initDragScroll() {
    const THRESHOLD = 56;
    const DRAG_MAX = 36;
    const DRAG_FACTOR = 0.28;

    document.querySelectorAll('[data-drag-scroll]').forEach((el) => {
        const track = el.querySelector('[data-drag-scroll-track]') || el.firstElementChild;
        const items = Array.from(el.querySelectorAll('[data-drag-scroll-item]'));
        if (!track || !items.length) {
            return;
        }

        let isDown = false;
        let startX = 0;
        let moved = false;
        let startIndex = 0;

        function maxIndex() {
            const maxScroll = Math.max(0, el.scrollWidth - el.clientWidth);
            let last = 0;
            items.forEach((item, i) => {
                if (item.offsetLeft <= maxScroll + 1) {
                    last = i;
                }
            });
            return last;
        }

        function currentIndex() {
            const x = el.scrollLeft;
            let best = 0;
            let bestDist = Infinity;
            items.forEach((item, i) => {
                const d = Math.abs(item.offsetLeft - x);
                if (d < bestDist) {
                    bestDist = d;
                    best = i;
                }
            });
            return best;
        }

        function goTo(i) {
            const next = Math.max(0, Math.min(maxIndex(), i));
            const left = items[next].offsetLeft;
            el.scrollTo({ left, behavior: 'smooth' });
            return next;
        }

        function setDragOffset(dx) {
            const capped = Math.max(-DRAG_MAX, Math.min(DRAG_MAX, dx * DRAG_FACTOR));
            track.style.transform = capped ? `translate3d(${capped}px,0,0)` : '';
        }

        function clearDragOffset() {
            track.style.transform = '';
        }

        el.addEventListener('pointerdown', (e) => {
            if (e.pointerType === 'touch') {
                return;
            }
            if (e.button !== 0) {
                return;
            }
            isDown = true;
            moved = false;
            startX = e.clientX;
            startIndex = currentIndex();
            el.classList.add('is-dragging');
            try {
                el.setPointerCapture(e.pointerId);
            } catch (_) {
                /* ignore */
            }
        });

        el.addEventListener('pointermove', (e) => {
            if (!isDown) {
                return;
            }
            const dx = e.clientX - startX;
            if (Math.abs(dx) > 6) {
                moved = true;
            }
            setDragOffset(dx);
        });

        function endDrag(e) {
            if (!isDown) {
                return;
            }
            const dx = e.clientX - startX;
            isDown = false;
            el.classList.remove('is-dragging');
            clearDragOffset();

            if (Math.abs(dx) >= THRESHOLD) {
                goTo(startIndex + (dx < 0 ? 1 : -1));
            } else {
                goTo(startIndex);
            }

            if (moved) {
                e.preventDefault();
            }
        }

        el.addEventListener('pointerup', endDrag);
        el.addEventListener('pointercancel', endDrag);

        el.addEventListener(
            'click',
            (e) => {
                if (moved) {
                    e.preventDefault();
                    e.stopPropagation();
                    moved = false;
                }
            },
            true
        );
    });
}

/**
 * 首頁六大材料：風琴切換說明與左側圖
 */
function initHomeMaterials() {
    const root = document.querySelector('[data-home-materials]');
    if (!root) {
        return;
    }

    const img = root.querySelector('[data-home-mat-img]');
    const items = Array.from(root.querySelectorAll('[data-home-mat-item]'));
    if (!img || !items.length) {
        return;
    }

    function activate(item) {
        items.forEach((el) => {
            const on = el === item;
            el.classList.toggle('is-active', on);
            el.setAttribute('aria-expanded', on ? 'true' : 'false');
        });

        const nextSrc = item.getAttribute('data-img');
        const nextAlt = item.getAttribute('data-alt') || '';
        if (nextSrc && img.getAttribute('src') !== nextSrc) {
            img.style.opacity = '0';
            window.setTimeout(() => {
                img.setAttribute('src', nextSrc);
                img.setAttribute('alt', nextAlt);
                img.style.opacity = '1';
            }, 180);
        }
    }

    items.forEach((item) => {
        item.addEventListener('click', () => {
            if (!item.classList.contains('is-active')) {
                activate(item);
            }
        });
    });
}

onReady(function () {
    initAos();
    bindAosRevealFallback();
    initProcessFlowNav();
    initOemZoom();
    initHomeMaterials();
    initDragScroll();

    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    if (typeof Fancybox !== 'undefined') {
        Fancybox.bind('[data-fancybox]', {});
    }

    const mitStage = document.querySelector('[data-mit-stage]');
    const mitWatermark = mitStage && mitStage.querySelector('[data-mit-watermark]');
    const mitIntro = mitStage && mitStage.querySelector('[data-mit-intro]');
    const mitFloat = mitStage && mitStage.querySelector('[data-mit-float]');
    if (mitStage && 'IntersectionObserver' in window) {
        const mitObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) {
                        return;
                    }
                    if (mitWatermark) {
                        mitWatermark.classList.add('is-inview');
                    }
                    if (mitIntro) {
                        mitIntro.classList.add('is-inview');
                        // 等淡入（0.5s delay + 1.2s）結束後再漂浮，比較看得出層次
                        window.setTimeout(() => {
                            if (mitFloat) {
                                mitFloat.classList.add('is-floating');
                            }
                        }, 1800);
                    } else if (mitFloat) {
                        mitFloat.classList.add('is-floating');
                    }
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
        if (typeof window.__processAsidePin === 'function') {
            window.__processAsidePin();
        }
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
    if (typeof window.__updateOemZoom === 'function') {
        window.__updateOemZoom();
    }
    if (typeof window.__processAsidePin === 'function') {
        window.__processAsidePin();
    }
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

/** 合作洽詢表單：驗證後送 Netlify Forms，並切換成功狀態 */
const partnershipForm = document.getElementById('partnership-form');
const partnershipSuccess = document.getElementById('partnership-success');

function showPartnershipSuccess() {
    if (!partnershipForm || !partnershipSuccess) {
        return;
    }

    partnershipForm.classList.add('hidden');
    partnershipSuccess.classList.remove('hidden');
    partnershipSuccess.classList.add('flex');

    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    partnershipSuccess.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function resetPartnershipForm() {
    if (!partnershipForm || !partnershipSuccess) {
        return;
    }

    partnershipSuccess.classList.add('hidden');
    partnershipSuccess.classList.remove('flex');
    partnershipForm.classList.remove('hidden');
    partnershipForm.reset();
    partnershipForm.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

if (partnershipForm) {
    partnershipForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        if (!partnershipForm.checkValidity()) {
            partnershipForm.reportValidity();
            return;
        }

        const submitBtn = partnershipForm.querySelector('[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
        }

        const body = new URLSearchParams(new FormData(partnershipForm)).toString();

        try {
            await fetch(partnershipForm.getAttribute('action') || window.location.pathname, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body,
            });
        } catch (_) {
            // 本機預覽無 Netlify 時仍顯示成功狀態
        }

        showPartnershipSuccess();
        partnershipForm.reset();

        if (submitBtn) {
            submitBtn.disabled = false;
        }
    });
}

if (partnershipSuccess) {
    partnershipSuccess.querySelectorAll('[data-partnership-reset]').forEach((el) => {
        el.addEventListener('click', resetPartnershipForm);
    });
}
