const path                  = require('path');
const webpack               = require('webpack');
const MiniCssExtractPlugin  = require('mini-css-extract-plugin');
const CssMinimizerPlugin    = require('css-minimizer-webpack-plugin');
const TerserPlugin          = require("terser-webpack-plugin");

module.exports = {
    entry: "./src/index.js",
    output: {
        filename: "public.js",
        path: path.resolve(__dirname, "../public"),
        publicPath: '',
    },
    resolve: {
        extensions: [".js"]
    },
    module: {
        rules: [
            {
                test: /\.js?$/,
                include: [
                    path.resolve(__dirname, "src")
                ],
                exclude: [
                    path.resolve(__dirname, "node_modules")
                ],
                loader: "babel-loader",
            },
            {
                test: /\.scss?$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'sass-loader'
                ],
            },
            {
                test: /\.(png|jpg)$/,
                use: [
                    {
                        loader: 'url-loader',

                    },
                ],
            },
            {
                test: /\.(woff|woff2|ttf|eot|svg)?$/,
                type: 'asset/resource'
            },
        ],
    },
    devtool: "source-map",
    target: "web",
    plugins: [
        new MiniCssExtractPlugin({
            filename: 'public.css',
        })
    ],
    optimization: {
        chunkIds: "size",
        moduleIds: "size",
        mangleExports: "size",
        minimizer: [
            new TerserPlugin(),
            new CssMinimizerPlugin({
                minimizerOptions: {
                    preset: [
                        "default",
                        {
                            discardComments: { removeAll: true },
                        },
                    ],
                }
            })
        ],
    }
}