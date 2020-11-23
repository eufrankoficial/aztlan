const path = require('path');
const VueLoaderPlugin = require('vue-loader/lib/plugin')

module.exports = {
    entry: path.resolve('resources', 'assets', 'js', 'app.js'),
    output: {
        filename: 'bundle.js',
        path: path.resolve(__dirname, 'public/assets/js'),
    },
    resolve: {
        alias: {
            'vue$': 'vue/dist/vue.esm.js'
        },
        extensions: ['*', '.js', '.vue', '.json']
    },
    module: {
        rules:[
            {
                test: /\.vue$/,
                loader: 'vue-loader',
                exclude: /(node_modules)/
            }
        ]
    },
    plugins: [
        // make sure to include the plugin!
        new VueLoaderPlugin()
    ]
};
