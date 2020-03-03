module.exports = {
  theme: {
    minHeight: {
        '96': '24rem'
    },
    extend: {
        margin: {
            '05': '0.125rem'
        },
        spacing: {
            '72': '18rem',
            '84': '21rem',
            '96': '24rem'
        },
    },
  },
  variants: {
      backgroundColor: ['responsive', 'hover', 'focus', 'group-hover', 'active', 'even', 'odd'],
      textColor: ['responsive', 'hover', 'focus', 'group-hover', 'active'],
      borderWidth: ['responsive', 'even', 'hover', 'focus', 'group-hover', 'active', 'odd', 'first'],
      visibility: ['responsive', 'hover', 'focus', 'group-hover'],
      display: ['responsive', 'hover', 'focus', 'group-hover']
  },
  plugins: [],
}
