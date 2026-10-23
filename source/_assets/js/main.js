document.addEventListener('DOMContentLoaded', function () {
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            once: true,
        });
    }

    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    if (typeof Fancybox !== 'undefined') {
        Fancybox.bind('[data-fancybox]', {});
    }
});

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

function updateHeaderOnScroll() {
    if (!mainHeader) {
        return;
    }

    const overHero = mainHeader.classList.contains('is-over-hero');
    const scrolled = window.scrollY > 20;

    mainHeader.classList.toggle('is-scrolled', !overHero || scrolled);
    mainHeader.classList.toggle('bg-transparent', overHero && !scrolled);
    mainHeader.classList.toggle('bg-white', !overHero || scrolled);
    mainHeader.classList.toggle('shadow-md', !overHero || scrolled);
}

window.addEventListener('scroll', updateHeaderOnScroll, { passive: true });
updateHeaderOnScroll();

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
