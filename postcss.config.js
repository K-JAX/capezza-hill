module.exports = ({ file, options, env }) => {
    return {
      plugins: {
        'postcss-import': {},
        'autoprefixer': env === 'production' ? options.autoprefixer : false,
        'cssnano': env === 'production' ? options.cssnano : false,
        'postcss-assets': {
            baseUrl: '//wp-content/themes/capezza-hill/assets/',
            loadPaths: ['images/'],
        },
      },
    }
  }