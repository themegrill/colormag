const { colors: defaultColors } = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
	darkMode: ['class'],
	content: ['./src/**/*.{ts,tsx}'],
	theme: {
		fontSize: {
			xs: '12px',
			sm: '14px',
			base: '16px',
			lg: '18px',
			xl: '20px',
			'2xl': '24px',
			'3xl': '30px',
			'4xl': '36px',
			'5xl': '48px',
			'6xl': '60px',
			'7xl': '72px',
		},
		spacing: {
			px: '1px',
			0: '0',
			0.5: '2px',
			1: '4px',
			1.5: '6px',
			2: '8px',
			2.5: '10px',
			3: '12px',
			3.5: '14px',
			4: '16px',
			5: '20px',
			6: '24px',
			7: '28px',
			8: '32px',
			9: '36px',
			10: '40px',
			11: '44px',
			12: '48px',
			14: '56px',
			16: '64px',
			20: '80px',
			24: '96px',
			28: '112px',
			32: '128px',
			36: '144px',
			40: '160px',
			44: '176px',
			48: '192px',
			52: '208px',
			56: '224px',
			60: '240px',
			64: '256px',
			72: '288px',
			80: '320px',
			96: '384px',
		},
		extend: {
			lineHeight: {
				3: '12px',
				4: '16px',
				5: '20px',
				6: '24px',
				7: '28px',
				8: '32px',
				9: '36px',
				10: '40px',
			},
			colors: {
				primary: {
					50: '#eaf3fb',
					100: '#bfdbf3',
					200: '#94c4ea',
					300: '#69ace2',
					400: '#3e94da',
					500: '#257bc1',
					600: '#1d6096',
					700: '#15446b',
					800: '#0c2940',
					900: '#040e15',
				},
			},
			container: {
				center: true,
				padding: '1rem',
				screens: {
					sm: '100%',
					md: '100%',
					lg: '100%',
					xl: '1120px',
				},
			},
		},
	},
	plugins: [],
	corePlugins: {
		preflight: false,
	},
};
