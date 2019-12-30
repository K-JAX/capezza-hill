const path = require('path');
const webpack = require('webpack');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const {version} = require('./package.json');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const env = process.env.NODE_ENV || 'development'
const mode = env === 'production' ? 'production' : 'development'

module.exports = {
    mode: env,
    entry: {
        script: './src/js/script.js',
        blocks: './src/js/blocks.js',
        style: './src/sass/style.scss',
        styleeditor: './src/sass/style-editor.scss'
        // vendor: './src/js/vendor.js',
    },
    resolve: {
        alias: {
            jquery: 'jquery/src/jquery',
        }
    },
    output: {
        filename: './assets/js/[name].min.js',
        path: path.resolve(__dirname, './'),
        hotUpdateChunkFilename: 'hot/[hash]-hot-update.js',
        hotUpdateMainFilename: 'hot/[hash]-hot-update.json'
    },
    module: {
        rules: [
            {
                test: /\.m?js$/,
                exclude: /(node_modules)/,
                use: [
                    {
                        loader: 'babel-loader',
                        options: {
                            babelrc: true,
                            extends: path.join(__dirname, '/.babelrc'),
                            cacheDirectory: true,
                        }
                    },
                    {
                        loader: 'webpack-import-glob-loader',
                    }
                    
                ]
            },
            {
                test: /\.(sa|sc|c)ss$/i,
                include: path.resolve(__dirname, './src/sass/'),
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader',
                        options: {
                            sourceMap: true,
                            importLoaders: 2,
                        }

                    },
                    {
                        loader: 'postcss-loader',
                        options: {
                            sourceMap: true,
                            config: {path: './postcss.config.js'}
                        }
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: true
                        }
                    },
                    'import-glob-loader',
                ]
            }
        ],
    },
    devtool: 'source-map',
    plugins: [
        new BrowserSyncPlugin({
            files: ['**/*.css', '**/*.php'],
            host: 'localhost',
            port: 3000,
            open: false,
            proxy: 'http://capezza-hill.local/'
        },
        {
            reload: false
            
        }),
        new webpack.HotModuleReplacementPlugin({

        }),
        new CleanWebpackPlugin({
            vervose: true,
            cleanOnceBeforeBuildPatterns: ['./capezza-hill/assets/js/hot', 'script-min-*', './capezza-hill/style.css'],
        }),
        new MiniCssExtractPlugin({
            // filename: './style.css',
            moduleFilename: ({ name }) => `${name.replace('/js/', '/css/')}.css`,
            chunkFilename: './[id].css',
          }),
        new webpack.DefinePlugin({
            APP_BASE: JSON.stringify(path.resolve(__dirname, './package.json')),
            VERSION: version,
        }),
    ]
}