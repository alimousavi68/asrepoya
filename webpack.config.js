const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');

module.exports = {
    mode: 'development',
    entry: {
        main: './assets/css/main.css',
        admin: './assets/js/admin.js' // اگر فایل JS داشته باشید
    },
    output: {
        path: path.resolve(__dirname, 'dist'),
        filename: 'js/[name].min.js',
        clean: true
    },
    module: {
        rules: [
            {
                test: /\.css$/i,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    {
                        loader: 'postcss-loader',
                        options: {
                            postcssOptions: {
                                plugins: [
                                    ['autoprefixer'],
                                    ['cssnano', {
                                        preset: 'default'
                                    }]
                                ]
                            }
                        }
                    }
                ]
            },
            {
                test: /\.scss$/i,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'postcss-loader',
                    'sass-loader'
                ]
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/i,
                type: 'asset/resource',
                generator: {
                    filename: 'fonts/[name][ext]'
                }
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: 'css/[name].min.css'
        })
    ],
    optimization: {
        minimizer: [
            new CssMinimizerPlugin({
                minimizerOptions: {
                    preset: [
                        'default',
                        {
                            discardComments: { removeAll: true },
                            normalizeWhitespace: true,
                            colormin: true,
                            convertValues: true,
                            discardDuplicates: true,
                            discardEmpty: true,
                            mergeRules: true,
                            minifyFontValues: true,
                            minifySelectors: true
                        }
                    ]
                }
            }),
            new TerserPlugin()
        ]
    },
    devtool: 'source-map',
    watch: true,
    watchOptions: {
        ignored: /node_modules/,
        poll: 1000
    }
};