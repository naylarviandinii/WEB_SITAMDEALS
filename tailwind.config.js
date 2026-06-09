import defaultTheme from "tailwindcss/defaultTheme";

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
                // Palet warna utama SiTamDeals
                forest: '#12261C',
                gold:   '#D4AF37',
                cream:  '#FFF8DC',
                sage:   '#4A7C59',
                leaf:   '#72B88A',
                black:  '#000000',
            },
            fontFamily: {
                // Mendaftarkan font Urbanist
                urbanist: ["Urbanist", ...defaultTheme.fontFamily.sans],
                // Jika ingin menggunakan font Playfair yang Anda panggil di view:
                playfair: ["Playfair Display", ...defaultTheme.fontFamily.serif],
            },
        },
    },
    plugins: [],
};