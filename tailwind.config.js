import plugin from 'tailwindcss/plugin';

const hoverPlugin = plugin(function ({addVariant, e, postcss}) {
    addVariant('hover', ({container, separator}) => {
        const hoverRule = postcss.atRule({name: 'media', params: '(hover: hover)'});
        hoverRule.append(container.nodes);
        container.append(hoverRule);
        hoverRule.walkRules(rule => {
            rule.selector = `.${e(`hover${separator}${rule.selector.slice(1)}`)}:hover`
        });
    });
});


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
                'tg-scheme': 'var(--tg-scheme)',
                'tg-bg': 'var(--tg-theme-bg-color)',
                'tg-text': 'var(--tg-theme-text-color)',
                'tg-button-bg': 'var(--tg-theme-button-color)',
                'tg-button-text': 'var(--tg-theme-button-text-color)',
                'tg-link': 'var(--tg-theme-link-color)',
                'tg-hint': 'var(--tg-theme-hint-color)',
                'tg-bg-secondary': 'var(--tg-theme-secondary-bg-color)',

                'tg-scheme-900': 'var(--tg-scheme-900)',
                'tg-scheme-800': 'var(--tg-scheme-800)',
                'tg-scheme-700': 'var(--tg-scheme-700)',
                'tg-scheme-600': 'var(--tg-scheme-600)',
                'tg-scheme-400': 'var(--tg-scheme-400)',
                'tg-scheme-300': 'var(--tg-scheme-300)',
                'tg-scheme-200': 'var(--tg-scheme-200)',
                'tg-scheme-100': 'var(--tg-scheme-100)',

                'tg-bg-900': 'var(--tg-theme-bg-color-900)',
                'tg-bg-800': 'var(--tg-theme-bg-color-800)',
                'tg-bg-700': 'var(--tg-theme-bg-color-700)',
                'tg-bg-600': 'var(--tg-theme-bg-color-600)',
                'tg-bg-400': 'var(--tg-theme-bg-color-400)',
                'tg-bg-300': 'var(--tg-theme-bg-color-300)',
                'tg-bg-200': 'var(--tg-theme-bg-color-200)',
                'tg-bg-100': 'var(--tg-theme-bg-color-100)',

                'tg-text-900': 'var(--tg-theme-text-color-900)',
                'tg-text-800': 'var(--tg-theme-text-color-800)',
                'tg-text-700': 'var(--tg-theme-text-color-700)',
                'tg-text-600': 'var(--tg-theme-text-color-600)',
                'tg-text-400': 'var(--tg-theme-text-color-400)',
                'tg-text-300': 'var(--tg-theme-text-color-300)',
                'tg-text-200': 'var(--tg-theme-text-color-200)',
                'tg-text-100': 'var(--tg-theme-text-color-100)',

                'tg-button-bg-900': 'var(--tg-theme-button-color-900)',
                'tg-button-bg-800': 'var(--tg-theme-button-color-800)',
                'tg-button-bg-700': 'var(--tg-theme-button-color-700)',
                'tg-button-bg-600': 'var(--tg-theme-button-color-600)',
                'tg-button-bg-400': 'var(--tg-theme-button-color-400)',
                'tg-button-bg-300': 'var(--tg-theme-button-color-300)',
                'tg-button-bg-200': 'var(--tg-theme-button-color-200)',
                'tg-button-bg-100': 'var(--tg-theme-button-color-100)',

                'tg-button-text-900': 'var(--tg-theme-button-text-color-900)',
                'tg-button-text-800': 'var(--tg-theme-button-text-color-800)',
                'tg-button-text-700': 'var(--tg-theme-button-text-color-700)',
                'tg-button-text-600': 'var(--tg-theme-button-text-color-600)',
                'tg-button-text-400': 'var(--tg-theme-button-text-color-400)',
                'tg-button-text-300': 'var(--tg-theme-button-text-color-300)',
                'tg-button-text-200': 'var(--tg-theme-button-text-color-200)',
                'tg-button-text-100': 'var(--tg-theme-button-text-color-100)',

                'tg-link-900': 'var(--tg-theme-link-color-900)',
                'tg-link-800': 'var(--tg-theme-link-color-800)',
                'tg-link-700': 'var(--tg-theme-link-color-700)',
                'tg-link-600': 'var(--tg-theme-link-color-600)',
                'tg-link-400': 'var(--tg-theme-link-color-400)',
                'tg-link-300': 'var(--tg-theme-link-color-300)',
                'tg-link-200': 'var(--tg-theme-link-color-200)',
                'tg-link-100': 'var(--tg-theme-link-color-100)',

                'tg-hint-900': 'var(--tg-theme-hint-color-900)',
                'tg-hint-800': 'var(--tg-theme-hint-color-800)',
                'tg-hint-700': 'var(--tg-theme-hint-color-700)',
                'tg-hint-600': 'var(--tg-theme-hint-color-600)',
                'tg-hint-400': 'var(--tg-theme-hint-color-400)',
                'tg-hint-300': 'var(--tg-theme-hint-color-300)',
                'tg-hint-200': 'var(--tg-theme-hint-color-200)',
                'tg-hint-100': 'var(--tg-theme-hint-color-100)',

                'tg-bg-secondary-900': 'var(--tg-theme-secondary-bg-color-900)',
                'tg-bg-secondary-800': 'var(--tg-theme-secondary-bg-color-800)',
                'tg-bg-secondary-700': 'var(--tg-theme-secondary-bg-color-700)',
                'tg-bg-secondary-600': 'var(--tg-theme-secondary-bg-color-600)',
                'tg-bg-secondary-400': 'var(--tg-theme-secondary-bg-color-400)',
                'tg-bg-secondary-300': 'var(--tg-theme-secondary-bg-color-300)',
                'tg-bg-secondary-200': 'var(--tg-theme-secondary-bg-color-200)',
                'tg-bg-secondary-100': 'var(--tg-theme-secondary-bg-color-100)',

                'stickerizer': {
                    DEFAULT: '#056104',
                    50: '#96FB95',
                    100: '#76F975',
                    200: '#37F735',
                    300: '#0CE009',
                    400: '#08A107',
                    500: '#056104',
                    600: '#045203',
                    700: '#034403',
                    800: '#033502',
                    900: '#022602',
                    950: '#021F01'
                },
            }
        },
        future: {
            hoverOnlyWhenSupported: true,
        },
    },
    plugins: [
        hoverPlugin,
    ],
}
