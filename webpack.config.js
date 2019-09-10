
const path = require('path');
const webpack = require('webpack');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

const env = process.env.NODE_ENV || 'development'
const mode = env === 'production' ? 'production' : 'development'

module.exports = {
    mode: env,
    entry: {
        script: './src/js/script.js',
    },
    output: {
        filename: '[name].min.js',
        path: path.resolve(__dirname, 'assets/js')
    },
    module: {
        rules: [
            {
                test: /\.m?js$/,
                exclude: /(node_modules)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            },
            {
                test: /\.(sa|sc|c)ss$/i,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    {
                        loader: 'postcss-loader',
                    },
                    'sass-loader',
                    'import-glob-loader',

                ]
            }
        ],
    },
    devtool: 'source-map',
    plugins: [
        new CleanWebpackPlugin(),
        new MiniCssExtractPlugin({
            filename: '../../style.css'
          }),
    ]
}