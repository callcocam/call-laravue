import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    presets: [
        require('./packages/callcocam/tailwind.config.js')
    ],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.{vue,js,ts,jsx,tsx}',

        './packages/callcocam/laravue-menus/resources/js/**/*.{vue,js,ts,jsx,tsx}',
        './packages/callcocam/laravue-menus/resources/views/*.blade.php',

        './packages/callcocam/laravue-file-manager/resources/js/**/*.{vue,js,ts,jsx,tsx}',
        './packages/callcocam/laravue-file-manager/resources/views/*.blade.php',

        './packages/callcocam/laravue-form/resources/views/*.blade.php',
        './packages/callcocam/laravue-form/resources/js/**/*.{vue,js,ts,jsx,tsx}',
        
        './packages/callcocam/resources/js/**/*.{vue,js,ts,jsx,tsx}',
        './packages/callcocam/resources/views/*.blade.php'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
