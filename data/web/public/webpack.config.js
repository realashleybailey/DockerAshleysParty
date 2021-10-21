
const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

const isDevelopment = process.env.NODE_ENV === 'development'

var config = {
    watch: true,
    plugins: [
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery'
        })
    ],
    mode: 'development'
};

var main = Object.assign({}, config, {
    name: 'main',
    entry: './DEV/js/index.js',
    output: {
        path: path.resolve(__dirname, 'js/'),
        filename: 'index.js',
        libraryTarget: 'var',
        library: 'AshleysParty',
    }
});

var admin = Object.assign({}, config, {
    name: 'main',
    entry: './DEV/js/admin.js',
    output: {
        path: path.resolve(__dirname, 'js/'),
        filename: 'admin.js',
        libraryTarget: 'var',
        library: 'AshleysParty',
    }
});

var mdbCONFIG = {
    watch: true,
    mode: 'development'
};

var mdbCSS = Object.assign({}, mdbCONFIG, {
    entry: './DEV/css/main.js',
    output: {
        filename: "js/style-min.js",
        path: path.resolve(__dirname)
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: 'css/main.css'
        })
    ],
    module: {
        rules: [
            {
                test: /\.s(a|c)ss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: true
                        }
                    }
                ]
            }
        ]
    }
})

var mdbJS = Object.assign({}, mdbCONFIG, {
    entry: './node_modules/mdb-ui-kit/src/js/mdb.free.js',
    output: {
        path: path.resolve(__dirname, 'js/'),
        filename: 'mdb.free.js',
        library: 'mdb',
    }
});

module.exports = [main, admin, mdbCSS, mdbJS];