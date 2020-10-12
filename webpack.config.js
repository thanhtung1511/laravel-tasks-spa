const path = require('path');

module.exports = {
  resolve: {
    extensions: ['.js', '.json', '.vue'],
    alias: {
      '@': path.resolve(__dirname, 'resources/js/src'),
      '@assets': path.resolve(__dirname, 'resources/assets'),
      '@sass': path.resolve(__dirname, 'resources/sass'),
    },
  },
};




