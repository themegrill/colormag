import { useDispatch, useSelect } from '@wordpress/data';
import React from 'react';

export const withMeta = <Props extends Object>(
	Component: React.ComponentType<Props>,
) => {
	const Comp = (props: Props) => {
		const meta = useSelect((select) => {
			return (
				(select('core/editor') as any)?.getEditedPostAttribute('meta') ?? {}
			);
		}, []);

		const { editPost } = useDispatch('core/editor');
		const updateMeta = (key: string, value: any) => {
			editPost({ meta: { ...meta, [key]: value } });
		};

		return <Component updateMeta={updateMeta} meta={meta} {...props} />;
	};
	Comp.displayName = `withMeta(${Component.displayName || Component.name || 'Component'})`;
	return Comp;
};
