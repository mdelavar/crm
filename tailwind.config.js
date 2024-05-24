import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['dana', ...defaultTheme.fontFamily.sans],
            },
            colors : {
                themePrimary: '#4d5862',
                themeLightPrimary: '#6e7780',
                themeOverlyPrimary: 'rgba(77,88,98,0.89)',
                themeDarkPrimary: '#36495b',
                themeSecondary: '#EE4439',
                themeGray: '#f1f5f9',
                themeDarkGray: '#e6ecf2'
            }
        },
    },

    plugins: [forms],
};
