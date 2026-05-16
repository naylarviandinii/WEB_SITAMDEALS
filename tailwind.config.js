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
        // Warna gold profesional kamu
        gold: {
          DEFAULT: '#D4AF37', 
          light: '#FFF8DC',   
          dark: '#C0B283',    
        }
      },
    },
  },
  plugins: [],
}