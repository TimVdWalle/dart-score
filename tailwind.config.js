const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        fontFamily: {

            display: ['Montserrat','sans-serif'],
            body: ['"Open Sans"', 'sans-serif'],
            sans: ['"Open Sans"', 'sans-serif'],
        },
        fontWeight: {
            'thin': 100,
            'extralight': 200,
            'light': 300,
            'regular': 400,
            'medium': 500,
            'semibold': 600,
            'bold': 700,
            'extrabold': 800,
            'black': 800,
        },

        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            'gg_red': '#DE163B',
            'gg_green': '#38A21F',

            'white': '#FFFFFF',

            'gg_grey_darker': '#0A0B0E',
            'gg_grey_dark': '#181C23',
            'gg_grey_light': '#292E38',
            'gg_grey_lighter': '#363D4A',
        },
        extend: {
            fontFamily: {

                'display': ['Montserrat','sans-serif'],
                'body': ['"Open Sans"', 'sans-serif'],
                sans: ['"Open Sans"', 'sans-serif'],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
