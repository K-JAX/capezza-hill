module.exports = ({ file, options, env }) => {
    return {
      plugins: {
        'postcss-import': {},
        'autoprefixer': env === 'production' ? options.autoprefixer : false,
        'cssnano': env === 'production' ? options.cssnano : false,
        'postcss-assets': {
          options:{
            // basePath: '../../wp-content/themes/',
            // baseUrl: '//wp-content/themes/',
            loadPaths: ['capezza-hill/assets/images/'],
            relative: true,
          }
        },
      },
    }
  }