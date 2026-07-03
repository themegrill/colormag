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

	/**
	 * Activate an already-installed plugin via our own REST endpoint.
	 *
	 * Uses colormag/v1/activate-plugin instead of wp/v2/plugins to avoid a
	 * PHP 8.x TypeError: WordPress initialises active_plugins as '' on fresh
	 * installs, causing in_array() inside activate_plugin() to throw when it
	 * receives a string instead of an array. Our endpoint guards against this.
	 */
	const activatePlugin = useMutation(
		({ file }: { slug: string; file: string }) =>
			apiFetch({
				path: 'colormag/v1/activate-plugin',
				method: 'POST',
				data: {
					plugin: file,
				},
			}),
		{
			onSuccess(data: any) {
				setPluginsStatus({
					[data.plugin]: data.status,
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

	/**
	 * Install a plugin (without activating), then activate via our endpoint.
	 *
	 * Sending status:'active' to wp/v2/plugins would install and activate in
	 * one request, but activation still goes through activate_plugin() which
	 * hits the same PHP 8.x bug. Install first (no status), then activate
	 * separately through our guarded endpoint.
	 */
	const installPlugin = useMutation(
		(plugin: string) =>
			apiFetch({
				path: 'wp/v2/plugins',
				method: 'POST',
				data: {
					slug: plugin,
				},
			}),
		{
			async onSuccess(data: any) {
				// data.plugin is the basename without .php, e.g.
				// "themegrill-demo-importer/themegrill-demo-importer"
				const file = `${ data.plugin }.php`;
				const slug = data.plugin.split( '/' )[ 0 ];

				await activatePlugin.mutateAsync( { slug, file } );
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
