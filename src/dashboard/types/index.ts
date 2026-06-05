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
	userRoles?: Record<string, string>;
	popupEditUrl?: string;
	fs?: {
		activated?: boolean;
		is_whitelabeled?: boolean;
		module_id?: string;
		ajax_url?: string;
		activation?: {
			action?: string;
			security?: string;
		};
		account?: {
			set_beta_mode?: { action?: string; security?: string };
			update_email_address?: { action?: string; security?: string };
			update_license?: { action?: string; security?: string };
			deactivate_license?: string;
			sync?: string;
			user_name?: string;
			email?: string;
			data?: {
				beta_program?: boolean;
				user_name?: string;
				email?: string;
				user_id?: string;
				product_id?: string;
				site_id?: string;
				site_public_key?: string;
				site_secret_key?: string;
				version?: string;
				plan?: string;
				bundle_plan?: string;
				license_key?: string;
				update?: {
					update_url?: string;
					update_version?: string;
				};
			};
		};
		billing?: {
			action?: string;
			security?: string;
			details?: Record<string, string>;
		};
	};
};

export type ChangelogsMap = Array<{
	version: string;
	date: string;
	changes: {
		[key: string]: Array<string>;
	};
}>;
