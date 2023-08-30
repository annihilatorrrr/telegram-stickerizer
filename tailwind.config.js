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
                'tg-bg': 'var(--tg-theme-bg-color)',
                'tg-text': 'var(--tg-theme-text-color)',
                'tg-button-bg': 'var(--tg-theme-button-color)',
                'tg-button-text': 'var(--tg-theme-button-text-color)',
                'tg-link': 'var(--tg-theme-link-color)',
                'tg-hint': 'var(--tg-theme-hint-color)',
                'tg-bg-secondary': 'var(--tg-theme-secondary-bg-color)',
                'tg-scheme': 'var(--tg-scheme)',
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
