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

        './packages/callcocam/laravue-menus/src/**/*.{php,html,js,jsx,ts,tsx,vue}',
        './packages/callcocam/laravue-menus/resources/**/*.{vue,js,ts,jsx,tsx}',
        './packages/callcocam/laravue-menus/resources/views/*.blade.php',

        './packages/callcocam/laravue-file-manager/resources/**/*.{vue,js,ts,jsx,tsx}',
        './packages/callcocam/laravue-file-manager/resources/views/*.blade.php',

        './packages/callcocam/laravue-form/resources/views/*.blade.php',
        './packages/callcocam/laravue-form/resources/**/*.{vue,js,ts,jsx,tsx}',
        

        './packages/callcocam/laravue-makes/resources/views/*.blade.php',
        './packages/callcocam/laravue-makes/resources/**/*.{vue,js,ts,jsx,tsx}',

        './packages/callcocam/laravue-table/resources/views/*.blade.php',
        './packages/callcocam/laravue-table/resources/**/*.{vue,js,ts,jsx,tsx}',
        
        './packages/callcocam/resources/**/*.{vue,js,ts,jsx,tsx}',
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
