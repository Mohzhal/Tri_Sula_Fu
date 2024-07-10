/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode : 'class',
  content: ["index.html"],
  theme: {
   

    extend: {
      fontFamily: {
        'rubik': ['Rubik Scribble', 'system-ui', 'sans-serif'],
        'bebas': ['Bebas Neue', 'sans-serif'],
      },

      colors :{
        'siang' : '#D3DCE3',
        'abu': '#FFC374',
        'malam' : '#020201',
        'oren' : '#F9B22A',
        dark: {
          DEFAULT: '#030409', // Contoh warna background mode gelap
          // Tambahkan warna lain sesuai kebutuhan
        },
      }
      
    }
  },
  plugins: []
}

