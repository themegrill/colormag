module.exports = {
	root: true,
	globals: {
		wp: true,
	},
	rules: {
		"react-hooks/rules-of-hooks": "error",
		"react-hooks/exhaustive-deps": "warn",
		"react/prop-types": "off",
		"no-unused-vars":
			process.env.NODE_ENV === "production" ? "error" : "off",
	},
	parser: "@typescript-eslint/parser",
	extends: ["plugin:react/recommended"],
	settings: {
		react: {
			version: "detect",
		},
		"import/resolver": {
			typescript: {},
			webpack: {
				config: "webpack.config.js",
			},
		},
	},
	plugins: ["import", "@typescript-eslint", "react-hooks"],
};
