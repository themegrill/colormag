import { Panel, PanelBody } from '@wordpress/components';
import { PluginSidebar } from '@wordpress/edit-post';
import { __ } from '@wordpress/i18n';
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
			title={__('ColorMag Meta Settings', 'colormag')}
			icon={
				<>
					<svg
						xmlns="http://www.w3.org/2000/svg"
						fill="none"
						viewBox="0 0 54 54"
					>
						<path
							fill="url(#a)"
							d="M27 54c14.912 0 27-12.088 27-27S41.912 0 27 0 0 12.088 0 27s12.088 27 27 27Z"
						/>
						<path
							fill="url(#b)"
							d="M28.645 31.263a1.32 1.32 0 0 0-1.055-.549c-.211 0-.422.042-.59.084-.17.085-.423.17-.76.38-.717.338-1.308.59-1.772.717a7.737 7.737 0 0 1-1.983.253c-1.476 0-2.573-.464-3.29-1.35-.718-.886-1.097-2.193-1.097-4.007v-.338h-4.6v.338a9.894 9.894 0 0 0 1.098 4.767 7.47 7.47 0 0 0 3.038 3.122 9.25 9.25 0 0 0 4.598 1.097c2.11 0 4.514-.549 6.075-1.646.253-.169.464-.38.59-.675.127-.295.212-.59.17-.886.042-.464-.127-.928-.422-1.307Z"
						/>
						<path
							fill="url(#c)"
							d="M41.006 19.24c.38.42.59.927.549 1.476V33.16a1.746 1.746 0 0 1-.506 1.35c-.76.675-1.9.675-2.616 0-.338-.38-.548-.844-.506-1.35v-6.708l-2.616 4.81c-.21.421-.464.76-.844 1.054-.295.211-.675.338-1.012.295-.38 0-.717-.084-1.013-.295a3.45 3.45 0 0 1-.843-1.054l-2.574-4.64v6.538a1.747 1.747 0 0 1-1.127 1.75 1.747 1.747 0 0 1-.73.106c-.505 0-.97-.169-1.307-.506a1.869 1.869 0 0 1-.464-1.392V20.716a1.906 1.906 0 0 1 .548-1.477c.675-.675 1.73-.76 2.532-.21.337.252.632.632.843 1.012l4.22 7.89 4.134-7.933c.464-.928 1.096-1.35 1.94-1.35.506 0 1.013.212 1.392.592Z"
							opacity=".8"
						/>
						<path
							fill="#F09819"
							d="M19.153 22.733c.717-.886 1.814-1.35 3.29-1.35.549 0 1.055.084 1.604.21.584.167 1.14.423 1.645.76.21.127.464.253.675.38.21.084.422.126.675.126.422 0 .802-.21 1.055-.548.295-.38.422-.844.422-1.308 0-.295-.043-.633-.17-.886a2.844 2.844 0 0 0-.59-.633c-1.645-1.097-3.544-1.687-5.526-1.645a9.145 9.145 0 0 0-4.599 1.097 7.469 7.469 0 0 0-3.037 3.122 9.886 9.886 0 0 0-1.055 4.387h4.556c.042-1.645.422-2.868 1.055-3.712Z"
						/>
						<defs>
							<linearGradient
								id="a"
								x1="-.017"
								x2="53.983"
								y1="26.98"
								y2="26.98"
								gradientUnits="userSpaceOnUse"
							>
								<stop stop-color="#E6E6E6" />
								<stop offset="1" stop-color="#F2F2F2" />
							</linearGradient>
							<linearGradient
								id="b"
								x1="19.94"
								x2="22.733"
								y1="24.837"
								y2="36.032"
								gradientUnits="userSpaceOnUse"
							>
								<stop offset=".23" stop-color="#F0951B" />
								<stop offset=".85" stop-color="#F84B3F" />
							</linearGradient>
							<linearGradient
								id="c"
								x1="28.225"
								x2="38.692"
								y1="35.963"
								y2="17.835"
								gradientUnits="userSpaceOnUse"
							>
								<stop stop-color="#CA7DFD" />
								<stop offset="1" stop-color="#6547DB" />
							</linearGradient>
						</defs>
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
