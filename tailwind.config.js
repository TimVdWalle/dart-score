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
            'red': '#DE163B',
            'red-dark': '#DD163B',
            'orange': '#EE9E2B',
            'orange-dark': '#CC8110',
            'green': '#38A21F',
            'green-dark': '#286E17',
            'blue': '#21A2B1',
            'blue-dark': '#0175D8',

            'grey_darker': '#0A0B0E',
            'grey_dark': '#181C23',
            'grey_medium': '#292E38',
            'grey_light': '#2F3541',
            'grey_lighter': '#3F434C',
            'grey_lighterer': '#363D4A',
            'grey_lightest': '#A0A7AB',
            'white': '#FFFFFF',
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
