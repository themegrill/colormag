const defaults = require('@wordpress/scripts/config/webpack.config');
const { resolve } = require('path');
const ForkTsCheckerPlugin = require('fork-ts-checker-webpack-plugin');

module.exports = {
	...defaults,
	output: {
		filename: '[name].js',
		path: resolve(process.cwd(), 'assets/build'),
	},
	entry: {
		meta: resolve(process.cwd(), 'src/meta', 'meta.tsx'),
	},
	plugins: [...defaults.plugins, new ForkTsCheckerPlugin()],
};
