module.exports = ({ file, options, env }) => {
    console.log('env:', env, 'process.env.NODE_ENV:', process.env.NODE_ENV )
    return {
      plugins: {
        'autoprefixer': env === 'production' ? options.autoprefixer : false,
        'cssnano': env === 'production' ? options.cssnano : false
      }
    }
  }