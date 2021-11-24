const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')
module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Noto Sans JP", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: colors.cyan,
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            shadow: ['disabled'],
            border: ['disabled'],
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/aspect-ratio'),
    ],
};
