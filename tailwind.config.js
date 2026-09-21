import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/**
 * @param {string} name
 * @returns {string}
 */
const token = (name) => `rgb(var(--${name}) / <alpha-value>)`;

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['system-ui', '-apple-system', 'BlinkMacSystemFont', '"Segoe UI"', 'Roboto', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                bg: token('bg'),
                surface: token('surface'),
                label: token('label'),
                'label-2': token('label-2'),
                separator: 'rgb(var(--separator))',
                field: token('field'),
                accent: token('accent'),
                'on-accent': token('on-accent'),
                danger: token('danger'),
                'on-danger': token('on-danger'),
                success: token('success'),
            },
        },
    },

    plugins: [forms],
};
