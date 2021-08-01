const path = require('path');

module.exports = {
    devtool: 'inline-source-map',
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
};
