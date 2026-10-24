/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './source/**/*.blade.php',
        './source/**/*.js',
        './source/**/*.php',
        './source/**/*.html',
        './source/**/*.md',
        './config.php',
    ],
    // 字級 token 一律保留，供 md:/lg: 變體與尚未用到的 class
    safelist: [
        {
            pattern: /^text-(cb|ch|eb|eh)[1-5]$/,
            variants: ['md', 'lg'],
        },
    ],
    theme: {
        screens: {
            'md': '800px',
            'lg': '1200px',
        },
        extend: {
            colors: {
                main1: '#294B7B',
                main2: '#91A4B9',
                main3: '#B99E7F',
                gray5: '#192B44',
                gray4: '#768296',
                gray2: '#CBD5E7',
                gray1: '#E8EDF6',
                bg: '#F2F5F8',
                overlay: '#0C172B',
            },
            fontFamily: {
                sans: ['Noto Sans TC', 'sans-serif'],
                serif: ['Noto Serif TC', 'serif'],
                display: ['Tenor Sans', 'sans-serif'],
            },
            backgroundImage: {
                'content-gradient': 'linear-gradient(180deg, #FFFFFF 40%, #EDF2FB 100%)',
            },
        },
    },
    plugins: [],
};
