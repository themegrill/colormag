import { Flex, PanelRow, withFilters } from '@wordpress/components';
import { applyFilters } from '@wordpress/hooks';
import { __ } from '@wordpress/i18n';
import React from 'react';
import { withMeta } from '../hoc/withMeta';
import {
	CenteredSidebar,
	ContainedSidebar,
	Customizer,
	LeftSidebar,
	NoSidebar,
	RightSidebar,
} from './Icons';
import { MetaProps } from './types';

const OPTIONS = applyFilters('colormag.meta.general.layout', [
	{
		label: __('Customizer', 'colormag'),
		icon: Customizer,
		value: 'default_layout',
	},
	{
		label: __('Normal', 'colormag'),
		icon: ContainedSidebar,
		value: 'no_sidebar_full_width',
	},
	{
		label: __('Narrow', 'colormag'),
		icon: CenteredSidebar,
		value: 'no_sidebar_content_centered',
	},
]) as Array<{
	label: string;
	icon: React.ElementType;
	value: string;
}>;

const SIDEBAR_OPTIONS = applyFilters('colormag.meta.general.sidebar', [
	{
		label: __('Customizer', 'colormag'),
		icon: Customizer,
		value: 'default_layout',
	},
	{
		label: __('No Sidebar', 'colormag'),
		icon: NoSidebar,
		value: 'no_sidebar',
	},
	{
		label: __('Right Sidebar', 'colormag'),
		icon: RightSidebar,
		value: 'right_sidebar',
	},
	{
		label: __('Left Sidebar', 'colormag'),
		icon: LeftSidebar,
		value: 'left_sidebar',
	},
]) as Array<{
	label: string;
	icon: React.ElementType;
	value: string;
}>;

const GeneralPanel = ({ meta, updateMeta }: MetaProps) => {
	const containerLayout =
		meta?.colormag_page_container_layout ?? 'default_layout';
	const currentLayout = meta?.colormag_page_sidebar_layout ?? 'default_layout';

	return (
		<PanelRow>
			<Flex className="mainFlexbox" direction={'column'}>
				<p>{__('Layout', 'colormag')}</p>
				<Flex style={{ flex: 1, flexWrap: 'wrap', gap: 8 }}>
					{OPTIONS?.map((option) => {
						const Icon = option.icon;
						return (
							<Flex
								key={option.value}
								style={{ width: 'calc(50% - 10px)' }}
								data-state={
									containerLayout === option.value ? 'active' : 'inactive'
								}
								onClick={() => {
									updateMeta?.('colormag_page_container_layout', option.value);
								}}
								role="button"
								tabIndex={0}
								aria-label={option.label}
								onKeyDown={(e) => {
									if (e.key === 'Enter' || e.key === ' ') {
										updateMeta?.(
											'colormag_page_container_layout',
											option.value,
										);
									}
								}}
							>
								<Icon className={`${option.value} hover:cursor-pointer`} />
							</Flex>
						);
					})}
				</Flex>
				<p>{__('Sidebar', 'colormag')}</p>
				<Flex style={{ flex: 1, flexWrap: 'wrap', gap: 8 }}>
					{SIDEBAR_OPTIONS?.map((option) => {
						const Icon = option.icon;
						return (
							<Flex
								key={option.value}
								style={{ width: 'calc(50% - 10px)' }}
								data-state={
									currentLayout === option.value ? 'active' : 'inactive'
								}
								onClick={() => {
									updateMeta?.('colormag_page_sidebar_layout', option.value);
								}}
								role="button"
								tabIndex={0}
								aria-label={option.label}
								onKeyDown={(e) => {
									if (e.key === 'Enter' || e.key === ' ') {
										updateMeta?.('colormag_page_sidebar_layout', option.value);
									}
								}}
							>
								<Icon className={`${option.value} hover:cursor-pointer`} />
							</Flex>
						);
					})}
				</Flex>
			</Flex>
		</PanelRow>
	);
};

export default withMeta(withFilters('ColorMagMetaGeneralPanel')(GeneralPanel));
