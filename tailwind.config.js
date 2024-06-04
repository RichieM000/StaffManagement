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
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                // Add this section
                duration: 500, // default animation duration
              },
              scale: {
                // Add this section
                0: '0',
                25: '0.25',
                50: '0.5',
                75: '0.75',
                90: '0.9',
                100: '1',
                105: '1.05', // added for the example
                110: '1.1', // added for the example
              },
        },
    },

    plugins: [forms],
};
