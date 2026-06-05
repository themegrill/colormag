import { __ } from '@wordpress/i18n';
import React, { useState } from 'react';
import { PREMIUM, QUICK_SETTINGS } from '../../constants';
import { documentIcon } from '../../icons/icons';

import { useSelect } from '@wordpress/data';
import UsefulPlugins from '../../components/UsefulPlugins';
import usePluginInstallActivate from '../../hook/usePluginInstallActivate';
import template from '../../images/cm-starter-templates.png';
import { COLORMAG_DASHBOARD_STORE } from '../../store';
import { localized } from '../../utils/global';
import { localized as colormagLocalized } from '../../utils/utils';

const ContributingSection: React.FC = () => {
	const [enabled, setEnabled] = useState<boolean>(localized.trackingEnabled ?? false);
	const [saving, setSaving] = useState(false);

	const handleChange = async (checked: boolean) => {
		if (saving) return;
		setSaving(true);
		setEnabled(checked);
		const fd = new FormData();
		fd.append('action', 'colormag_save_tracking');
		fd.append('nonce', localized.trackingNonce ?? '');
		fd.append('enabled', checked ? '1' : '0');
		await fetch(localized.ajaxUrl, { method: 'POST', body: fd });
		setSaving(false);
	};

	return (
		<div className="p-4 bg-white rounded-lg shadow-sm border border-solid border-[#F4F4F4] mb-5">
			<h3 className="text-base font-semibold text-[#383838] m-0 mb-3">
				{__('Contributing', 'colormag')}
			</h3>
			<p className="text-[#6B6B6B] text-sm mb-2">
				{__(
					'Become a contributor by opting in to our anonymous data tracking. We guarantee no sensitive data is collected.',
					'colormag',
				)}
			</p>
			<a
				href="https://themegrill.com/privacy-policy/"
				target="_blank"
				className="text-[#2563EB] hover:text-[#2563EB] text-[13px] no-underline mb-3 inline-block"
			>
				{__('What do we track?', 'colormag')} ↗
			</a>
			<div className="flex items-center gap-2 mt-2">
				<button
					role="switch"
					aria-checked={enabled}
					disabled={saving}
					onClick={() => handleChange(!enabled)}
					className={`relative inline-flex items-center w-[30px] h-[17px] rounded-full border-none cursor-pointer transition-colors duration-200 p-0 ${enabled ? 'bg-[#2563EB]' : 'bg-[#ccc]'}`}
					style={{ flexShrink: 0 }}
				>
					<span
						className="absolute bg-white rounded-full transition-transform duration-200"
						style={{
							width: 11,
							height: 11,
							left: 3,
							transform: enabled ? 'translateX(13px)' : 'translateX(0)',
						}}
					/>
				</button>
				<span className="text-[13px] font-medium text-[#383838]">
					{__('Allow Anonymous Tracking', 'colormag')}
				</span>
			</div>
		</div>
	);
};

