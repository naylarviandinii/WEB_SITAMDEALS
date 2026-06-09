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
                forest: "#0e2118",
                emerald: "#1a3d2b",
                gold: "#d4af37",
                "gold-light": "#f1d592",
                cream: "#f5f0e8",
            },
            fontFamily: {
                // Mendaftarkan font Urbanist
                urbanist: ["Urbanist", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};
