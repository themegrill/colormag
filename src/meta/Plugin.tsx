import { Panel, PanelBody } from '@wordpress/components';
import { PluginSidebar } from '@wordpress/edit-post';
import React, { useState } from 'react';
import GeneralPanel from './components/GeneralPanel';
import { PanelTypes } from './components/meta.schema';

export const Plugin = () => {
	const [activePanel, setActivePanel] = useState<any>(PanelTypes.GENERAL);

	const togglePanel = (panel: string | null) => {
		setActivePanel((prevActivePanel: any) =>
			prevActivePanel === panel ? null : panel,
		);
	};

	return (
		<PluginSidebar
			name="colormag-meta-setting-sidebar"
			title="ColorMag Page Settings"
			icon={
				<>
					<svg
						xmlns="http://www.w3.org/2000/svg"
						xmlSpace="preserve"
						viewBox="0 0 50.1 49"
					>
						<path
							fill="#024947"
							d="M44.9 24.5c0-11-8.9-19.9-19.9-19.9-11 0-19.9 8.9-19.9 19.9 0 11 8.9 19.9 19.9 19.9 11 0 19.9-8.9 19.9-19.9z"
						/>
						<path
							fill="#ffffff"
							d="M31 16.2c-.3 0-.6.1-.9.2-.3.1-.5.3-.8.5L17.5 28.7c-.4.4-.7 1-.7 1.7 0 .6.2 1.2.7 1.7.4.4 1 .7 1.7.7.6 0 1.2-.2 1.7-.7l11.8-11.8c.3-.3.6-.8.6-1.2.1-.5 0-.9-.1-1.4-.2-.4-.5-.8-.9-1.1-.4-.2-.9-.4-1.3-.4zm-13.4 4.2c.2.2.5.3.8.3.3 0 .6-.1.8-.4l4.1-4.1h-4c-.6 0-1.2.2-1.7.7-.5.4-.7 1-.8 1.7 0 .4.1.7.2 1s.3.6.6.8zM31 28.6l-4.1 4.1H31c.6 0 1.2-.2 1.7-.7.5-.4.7-1 .8-1.7 0-.4-.1-.8-.2-1.1-.2-.3-.4-.6-.7-.9-.2-.1-.5-.2-.7-.2-.5.2-.8.4-.9.5z"
							className="st1"
						/>
					</svg>
				</>
			}
		>
			<Panel>
				<PanelBody
					title="General"
					opened={activePanel === PanelTypes.GENERAL}
					onToggle={() => togglePanel(PanelTypes.GENERAL)}
				>
					{activePanel === PanelTypes.GENERAL && <GeneralPanel />}
				</PanelBody>
				{/*<PluginPanelEnd />*/}
			</Panel>
		</PluginSidebar>
	);
};
