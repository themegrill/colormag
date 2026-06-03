import { ClassValue, clsx } from 'clsx';

export function cn(...inputs: ClassValue[]) {
	return clsx(inputs);
}

// All properties optional — PHP localizes {} for free theme.
// Dashboard.tsx checks !colormagLocalized.hide_* — undefined is falsy, so all sections show.
const localized: {
	enable_white_label?: boolean;
	hide_white_label?: boolean;
	hide_starter_templates?: boolean;
	hide_products_tab?: boolean;
	hide_helps_tab?: boolean;
	hide_license_tab?: boolean;
	hide_documentation?: boolean;
	hide_review_section?: boolean;
	hide_feature_section?: boolean;
	hide_support_section?: boolean;
	hide_user_ful_section?: boolean;
	hide_community_section?: boolean;
	hide_starter_template_section?: boolean;
	agency_name?: string;
	agency_url?: string;
	theme_description?: string;
	theme_name?: string;
	theme_screenshot?: string;
	theme_icon?: string;
	dashboard_icon?: string;
} = (window as any).__COLORMAG_SETTINGS__ ?? {};

export { localized };
