module.exports = {
  theme: {
    extend: {
        margin: {
            '05': '0.125rem'
        }
    },
  },
  variants: {
      backgroundColor: ['responsive', 'hover', 'focus', 'group-hover', 'active', 'even', 'odd'],
      textColor: ['responsive', 'hover', 'focus', 'group-hover', 'active'],
      borderWidth: ['responsive', 'even', 'hover', 'focus', 'group-hover', 'active', 'odd', 'first'],
  },
  plugins: [],
}
