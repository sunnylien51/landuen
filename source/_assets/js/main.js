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

/**
 * 手機分類選單置頂：同樣用 translateY（避開 content-panel overflow）
 */
function initProcessMobileNavPin() {
    const wrap = document.querySelector('[data-process-nav-mobile-wrap]');
    const nav = document.querySelector('[data-process-nav-mobile]');
    const root = document.querySelector('[data-process-flow]');
    if (!wrap || !nav || !root) {
        return null;
    }

    const LG = 1200;

    function updatePin() {
        if (window.innerWidth >= LG) {
            wrap.style.height = '';
            nav.style.transform = '';
            nav.classList.remove('is-pinned');
            return;
        }

        wrap.style.height = `${nav.offsetHeight}px`;
        const top = wrap.getBoundingClientRect().top;
        if (top >= 0) {
            nav.style.transform = '';
            nav.classList.remove('is-pinned');
            return;
        }

        const release = root.getBoundingClientRect().bottom - nav.offsetHeight;
        const pinnedTop = Math.min(0, release);
        nav.style.transform = `translate3d(0, ${pinnedTop - top}px, 0)`;
        nav.classList.add('is-pinned');
    }

    window.__processMobileNavPin = updatePin;
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
    initProcessMobileNavPin();

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
            const linkLeft =
                activeLink.getBoundingClientRect().left -
                mobileNav.getBoundingClientRect().left +
                mobileNav.scrollLeft;
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
            const mobileNav = root.querySelector('[data-process-nav-mobile]');
            const pinOffset =
                mobileNav && window.innerWidth < 1200
                    ? -(mobileNav.offsetHeight + 16)
                    : -96;

            if (window.lenis) {
                window.lenis.scrollTo(target, {
                    offset: pinOffset,
                    onComplete: () => finishProgrammaticScroll(token, id),
                });
            } else {
                const top =
                    target.getBoundingClientRect().top + window.scrollY + pinOffset;
                window.scrollTo({ top, behavior: 'smooth' });
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
 * 以寬高從 16:9 小片 → 滿視窗（不用 transform，避免 iOS／平板 video 黑邊）
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
    const video = media.querySelector('video[data-oem-zoom-image]');
    const poster = media.querySelector('[data-oem-zoom-poster]');
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    // 與專案 lg（1200）對齊：以下只顯示圖片、不播影片
    const desktopVideo = window.matchMedia('(min-width: 1200px)');
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

    /**
     * 桌機起始：16:9 小片
     * 手機／平板起始：螢幕比例、約 72% 置中（對齊設計黃框）
     */
    function getStartSize(vw, vh) {
        if (desktopVideo.matches) {
            const startW = Math.min(START_W, Math.max(280, vw - 32));
            return { startW, startH: startW * (START_H / START_W) };
        }
        const s = 0.72;
        return { startW: vw * s, startH: vh * s };
    }

    function paint(progress) {
        const vw = window.innerWidth || 1;
        const vh = window.innerHeight || 1;
        const { startW, startH } = getStartSize(vw, vh);
        const t = clamp01(progress / ZOOM_END);

        const w = startW + (vw - startW) * t;
        const h = startH + (vh - startH) * t;
        const radius = START_RADIUS * (1 - t);
        const o = 0.2 + 0.8 * t;

        media.style.setProperty('--zoom-w', `${w}px`);
        media.style.setProperty('--zoom-h', `${h}px`);
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
        const { startH } = getStartSize(vw, vh);
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

    if (video) {
        let posterHidden = false;

        const showPoster = () => {
            posterHidden = false;
            if (!poster) {
                return;
            }
            poster.classList.remove('is-hidden');
            poster.removeAttribute('hidden');
        };

        const hidePoster = () => {
            if (!desktopVideo.matches || posterHidden || !poster) {
                return;
            }
            posterHidden = true;
            poster.classList.add('is-hidden');
            window.setTimeout(() => {
                if (posterHidden) {
                    poster.setAttribute('hidden', '');
                }
            }, 480);
        };

        const tryHidePoster = () => {
            if (
                desktopVideo.matches
                && video.readyState >= 2
                && !video.paused
                && video.currentTime > 0.02
            ) {
                hidePoster();
            }
        };

        const pauseForStaticImage = () => {
            if (!video.paused) {
                video.pause();
            }
            showPoster();
            // 避免手機／平板仍下載大影片
            video.removeAttribute('src');
            video.load();
        };

        const ensureVideoSrc = () => {
            if (video.getAttribute('src')) {
                return;
            }
            const src = video.dataset.src;
            if (src) {
                video.setAttribute('src', src);
                video.load();
            }
        };

        video.addEventListener('playing', tryHidePoster);
        video.addEventListener('timeupdate', tryHidePoster);

        if ('IntersectionObserver' in window) {
            const io = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (!desktopVideo.matches) {
                            pauseForStaticImage();
                            return;
                        }
                        if (entry.isIntersecting) {
                            ensureVideoSrc();
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

        const onVideoModeChange = () => {
            if (desktopVideo.matches) {
                ensureVideoSrc();
            } else {
                pauseForStaticImage();
            }
        };

        if (typeof desktopVideo.addEventListener === 'function') {
            desktopVideo.addEventListener('change', onVideoModeChange);
        } else if (typeof desktopVideo.addListener === 'function') {
            desktopVideo.addListener(onVideoModeChange);
        }

        if (!desktopVideo.matches) {
            pauseForStaticImage();
        }
    }

    window.__updateOemZoom = updateOemZoom;
    window.addEventListener('resize', updateOemZoom, { passive: true });
    updateOemZoom();
}

/**
 * 橫向區拖曳：
 * - 預設：鬆手吸附最近一格（夥伴 logo 列）
 * - data-drag-scroll="free"：自由停住、不吸附（關於選單）
 * 觸控仍交給原生慣性捲動
 */
function initDragScroll() {
    document.querySelectorAll('[data-drag-scroll]').forEach((el) => {
        const free = el.getAttribute('data-drag-scroll') === 'free';
        const items = Array.from(el.querySelectorAll('[data-drag-scroll-item]'));
        if (!items.length) {
            return;
        }

        let isDown = false;
        let startX = 0;
        let startScroll = 0;
        let moved = false;
        let lastX = 0;
        let lastT = 0;
        let velocity = 0;

        function itemScrollLeft(item) {
            return (
                item.getBoundingClientRect().left -
                el.getBoundingClientRect().left +
                el.scrollLeft
            );
        }

        function nearestLeft(from) {
            let best = 0;
            let bestDist = Infinity;
            const maxScroll = Math.max(0, el.scrollWidth - el.clientWidth);
            items.forEach((item) => {
                const left = Math.min(Math.max(0, itemScrollLeft(item)), maxScroll);
                const d = Math.abs(left - from);
                if (d < bestDist) {
                    bestDist = d;
                    best = left;
                }
            });
            return best;
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
            velocity = 0;
            startX = lastX = e.clientX;
            lastT = performance.now();
            startScroll = el.scrollLeft;
            // 等真正移動再進入拖曳，否則會吃掉連結 click
        });

        el.addEventListener('pointermove', (e) => {
            if (!isDown) {
                return;
            }
            const dx = e.clientX - startX;
            if (!moved && Math.abs(dx) <= 4) {
                return;
            }

            if (!moved) {
                moved = true;
                el.classList.add('is-dragging');
                el.style.scrollSnapType = 'none';
                try {
                    el.setPointerCapture(e.pointerId);
                } catch (_) {
                    /* ignore */
                }
            }

            const now = performance.now();
            const dt = Math.max(1, now - lastT);
            velocity = ((e.clientX - lastX) / dt) * 16;
            lastX = e.clientX;
            lastT = now;
            el.scrollLeft = startScroll - dx;
        });

        function endDrag(e) {
            if (!isDown) {
                return;
            }
            isDown = false;
            el.classList.remove('is-dragging');
            el.style.scrollSnapType = '';

            if (!moved) {
                return;
            }

            if (!free) {
                const coast = Math.max(-180, Math.min(180, -velocity * 12));
                const target = nearestLeft(el.scrollLeft + coast);
                el.scrollTo({ left: target, behavior: 'smooth' });
            }

            e.preventDefault();
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

/**
 * 關於子選單：換頁後維持橫向捲動位置（避免每次跳回最左）
 */
function initAboutSubnavScroll() {
    const nav = document.querySelector('.about-subnav-scroll');
    if (!nav) {
        return;
    }

    const storageKey = 'about-subnav-scroll-left';
    const saved = sessionStorage.getItem(storageKey);

    if (saved !== null) {
        nav.scrollLeft = Number.parseInt(saved, 10) || 0;
    } else {
        const active = nav.querySelector('[aria-current="page"]');
        if (active) {
            const offset =
                active.getBoundingClientRect().left -
                nav.getBoundingClientRect().left +
                nav.scrollLeft;
            nav.scrollLeft = Math.max(
                0,
                offset - (nav.clientWidth - active.offsetWidth) / 2
            );
        }
    }

    nav.querySelectorAll('a[href]').forEach((link) => {
        link.addEventListener('click', () => {
            sessionStorage.setItem(storageKey, String(nav.scrollLeft));
        });
    });
}

/** 首頁 Hero：淡入淡出輪播（左右箭頭 + 目前／總數進度條） */
function initHomeHeroSlider() {
    const root = document.querySelector('[data-home-hero-slider]');
    if (!root) {
        return;
    }

    const slides = Array.from(root.querySelectorAll('[data-home-hero-slide]'));
    const controls = root.querySelector('[data-home-hero-controls]');
    if (slides.length < 2 || !controls) {
        return;
    }

    const prevBtn = controls.querySelector('[data-home-hero-prev]');
    const nextBtn = controls.querySelector('[data-home-hero-next]');
    const currentEl = controls.querySelector('[data-home-hero-current]');
    const progressEl = controls.querySelector('[data-home-hero-progress]');
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    const INTERVAL = 5000;
    let index = Math.max(
        0,
        slides.findIndex((slide) => slide.classList.contains('is-active'))
    );
    let timer = null;
    let paused = false;

    root.style.setProperty('--home-hero-interval', `${INTERVAL}ms`);

    function pad(n) {
        return String(n).padStart(2, '0');
    }

    function restartProgress() {
        if (!progressEl) {
            return;
        }
        progressEl.classList.remove('is-running');
        progressEl.style.width = '';
        // 強制重啟 CSS animation
        void progressEl.offsetWidth;
        if (reduceMotion.matches) {
            progressEl.style.width = '100%';
            return;
        }
        if (paused) {
            progressEl.style.width = '0%';
            return;
        }
        progressEl.classList.add('is-running');
    }

    function goTo(nextIndex) {
        const total = slides.length;
        index = ((nextIndex % total) + total) % total;

        slides.forEach((slide, i) => {
            slide.classList.toggle('is-active', i === index);
        });

        if (currentEl) {
            currentEl.textContent = pad(index + 1);
        }

        restartProgress();
        armTimer();
    }

    function armTimer() {
        clearTimeout(timer);
        timer = null;
        if (paused || reduceMotion.matches) {
            return;
        }
        timer = window.setTimeout(() => goTo(index + 1), INTERVAL);
    }

    function pause() {
        paused = true;
        clearTimeout(timer);
        timer = null;
        if (!progressEl) {
            return;
        }
        const width = getComputedStyle(progressEl).width;
        progressEl.classList.remove('is-running');
        progressEl.style.width = width;
    }

    function resume() {
        if (!paused) {
            return;
        }
        paused = false;
        restartProgress();
        armTimer();
    }

    prevBtn?.addEventListener('click', () => goTo(index - 1));
    nextBtn?.addEventListener('click', () => goTo(index + 1));

    root.addEventListener('mouseenter', pause);
    root.addEventListener('mouseleave', resume);
    root.addEventListener('focusin', pause);
    root.addEventListener('focusout', (event) => {
        if (!root.contains(event.relatedTarget)) {
            resume();
        }
    });

    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            pause();
        } else {
            resume();
        }
    });

    reduceMotion.addEventListener('change', () => {
        if (reduceMotion.matches) {
            pause();
        } else {
            resume();
        }
    });

    goTo(index);
}

/**
 * YouTube：封面點擊後在原地插入 iframe 直接播放
 */
function initYoutubeFacades() {
    document.querySelectorAll('[data-youtube-facade]').forEach((root) => {
        if (root.dataset.youtubeBound === '1') {
            return;
        }
        root.dataset.youtubeBound = '1';

        const id = root.getAttribute('data-youtube-id');
        const hit = root.querySelector('.about-youtube__hit');
        if (!id || !hit) {
            return;
        }

        hit.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            if (root.classList.contains('is-playing')) {
                return;
            }

            const iframe = document.createElement('iframe');
            iframe.src =
                `https://www.youtube.com/embed/${encodeURIComponent(id)}` +
                '?autoplay=1&rel=0&modestbranding=1&playsinline=1&iv_load_policy=3';
            iframe.title = hit.getAttribute('aria-label') || 'YouTube video';
            iframe.setAttribute(
                'allow',
                'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share'
            );
            iframe.setAttribute('allowfullscreen', '');
            iframe.setAttribute('referrerpolicy', 'strict-origin-when-cross-origin');
            root.appendChild(iframe);
            root.classList.add('is-playing');
        });
    });
}

onReady(function () {
    initAos();
    bindAosRevealFallback();
    initProcessFlowNav();
    initOemZoom();
    initHomeMaterials();
    initHomeHeroSlider();
    initDragScroll();
    initAboutSubnavScroll();
    initYoutubeFacades();

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
    if (typeof window.__processMobileNavPin === 'function') {
        window.__processMobileNavPin();
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
const navMenu = document.getElementById('nav-menu');
const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

function setMobileMenuIcon(name) {
    // Lucide createIcons() 會把節點換成新 SVG，必須每次重查，不能快取舊參照
    const icon = document.getElementById('mobile-menu-icon');
    if (!icon) {
        return;
    }

    icon.setAttribute('data-lucide', name);
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    if (mobileMenuBtn) {
        mobileMenuBtn.setAttribute('aria-label', name === 'x' ? '關閉選單' : '開啟選單');
    }
}

function lockPageScroll() {
    document.documentElement.classList.add('overflow-hidden');
    document.body.classList.add('overflow-hidden');
    if (window.lenis) {
        window.lenis.stop();
    }
}

function unlockPageScroll() {
    document.documentElement.classList.remove('overflow-hidden');
    document.body.classList.remove('overflow-hidden');
    if (window.lenis) {
        window.lenis.start();
    }
}

function closeMobileMenu() {
    if (!navMenu) {
        return;
    }

    navMenu.classList.add('is-closed');
    if (mobileMenuOverlay) {
        mobileMenuOverlay.classList.remove('is-visible');
    }
    if (mainHeader) {
        mainHeader.classList.remove('is-mobile-menu-open');
    }
    setMobileMenuIcon('menu');
    unlockPageScroll();
}

function openMobileMenu() {
    if (!navMenu) {
        return;
    }

    navMenu.classList.remove('is-closed');
    if (mobileMenuOverlay) {
        mobileMenuOverlay.classList.add('is-visible');
    }
    if (mainHeader) {
        mainHeader.classList.add('is-mobile-menu-open');
    }
    setMobileMenuIcon('x');
    lockPageScroll();
}

function toggleMobileMenu() {
    const isOpen = navMenu && !navMenu.classList.contains('is-closed');
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
