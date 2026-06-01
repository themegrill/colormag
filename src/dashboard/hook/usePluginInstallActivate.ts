import apiFetch from '@wordpress/api-fetch';
import { useDispatch } from '@wordpress/data';
import { useMutation } from 'react-query';
import { COLORMAG_DASHBOARD_STORE } from '../store';
import { colormagLocalized } from '../types';

const usePluginInstallActivate = ({
	pluginsStatus,
}: {
	pluginsStatus: colormagLocalized['plugins'];
}) => {
	// const toast = useToast();
	const { setPluginsStatus } = useDispatch(COLORMAG_DASHBOARD_STORE);
	const activatePlugin = useMutation(
		({ slug, file }: { slug: string; file: string }) =>
			apiFetch({
				path: `wp/v2/plugins/${slug}`,
				method: 'POST',
				data: {
					plugin: file.replace('.php', ''),
					status: 'active',
				},
			}),
		{
			onSuccess(data: any) {
				setPluginsStatus({
					[`${data.plugin}.php`]: data.status,
				});
				// toast({
				// 	status: 'success',
				// 	description: sprintf(
				// 		__('%s plugin activated successfully', 'blockart'),
				// 		data.name,
				// 	),
				// 	isClosable: true,
				// });

				// window.location.reload();
			},
			onError(e: Error) {
				// toast({
				// 	status: 'error',
				// 	description: e.message,
				// 	isClosable: true,
				// });
			},
		},
	);

	const installPlugin = useMutation(
		(plugin: string) =>
			apiFetch({
				path: 'wp/v2/plugins',
				method: 'POST',
				data: {
					slug: plugin,
					status: 'active',
				},
			}),
		{
			onSuccess(data: any) {
				setPluginsStatus({
					[`${data.plugin}.php`]: data.status,
				});
				// toast({
				// 	status: 'success',
				// 	description: sprintf(
				// 		__('%s plugin installed and activated successfully', 'blockart'),
				// 		data.name,
				// 	),
				// 	isClosable: true,
				// });
				// window.location.reload();
			},
			onError(e: Error) {
				// toast({
				// 	status: 'error',
				// 	description: e.message,
				// 	isClosable: true,
				// });
			},
		},
	);

	const performPluginAction = async (
		pluginFile: keyof colormagLocalized['plugins'],
	) => {
		const slug = pluginFile.split('/')[0];

		if (pluginsStatus[pluginFile] === 'not-installed') {
			await installPlugin.mutateAsync(slug);
		} else if (pluginsStatus[pluginFile] === 'inactive') {
			await activatePlugin.mutateAsync({
				slug: slug,
				file: pluginFile,
			});
		}
	};

	return {
		installPlugin,
		activatePlugin,
		performPluginAction,
	};
};

export default usePluginInstallActivate;
