const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const HtmlWebpackPlugin = require("html-webpack-plugin");
const webpack = require('webpack');
const fs = require('fs')
const PATHS = {
  src: path.join(__dirname, './src'),
  dist: path.join(__dirname, './assets'),
  assets: 'assets/'
}

const PAGES = fs.readdirSync(PATHS.src).filter(fileName => fileName.endsWith('.html'));


module.exports = {
  entry: {
    main: './src/js/index.js',
  },
  output: {
    path: path.resolve(__dirname, 'assets'),
    filename: 'js/[name].js'
  },
  resolve: {
    alias: {
      'node_modules': path.join(__dirname, 'node_modules'),
    },
    extensions: ['.js', '.json']
  },
  devServer: {
    contentBase: './',
    port: 7000,
    hot: true
  },
  module: {
    rules: [
      // JS loaders
      {
        test: /\.js$/,
        exclude: /(node_modules)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
            plugins: ['@babel/plugin-proposal-class-properties', '@babel/transform-runtime'],
          }
        }
      },
      // Scss loaders
      {
        test: /\.(sa|sc|c)ss$/,
        use: [{
          loader: MiniCssExtractPlugin.loader
        },
        {
          loader: "css-loader",
        },
        {
          // См. postcss.config.js
          loader: "postcss-loader"
        },
        {
          // First
          loader: "sass-loader",
          options: {
            implementation: require("sass")
          }
        }
        ]
      },
      // Image loaders
      {
        test: /\.(png|jpe?g|gif|svg)$/,
        use: [{
          loader: "file-loader",
          options: {
            name: '[name].[ext]',
            outputPath: 'images'
          }
        }]
      },
      // Font loaders
      {
        test: /\.(woff|woff2|ttf|otf|eot)$/,
        use: [{
          loader: "file-loader",
          options: {
            name: '[name].[ext]',
            outputPath: 'fonts',
            publicPath: '../fonts',
          }
        }]
      }
    ]
  },
  plugins: [
    ...PAGES.map(page => new HtmlWebpackPlugin ({
      filename: `./${page}`,
      template: path.join(__dirname, `src/${page}`),
      inject: true
    })),
    new MiniCssExtractPlugin({
      filename: "css/[name].css",
      publicPath: "css"
    }),
    new webpack.ProvidePlugin({
      Promise: 'es6-promise-promise',
      $: 'jquery',
      jQuery: 'jquery',
    })
  ],
};
