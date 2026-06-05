export type Prettify<T> = {
	[K in keyof T]: T[K];
} & {};

export type colormagLocalized = {
	version: string;
	plugins: {
		'everest-forms/everest-forms.php': 'active' | 'inactive' | 'not-installed';
		'user-registration/user-registration.php':
			| 'active'
			| 'inactive'
			| 'not-installed';
		'learning-management-system/lms.php':
			| 'active'
			| 'inactive'
			| 'not-installed';
		'magazine-blocks/magazine-blocks.php':
			| 'active'
			| 'inactive'
			| 'not-installed';
		'themegrill-demo-importer/themegrill-demo-importer.php':
			| 'active'
			| 'inactive'
			| 'not-installed';
	};
	builder: boolean;
	demoUrl: string;
	demoImporter: 'active' | 'inactive';
	customizerUrl: string;
	dashboardLogo: string;
	enableWhiteLabel: boolean;
	themeName: string;
	adminUrl: string;
	themes: {
		zakra: 'active' | 'inactive' | 'not-installed';
		colormag: 'active' | 'inactive' | 'not-installed';
	};
	nonce: string;
	ajaxUrl: string;
	trackingEnabled?: boolean;
	trackingNonce?: string;
};

export type ChangelogsMap = Array<{
	version: string;
	date: string;
	changes: {
		[key: string]: Array<string>;
	};
}>;