const Dashboard: React.FC = () => {
	const pluginsStatus = useSelect((select) => {
		return (
			select(COLORMAG_DASHBOARD_STORE) as any
		).getPluginsStatus() as typeof localized.plugins;
	}, []);
	const { performPluginAction } = usePluginInstallActivate({
		pluginsStatus: localized.plugins,
	});

	const [isProcessing, setIsProcessing] = useState(false);
	return (
		<>
			<div className="lg:flex md:flex-row gap-5 flex-col">
				<div className="lg:basis-9/12 basis-full">
					<div className="px-6 pt-6 pb-8 bg-white rounded-lg shadow-sm mb-5">
						<h2 className="text-2xl font-semibold text-[#383838] relative w-fit">
							{__('Welcome to ' + localized.themeName + '', 'colormag')}
							<span className="absolute right-[-30px] top-[-10px] text-[10px] px-[6px] py-[4px] rounded-bl-sm bg-[#27AE6014] text-[#27AE60] leading-3">
								{__('Free', 'colormag')}
							</span>
						</h2>
						<p className="text-[#383838] text-sm font-normal mb-5">
							{__(
								'Create websites of different niches with very little effort with ' +
									localized.themeName +
									'. Loaded with powerful features and demos for every kind of website, you can get started immediately!',
								'colormag',
							)}
						</p>
						{'active' !==
							pluginsStatus[
								'themegrill-demo-importer/themegrill-demo-importer.php'
							] && (
							<button
								onClick={async () => {
									setIsProcessing(true);
									await performPluginAction(
										'themegrill-demo-importer/themegrill-demo-importer.php',
									);
									setIsProcessing(false);
								}}
								className="border-none text-[#2563EB] bg-[#FFFFFF] cursor-pointer"
								data-name="themegrill-demo-importer"
								data-slug="themegrill-demo-importer"
								aria-label="Install ThemeGrill Demo Importer Plugin"
								disabled={isProcessing}
							>
								{isProcessing
									? __('Processing...', 'colormag')
									: 'inactive' ===
										  pluginsStatus[
												'themegrill-demo-importer/themegrill-demo-importer.php'
										  ]
										? __('Activate ThemeGrill Demo Importer Plugin', 'colormag')
										: 'not-installed' ===
											  pluginsStatus[
													'themegrill-demo-importer/themegrill-demo-importer.php'
											  ]
											? __('Install ThemeGrill Demo Importer Plugin ')
											: ''}
							</button>
						)}
						{'active' ===
							pluginsStatus[
								'themegrill-demo-importer/themegrill-demo-importer.php'
							] && (
							<>
								<a
									className="text-[#2563EB] hover:text-[#2563EB] no-underline"
									href={localized.demoUrl}
								>
									{__('View Starter Template', 'colormag')}
								</a>
							</>
						)}
					</div>
					<div className="px-6 pt-6 pb-4 bg-white rounded-lg shadow-sm mb-4">
						<div className="cm-quick-settings-title ">
							<div className="mb-8 flex items-center justify-between">
								<h2 className="m-0">{__('Quick Settings', 'colormag')}</h2>
								<a
									className="text-[#2563EB] hover:text-[#2563EB] text-sm font-medium"
									href={localized.customizerUrl}
									target="_blank"
								>
									{__('Go to Customizer', 'colormag')}
								</a>
							</div>
							<div className="cm-quick-settings-content grid gap-6 grid-cols-3">
								{QUICK_SETTINGS.map((quick) => (
									<div
										key={quick.id}
										className="cm-quick-settings-item flex gap-7 py-3 px-6 roundness border border-solid border-[#F4F4F4] bg-[#FAFBFF]"
									>
										<div className="cm-quick-settings-item-icon flex items-center">
											{quick.icon}
										</div>
										<div className="cm-quick-settings-item-content">
											<h4 className="mb-2 mt-0 px-0">{quick.title}</h4>
											<a
												href={
													localized.customizerUrl +
													'?autofocus[section]=' +
													quick.id
												}
												className="m-0 flex gap-1 items-center cursor-pointer text-[#7A7A7A] hover:text-[#2563EB] no-underline"
											>
												<svg
													width="13"
													height="13"
													viewBox="0 0 13 13"
													fill="none"
													xmlns="http://www.w3.org/2000/svg"
												>
													<path
														fillRule="evenodd"
														clipRule="evenodd"
														d="M3 4C2.86739 4 2.74021 4.05268 2.64645 4.14645C2.55268 4.24022 2.5 4.3674 2.5 4.5V10C2.5 10.1326 2.55268 10.2598 2.64645 10.3536C2.74022 10.4473 2.86739 10.5 3 10.5H8.5C8.63261 10.5 8.75978 10.4473 8.85355 10.3536C8.94732 10.2598 9 10.1326 9 10V7C9 6.72386 9.22386 6.5 9.5 6.5C9.77614 6.5 10 6.72386 10 7V10C10 10.3978 9.84196 10.7794 9.56066 11.0607C9.27936 11.342 8.89783 11.5 8.5 11.5H3C2.60217 11.5 2.22064 11.342 1.93934 11.0607C1.65804 10.7794 1.5 10.3978 1.5 10V4.5C1.5 4.10218 1.65804 3.72065 1.93934 3.43934C2.22064 3.15804 2.60218 3 3 3H6C6.27614 3 6.5 3.22386 6.5 3.5C6.5 3.77615 6.27614 4 6 4H3Z"
														fill="#7A7A7A"
													/>
													<path
														fillRule="evenodd"
														clipRule="evenodd"
														d="M7.5 2C7.5 1.72386 7.72386 1.5 8 1.5H11C11.2761 1.5 11.5 1.72386 11.5 2V5C11.5 5.27615 11.2761 5.5 11 5.5C10.7239 5.5 10.5 5.27615 10.5 5V2.5H8C7.72386 2.5 7.5 2.27615 7.5 2Z"
														fill="#7A7A7A"
													/>
													<path
														fillRule="evenodd"
														clipRule="evenodd"
														d="M11.3536 1.64645C11.5489 1.84171 11.5489 2.15829 11.3536 2.35355L5.8536 7.85355C5.65834 8.04882 5.34175 8.04882 5.14649 7.85355C4.95123 7.65829 4.95123 7.34171 5.14649 7.14645L10.6465 1.64645C10.8418 1.45118 11.1583 1.45118 11.3536 1.64645Z"
														fill="#7A7A7A"
													/>
												</svg>

												<span className="text-[13px]">{__('Customize')}</span>
											</a>
										</div>
									</div>
								))}
							</div>
						</div>
					</div>
					<div className="px-6 pt-6 pb-4 bg-white rounded-lg shadow-sm mb-4 sticky top-0 w-auto">
						<div className="cm-quick-settings-title ">
							<div className="mb-8 flex items-center justify-between">
								<h2 className="m-0">{__('Features', 'colormag')}</h2>
							</div>
							<div className="cm-quick-settings-content grid gap-6 grid-cols-3">
								{PREMIUM.map((premium_setting) => (
									<div
										key={premium_setting.title}
										className="cm-quick-settings-item flex justify-between py-3 px-6 roundness border border-solid border-[#F4F4F4] bg-[#FAFBFF]"
									>
										<div className="cm-quick-settings-item-content">
											<h4 className="mb-2 mt-0 px-0">
												{premium_setting.title}
											</h4>
											<a
												href={premium_setting.link}
												target="_blank"
												className="cm-feature-icon m-0 flex gap-1 items-center cursor-pointer text-[#7A7A7A] hover:text-[#2563EB] no-underline"
											>
												{documentIcon}
												<span className="text-[13px]">{__('Document')}</span>
											</a>
										</div>
									</div>
								))}
							</div>
						</div>
					</div>
				</div>
				<div className="lg:basis-3/12 basis-full">
					<ContributingSection />
					{!colormagLocalized.hide_starter_template_section && (
						<>
							<div className="p-4 bg-white rounded-lg shadow-sm border border-solid roundenss border-[#2563EB] mb-5 ">
								<div>
									<h3 className="text-base font-semibold text-[#383838] flex gap-1 w-fit m-0 items-center">
										<svg
											width="21"
											height="20"
											viewBox="0 0 21 20"
											fill="none"
											xmlns="http://www.w3.org/2000/svg"
										>
											<g id="download">
												<path
													id="Vector (Stroke)"
													fillRule="evenodd"
													clipRule="evenodd"
													d="M10.5 2.5C10.9602 2.5 11.3333 2.8731 11.3333 3.33333V11.3215L14.0774 8.57741C14.4028 8.25197 14.9305 8.25197 15.2559 8.57741C15.5814 8.90285 15.5814 9.43049 15.2559 9.75592L11.0893 13.9226C10.7638 14.248 10.2362 14.248 9.91074 13.9226L5.74408 9.75592C5.41864 9.43049 5.41864 8.90285 5.74408 8.57741C6.06951 8.25197 6.59715 8.25197 6.92259 8.57741L9.66667 11.3215V3.33333C9.66667 2.8731 10.0398 2.5 10.5 2.5ZM3.83333 13.3333C4.29357 13.3333 4.66667 13.7064 4.66667 14.1667V15.8333C4.66667 16.0543 4.75446 16.2663 4.91074 16.4226C5.06702 16.5789 5.27899 16.6667 5.5 16.6667H15.5C15.721 16.6667 15.933 16.5789 16.0893 16.4226C16.2455 16.2663 16.3333 16.0543 16.3333 15.8333V14.1667C16.3333 13.7064 16.7064 13.3333 17.1667 13.3333C17.6269 13.3333 18 13.7064 18 14.1667V15.8333C18 16.4964 17.7366 17.1323 17.2678 17.6011C16.7989 18.0699 16.163 18.3333 15.5 18.3333H5.5C4.83696 18.3333 4.20107 18.0699 3.73223 17.6011C3.26339 17.1323 3 16.4964 3 15.8333V14.1667C3 13.7064 3.3731 13.3333 3.83333 13.3333Z"
													fill="#2563EB"
												></path>
											</g>
										</svg>
										<span className="px-[6px] py-[4px]">
											{__('Starter Templates', 'colormag')}
										</span>
									</h3>
									<div className="my-3">
										<img
											className="mb-3 w-[265px] h-[130px]"
											src={template}
											alt="Starter Template"
										/>
										<p className="text-[#6B6B6B]">
											{__(
												'Explore diverse demos from ' +
													localized.themeName +
													' theme to get your site running in no time!',
												'colormag',
											)}
										</p>
										<p className="text-[#6B6B6B]">
											{__(
												'Simply choose the demo that fits your requirements, import it, and give it some of your personal touch!',
												'colormag',
											)}
										</p>
										{'active' !==
											pluginsStatus[
												'themegrill-demo-importer/themegrill-demo-importer.php'
											] && (
											<button
												onClick={async () => {
													setIsProcessing(true);
													await performPluginAction(
														'themegrill-demo-importer/themegrill-demo-importer.php',
													);
													setIsProcessing(false);
												}}
												className="border-none text-[#2563EB] bg-[#FFFFFF] cursor-pointer"
												data-name="themegrill-demo-importer"
												data-slug="themegrill-demo-importer"
												aria-label="Install ThemeGrill Demo Importer Plugin"
												disabled={isProcessing}
											>
												{isProcessing
													? __('Processing...', 'colormag')
													: 'inactive' ===
														  pluginsStatus[
																'themegrill-demo-importer/themegrill-demo-importer.php'
														  ]
														? __(
																'Activate ThemeGrill Demo Importer Plugin',
																'colormag',
															)
														: 'not-installed' ===
															  pluginsStatus[
																	'themegrill-demo-importer/themegrill-demo-importer.php'
															  ]
															? __('Install ThemeGrill Demo Importer Plugin ')
															: ''}
											</button>
										)}

										{'active' ===
											pluginsStatus[
												'themegrill-demo-importer/themegrill-demo-importer.php'
											] && (
											<>
												<a
													className="text-[#2563EB] active:text-[#2563EB] text-[13px] hover:text-[#2563EB] no-underline"
													href={localized.demoUrl}
												>
													{__('View Starter Template', 'colormag')}
												</a>
											</>
										)}
									</div>
								</div>
							</div>
						</>
					)}

					{!colormagLocalized.hide_documentation && (
						<>
							<div className="p-4 bg-white rounded-lg shadow-sm border border-solid roundens border-[#F4F4F4] mb-5">
								<div>
									<h3 className="text-base font-semibold text-[#383838] flex gap-1 m-0 items-center">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="21"
											height="20"
											viewBox="0 0 21 20"
											fill="none"
										>
											<path
												d="M12.584 1.66602H5.50065C5.05862 1.66602 4.6347 1.84161 4.32214 2.15417C4.00958 2.46673 3.83398 2.89065 3.83398 3.33268V16.666C3.83398 17.108 4.00958 17.532 4.32214 17.8445C4.6347 18.1571 5.05862 18.3327 5.50065 18.3327H15.5006C15.9427 18.3327 16.3666 18.1571 16.6792 17.8445C16.9917 17.532 17.1673 17.108 17.1673 16.666V6.24935L12.584 1.66602Z"
												stroke="#2563EB"
												strokeWidth="1.5"
												strokeLinecap="round"
												strokeLinejoin="round"
											></path>
											<path
												d="M12.166 1.66602V6.66602H17.166"
												stroke="#2563EB"
												strokeWidth="1.5"
												strokeLinecap="round"
												strokeLinejoin="round"
											></path>
											<path
												d="M13.8327 10.833H7.16602"
												stroke="#2563EB"
												strokeWidth="1.5"
												strokeLinecap="round"
												strokeLinejoin="round"
											></path>
											<path
												d="M13.8327 14.166H7.16602"
												stroke="#2563EB"
												strokeWidth="1.5"
												strokeLinecap="round"
												strokeLinejoin="round"
											></path>
											<path
												d="M8.83268 7.5H7.16602"
												stroke="#2563EB"
												strokeWidth="1.5"
												strokeLinecap="round"
												strokeLinejoin="round"
											></path>
										</svg>
										<span className="px-[6px] py-[4px]">
											{__('View Documentation', 'colormag')}
										</span>
									</h3>
									<div className="my-3">
										<p className="text-[#6B6B6B]">
											{__(
												'Stuck due to an issue? Our detailed documentation will surely clear up any confusions you have!',
												'colormag',
											)}
										</p>
										<a
											className="text-[#2563EB] active:text-[#2563EB] hover:text-[#2563EB] text-[13px]"
											href="https://docs.themegrill.com/colormag/"
										>
											{__('Documentation', 'colormag')}
										</a>
									</div>
								</div>
							</div>
						</>
					)}

					{!colormagLocalized.hide_review_section && (
						<>
							<div className="p-4 bg-white rounded-lg shadow-sm border border-solid roundens border-[#F4F4F4] mb-5">
								<div>
									<h3 className="text-base font-semibold text-[#383838] flex gap-1 m-0 items-center">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="21"
											height="20"
											viewBox="0 0 21 20"
											fill="none"
										>
											<path
												d="M10.5001 1.66699L13.0751 6.88366L18.8334 7.72533L14.6667 11.7837L15.6501 17.517L10.5001 14.8087L5.35008 17.517L6.33341 11.7837L2.16675 7.72533L7.92508 6.88366L10.5001 1.66699Z"
												stroke="#2563EB"
												strokeWidth="1.66667"
												strokeLinecap="round"
												strokeLinejoin="round"
											></path>
										</svg>
										<span className="px-[6px] py-[4px]">
											{__('Leave us a Review', 'colormag')}
										</span>
									</h3>
									<div className="flex text-xs gap-3 items-center">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											viewBox="0 0 76 11"
											fill="#FFB900"
											width="76px"
											height="12px"
										>
											<path d="m4.121 3.669-3.19.462-.056.012a.5.5 0 0 0-.22.842l2.31 2.25-.544 3.177-.007.055a.5.5 0 0 0 .732.472L6 9.439l2.847 1.5.05.023a.5.5 0 0 0 .676-.55l-.546-3.178 2.312-2.25.04-.042a.5.5 0 0 0-.317-.81l-3.19-.463L6.445.779a.5.5 0 0 0-.897 0L4.12 3.669Zm16 0-3.19.462-.056.012a.5.5 0 0 0-.22.842l2.31 2.25-.544 3.177-.007.055a.5.5 0 0 0 .732.472L22 9.439l2.847 1.5.05.023a.5.5 0 0 0 .676-.55l-.546-3.178 2.312-2.25.04-.042a.5.5 0 0 0-.317-.81l-3.19-.463-1.426-2.89a.5.5 0 0 0-.897 0l-1.427 2.89Zm16 0-3.19.462-.056.012a.5.5 0 0 0-.22.842l2.31 2.25-.544 3.177-.007.055a.5.5 0 0 0 .732.472L38 9.439l2.847 1.5.05.023a.5.5 0 0 0 .676-.55l-.546-3.178 2.312-2.25.04-.042a.5.5 0 0 0-.317-.81l-3.19-.463-1.426-2.89a.5.5 0 0 0-.897 0l-1.427 2.89Zm16 0-3.19.462-.056.012a.5.5 0 0 0-.22.842l2.31 2.25-.544 3.177-.007.055a.5.5 0 0 0 .732.472L54 9.439l2.847 1.5.05.023a.5.5 0 0 0 .676-.55l-.546-3.178 2.312-2.25.04-.042a.5.5 0 0 0-.317-.81l-3.19-.463-1.426-2.89a.5.5 0 0 0-.897 0l-1.427 2.89Zm16 0-3.19.462-.056.012a.5.5 0 0 0-.22.842l2.31 2.25-.544 3.177-.007.055a.5.5 0 0 0 .732.472L70 9.439l2.847 1.5.05.023a.5.5 0 0 0 .676-.55l-.546-3.178 2.312-2.25.04-.042a.5.5 0 0 0-.317-.81l-3.19-.463-1.426-2.89a.5.5 0 0 0-.897 0l-1.427 2.89Z"></path>
										</svg>
										<span className="text-[#999]">
											{__('Based on 1430+ Reviews', 'colormag')}
										</span>
									</div>
									<div className="my-3">
										<p className="text-[#6B6B6B]">
											{__(
												'What do you think of our theme? Was it a good experience and did it match your expectations? Let us know so we can improve!',
												'colormag',
											)}
										</p>
										<a
											className="text-[#2563EB] active:text-[#2563EB] hover:text-[#2563EB] text-[13px]"
											href="https://wordpress.org/support/theme/colormag/reviews/?rate=5#new-post"
											target="_blank"
										>
											{__('Submit a Review', 'colormag')}
										</a>
									</div>
								</div>
							</div>
						</>
					)}
					{!colormagLocalized.hide_feature_section && (
						<>
							<div className="p-4 bg-white rounded-lg shadow-sm border border-solid roundens border-[#F4F4F4] mb-5">
								<div>
									<h3 className="text-base font-semibold text-[#383838] flex gap-1 m-0 items-center">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="21"
											height="20"
											viewBox="0 0 21 20"
											fill="none"
										>
											<path
												d="M12.9998 11.667C13.1664 10.8337 13.5831 10.2503 14.2498 9.58366C15.0831 8.83366 15.4998 7.75033 15.4998 6.66699C15.4998 5.34091 14.973 4.06914 14.0353 3.13146C13.0976 2.19378 11.8258 1.66699 10.4998 1.66699C9.17367 1.66699 7.9019 2.19378 6.96422 3.13146C6.02654 4.06914 5.49976 5.34091 5.49976 6.66699C5.49976 7.50033 5.66642 8.50033 6.74976 9.58366C7.33309 10.167 7.83309 10.8337 7.99976 11.667"
												stroke="#2563EB"
												strokeWidth="1.66667"
												strokeLinecap="round"
												strokeLinejoin="round"
											></path>
											<path
												d="M7.99988 15H12.9999"
												stroke="#2563EB"
												strokeWidth="1.66667"
												strokeLinecap="round"
												strokeLinejoin="round"
											></path>
											<path
												d="M8.83325 18.333H12.1666"
												stroke="#2563EB"
												strokeWidth="1.66667"
												strokeLinecap="round"
												strokeLinejoin="round"
											></path>
										</svg>
										<span className="px-[6px] py-[4px]">
											{__('Feature Request', 'colormag')}
										</span>
									</h3>
									<div className="my-3">
										<p className="text-[#6B6B6B]">
											{__(
												'Please take a moment to suggest any features that could enhance our product.',
												'colormag',
											)}
										</p>
										<a
											className="text-[#2563EB] active:text-[#2563EB] hover:text-[#2563EB] text-[13px]"
											href="https://themegrill.com/contact/#tg-query"
											target="_blank"
										>
											{__('Request a Feature', 'colormag')}
										</a>
									</div>
								</div>
							</div>
						</>
					)}

					{!colormagLocalized.hide_support_section && (
						<>
							<div className="p-4 bg-white rounded-lg shadow-sm border border-solid roundens border-[#F4F4F4] mb-5">
								<div>
									<h3 className="text-base font-semibold text-[#383838] flex gap-1 m-0 items-center">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="21"
											height="20"
											viewBox="0 0 21 20"
											fill="none"
										>
											<path
												d="M3 11.6667H5.5C5.94203 11.6667 6.36595 11.8423 6.67851 12.1548C6.99107 12.4674 7.16667 12.8913 7.16667 13.3333V15.8333C7.16667 16.2754 6.99107 16.6993 6.67851 17.0118C6.36595 17.3244 5.94203 17.5 5.5 17.5H4.66667C4.22464 17.5 3.80072 17.3244 3.48816 17.0118C3.17559 16.6993 3 16.2754 3 15.8333V10C3 8.01088 3.79018 6.10322 5.1967 4.6967C6.60322 3.29018 8.51088 2.5 10.5 2.5C12.4891 2.5 14.3968 3.29018 15.8033 4.6967C17.2098 6.10322 18 8.01088 18 10V15.8333C18 16.2754 17.8244 16.6993 17.5118 17.0118C17.1993 17.3244 16.7754 17.5 16.3333 17.5H15.5C15.058 17.5 14.634 17.3244 14.3215 17.0118C14.0089 16.6993 13.8333 16.2754 13.8333 15.8333V13.3333C13.8333 12.8913 14.0089 12.4674 14.3215 12.1548C14.634 11.8423 15.058 11.6667 15.5 11.6667H18"
												stroke="#2563EB"
												strokeWidth="1.66667"
												strokeLinecap="round"
												strokeLinejoin="round"
											></path>
										</svg>
										<span className="px-[6px] py-[4px]">
											{__('Support', 'colormag')}
										</span>
									</h3>
									<div className="my-3">
										<p className="text-[#6B6B6B]">
											{__(
												'We would be happy to guide you through any issues and queries you have regarding ' +
													localized.themeName +
													'!',
												'colormag',
											)}
										</p>
										<a
											className="text-[#2563EB] active:text-[#2563EB] hover:text-[#2563EB] text-[13px]"
											href="https://themegrill.com/contact/"
											target="_blank"
										>
											{__('Create a Ticket', 'colormag')}
										</a>
									</div>
								</div>
							</div>
						</>
					)}

					{!colormagLocalized.hide_user_ful_section && (
						<>
							<div className="p-4 bg-white rounded-lg shadow-sm border border-solid roundens border-[#F4F4F4] mb-5 ">
								<div>
									<h3 className="text-base font-semibold text-[#383838] flex gap-1 m-0 items-center">
										<span className="px-[6px] py-[4px]">
											{__('Useful Plugins', 'colormag')}
										</span>
									</h3>
									<UsefulPlugins />
								</div>
							</div>
						</>
					)}

					{!colormagLocalized.hide_community_section && (
						<>
							<div className="p-4 bg-white rounded-lg shadow-sm border border-solid roundens border-[#F4F4F4] mb-5">
								<div>
									<h3 className="text-base font-semibold text-[#383838] flex gap-1 m-0 items-center">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="21"
											height="20"
											viewBox="0 0 21 20"
											fill="none"
										>
											<path
												d="M13.8327 17.5V15.8333C13.8327 14.9493 13.4815 14.1014 12.8564 13.4763C12.2313 12.8512 11.3834 12.5 10.4993 12.5H5.49935C4.61529 12.5 3.76745 12.8512 3.14233 13.4763C2.51721 14.1014 2.16602 14.9493 2.16602 15.8333V17.5"
												stroke="#2563EB"
												strokeWidth="1.5"
												strokeLinecap="round"
												strokeLinejoin="round"
											></path>
											<path
												d="M7.99935 9.16667C9.8403 9.16667 11.3327 7.67428 11.3327 5.83333C11.3327 3.99238 9.8403 2.5 7.99935 2.5C6.1584 2.5 4.66602 3.99238 4.66602 5.83333C4.66602 7.67428 6.1584 9.16667 7.99935 9.16667Z"
												stroke="#2563EB"
												strokeWidth="1.5"
												strokeLinecap="round"
												strokeLinejoin="round"
											></path>
											<path
												d="M18.834 17.5001V15.8334C18.8334 15.0948 18.5876 14.3774 18.1351 13.7937C17.6826 13.2099 17.0491 12.793 16.334 12.6084"
												stroke="#2563EB"
												strokeWidth="1.5"
												strokeLinecap="round"
												strokeLinejoin="round"
											></path>
											<path
												d="M13.834 2.6084C14.551 2.79198 15.1865 3.20898 15.6403 3.79366C16.0942 4.37833 16.3405 5.09742 16.3405 5.83757C16.3405 6.57771 16.0942 7.2968 15.6403 7.88147C15.1865 8.46615 14.551 8.88315 13.834 9.06673"
												stroke="#2563EB"
												strokeWidth="1.5"
												strokeLinecap="round"
												strokeLinejoin="round"
											></path>
										</svg>
										<span className="px-[6px] py-[4px]">
											{__('ThemeGrill Community', 'colormag')}
										</span>
									</h3>
									<div className="my-3">
										<p className="text-[#6B6B6B]">
											{__(
												'Join our Facebook group filled with ThemeGrill themes users, including ' +
													localized.themeName +
													' users to discuss anything about the theme!',
												'colormag',
											)}
										</p>
										<a
											className="text-[#2563EB] active:text-[#2563EB] hover:text-[#2563EB] text-[13px]"
											href="https://www.facebook.com/groups/themegrill/"
											target="_blank"
										>
											{__('Join our Facebook Group', 'colormag')}
										</a>
									</div>
								</div>
							</div>
						</>
					)}
				</div>
			</div>
		</>
	);
};

export default Dashboard;
