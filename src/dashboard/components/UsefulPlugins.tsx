import { useSelect } from '@wordpress/data';
import { __ } from '@wordpress/i18n';
import React from 'react';
import { useLocation } from 'react-router-dom';
import { PLUGINS } from '../constants';
import usePluginInstallActivate from '../hook/usePluginInstallActivate';
import { COLORMAG_DASHBOARD_STORE } from '../store';
import { colormagLocalized } from '../types';

type PluginStatus = 'active' | 'inactive' | 'not-installed';
type PluginSlug = keyof colormagLocalized['plugins'];

export const Plugin: React.FC<{
	plugin: {
		slug: PluginSlug; // This ensures slug matches the keys in pluginsStatus
		label: string;
		description: string;
		image: string;
		learn_more: string;
		live_demo: string;
		logo: React.ReactNode;
		shortDescription: string;
	};
	index: number;
	pluginsStatus: colormagLocalized['plugins'];
}> = ({ plugin, index, pluginsStatus }) => {
	const { installPlugin, activatePlugin, performPluginAction } =
		usePluginInstallActivate({
			pluginsStatus,
		});

	const routelocation = useLocation();

	return (
		<>
			{routelocation.pathname === '/products' ? (
				<div className="rounded border border-solid border-[#F4F4F4] bg-[#FFFFFF]">
					<img className="w-full" src={plugin.image} alt={plugin.label} />
					<div className="my-5 mx-4">
						<h3 className="mb-2">{plugin.label}</h3>
						<p className="text-[#6B6B6B] text-sm mb-2 leading-7">
							{plugin.description}
						</p>
					</div>
					<div className="py-5 px-4 border-t border-x-0 border-b-0 border-solid border-[#F4F4F4] flex items-center justify-between">
						<div className="cta-text flex gap-3">
							<a
								className="text-[#7A7A7A] text-xs cm-learn-more focus:outline-0 focus:shadow-none"
								href={plugin.learn_more}
								target="_blank"
							>
								{__('Learn more', 'colormag')}
							</a>
							<a
								className="text-[#7A7A7A] text-xs focus:outline-0 focus:shadow-none"
								href={plugin.live_demo}
								target="_blank"
							>
								{__('View Demo', 'colormag')}
							</a>
						</div>
						<button
							className="bg-[#2563EB] border-none text-[#FFFFFF] disabled:bg-[#ACACAC] disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer py-2 px-4 rounded"
							onClick={() => performPluginAction(plugin.slug)}
							disabled={
								pluginsStatus[plugin.slug] === 'active' ||
								installPlugin.isLoading ||
								activatePlugin.isLoading
							}
						>
							{installPlugin.isLoading || activatePlugin.isLoading
								? __('Loading...', 'colormag')
								: pluginsStatus[plugin.slug] === 'active'
									? __('Activated', 'colormag')
									: pluginsStatus[plugin.slug] === 'inactive'
										? __('Activate', 'colormag')
										: __('Install', 'colormag')}
						</button>
					</div>
				</div>
			) : (
				<div className="py-4 flex items-center justify-between">
					<div className="flex items-center gap-3">
						{plugin.logo}
						<div>
							<h4 className="text-[#6B6B6B] m-0">{plugin.label}</h4>
							<p className="text-[#6B6B6B] m-0">{plugin.shortDescription}</p>
						</div>
					</div>
					<button
						className="border-none text-[#2563EB] bg-[#FFFFFF] disabled:text-[#3c434a] disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer"
						onClick={() => performPluginAction(plugin.slug)}
						disabled={
							pluginsStatus[plugin.slug] === 'active' ||
							installPlugin.isLoading ||
							activatePlugin.isLoading
						}
					>
						{installPlugin.isLoading || activatePlugin.isLoading
							? __('Loading...', 'colormag')
							: pluginsStatus[plugin.slug] === 'active'
								? __('Activated', 'colormag')
								: pluginsStatus[plugin.slug] === 'inactive'
									? __('Activate', 'colormag')
									: __('Install', 'colormag')}
					</button>
				</div>
			)}
		</>
	);
};

interface Plugin {
	slug: keyof colormagLocalized['plugins'];
	label: string;
	description: string;
	type: string;
	image: string;
	learn_more: string;
	live_demo: string;
	website: string;
	shortDescription: string;
	logo: React.JSX.Element;
}
export const UsefulPlugins = () => {
	const pluginsStatus = useSelect((select) => {
		return (
			select(COLORMAG_DASHBOARD_STORE) as any
		).getPluginsStatus() as colormagLocalized['plugins'];
	}, []);
	return (
		<>
			{(PLUGINS as Plugin[]).map((plugin, i) => (
				<Plugin
					key={plugin.slug}
					pluginsStatus={pluginsStatus}
					plugin={plugin}
					index={i}
				/>
			))}
		</>
	);
};

export default UsefulPlugins;
