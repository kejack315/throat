import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            "colors": {
                "red": {
                    50: "#FDECEC",
                    100: "#FCD9D9",
                    200: "#F9B4B4",
                    300: "#F58E8E",
                    400: "#F26969",
                    500: "#EF4444",
                    600: "#E11313",
                    700: "#A90F0F",
                    800: "#710A0A",
                    900: "#380505",
                    950: "#1C0202"
                }
            },

            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
