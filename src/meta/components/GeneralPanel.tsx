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
		label: __('Right Sidebar', 'colormag'),
		icon: RightSidebar,
		value: 'right_sidebar',
	},
	{
		label: __('Left Sidebar', 'colormag'),
		icon: LeftSidebar,
		value: 'left_sidebar',
	},
	{
		label: __('Centered Sidebar', 'colormag'),
		icon: CenteredSidebar,
		value: 'no_sidebar_content_centered',
	},
	{
		label: __('Contained Sidebar', 'colormag'),
		icon: ContainedSidebar,
		value: 'no_sidebar_full_width',
	},
]) as Array<{
	label: string;
	icon: React.ElementType;
	value: string;
}>;

const GeneralPanel = ({ meta, updateMeta }: MetaProps) => {
	const currentLayout = meta?.colormag_page_layout ?? 'default_layout';

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
									currentLayout === option.value ? 'active' : 'inactive'
								}
								onClick={() => {
									updateMeta?.('colormag_page_layout', option.value);
								}}
							>
								<Icon className={option.value} />
							</Flex>
						);
					})}
				</Flex>
			</Flex>
		</PanelRow>
	);
};

// @ts-ignore
export default withMeta(withFilters('ColorMagMetaGeneralPanel')(GeneralPanel));
