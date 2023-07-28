/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'tg-bg': 'var(--tg-theme-bg-color)',
                'tg-text': 'var(--tg-theme-text-color)',
                'tg-button-bg': 'var(--tg-theme-button-color)',
                'tg-button-text': 'var(--tg-theme-button-text-color)',
                'tg-link': 'var(--tg-theme-link-color)',
                'tg-hint': 'var(--tg-theme-hint-color)',
                'tg-bg-secondary': 'var(--tg-theme-secondary-bg-color)',
            }
        },
    },
    plugins: [],
}
