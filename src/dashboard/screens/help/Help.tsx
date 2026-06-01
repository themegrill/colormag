import { __ } from '@wordpress/i18n';
import React from 'react';
import UsefulPlugins from '../../components/UsefulPlugins';
import facebook from '../../images/facebook.webp';
import twitter from '../../images/x.webp';
import youtube from '../../images/youtube.webp';
import { localized } from '../../utils/global';

const Help: React.FC = () => {
	return (
		<>
			<div className="lg:flex md:flex-row gap-5 flex-col">
				<div className="lg:basis-9/12 basis-full">
					<div className="mb-5">
						<div className="cm-help-top-row flex lg:flex-row flex-col gap-4">
							<div className="px-6 pt-6 pb-8 bg-white rounded-lg shadow-sm text-center">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									width="33"
									height="33"
									viewBox="0 0 33 33"
									fill="none"
								>
									<path
										d="M19.833 3.00977H8.49967C7.79243 3.00977 7.11415 3.29072 6.61406 3.79081C6.11396 4.29091 5.83301 4.96919 5.83301 5.67643V27.0098C5.83301 27.717 6.11396 28.3953 6.61406 28.8954C7.11415 29.3955 7.79243 29.6764 8.49967 29.6764H24.4997C25.2069 29.6764 25.8852 29.3955 26.3853 28.8954C26.8854 28.3953 27.1663 27.717 27.1663 27.0098V10.3431L19.833 3.00977Z"
										stroke="#2563EB"
										strokeWidth="2"
										strokeLinecap="round"
										strokeLinejoin="round"
									></path>
									<path
										d="M19.1665 3.00977V11.0098H27.1665"
										stroke="#2563EB"
										strokeWidth="2"
										strokeLinecap="round"
										strokeLinejoin="round"
									></path>
									<path
										d="M21.8332 17.6758H11.1665"
										stroke="#2563EB"
										strokeWidth="2"
										strokeLinecap="round"
										strokeLinejoin="round"
									></path>
									<path
										d="M21.8332 23.0098H11.1665"
										stroke="#2563EB"
										strokeWidth="2"
										strokeLinecap="round"
										strokeLinejoin="round"
									></path>
									<path
										d="M13.8332 12.3428H11.1665"
										stroke="#2563EB"
										strokeWidth="2"
										strokeLinecap="round"
										strokeLinejoin="round"
									></path>
								</svg>
								<h3 className="mt-6 mb-3">
									{__('Need Some Help?', 'colormag')}
								</h3>
								<p className="pb-8">
									{__(
										'Please check out basic documentation for detailed information on how to use ' +
											localized.themeName +
											'.',
										'colormag',
									)}
								</p>
								<a
									className="border border-solid border-[#2563EB] rounded py-2 px-3 text-[#2563EB] no-underline hover:text-[#2563EB]"
									href="https://docs.themegrill.com/colormag/"
									target="_blank"
								>
									<span>{__('View Now', 'colormag')}</span>
								</a>
							</div>
							<div className="px-6 pt-6 pb-8 bg-white rounded-lg shadow-sm text-center">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									width="32"
									height="32"
									viewBox="0 0 33 33"
									fill="none"
								>
									<path
										d="M19.1667 20.3428V23.0094C19.1667 23.3631 19.0262 23.7022 18.7761 23.9523C18.5261 24.2023 18.187 24.3428 17.8333 24.3428H8.5L4.5 28.3428V15.0094C4.5 14.6558 4.64048 14.3167 4.89052 14.0666C5.14057 13.8166 5.47971 13.6761 5.83333 13.6761H8.5M28.5 19.0094L24.5 15.0094H15.1667C14.813 15.0094 14.4739 14.869 14.2239 14.6189C13.9738 14.3689 13.8333 14.0297 13.8333 13.6761V5.67611C13.8333 5.32248 13.9738 4.98335 14.2239 4.7333C14.4739 4.48325 14.813 4.34277 15.1667 4.34277H27.1667C27.5203 4.34277 27.8594 4.48325 28.1095 4.7333C28.3595 4.98335 28.5 5.32248 28.5 5.67611V19.0094Z"
										stroke="#2563EB"
										strokeWidth="2"
										strokeLinecap="round"
										strokeLinejoin="round"
									></path>
								</svg>
								<h3 className="mt-6 mb-3">{__('Support', 'colormag')}</h3>
								<p className="pb-8">
									{__(
										'We would be happy to guide you through any issues and queries you have regarding ' +
											localized.themeName +
											'!',
										'colormag',
									)}
								</p>
								<a
									className="border border-solid border-[#2563EB] rounded py-2 px-3 text-[#2563EB] no-underline hover:text-[#2563EB]"
									href="https://themegrill.com/contact/"
									target="_blank"
								>
									<span>{__('Contact Support', 'colormag')}</span>
								</a>
							</div>
						</div>
					</div>
					<h2 className="mb-4">{__('Join Our Community', 'colormag')}</h2>
					<div className="px-6 pt-6 pb-4 bg-white rounded-lg shadow-sm mb-4">
						<div className="cm-quick-settings-title ">
							<div className="mb-8 flex lg:flex-row flex-col items-center justify-between gap-7">
								<img className="max-w-[348px]" src={facebook} alt="Facebook" />
								<div className="cm-content">
									<h3>{__('Facebook Community', 'colormag')}</h3>
									<p className="mb-5">
										{__(
											'Join our Facebook community to get help, share your experience, and connect with other ' +
												localized.themeName +
												' users.',
											'colormag',
										)}
									</p>
									<a
										className="bg-[#2563EB] text-[#FFFFFF] rounded py-2 px-3 no-underline hover:text-white focus:text-white"
										href="https://www.facebook.com/groups/themegrill/"
										target="_blank"
									>
										<span>{__('Join us on Facebook', 'colormag')}</span>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div className="px-6 pt-6 pb-4 bg-white rounded-lg shadow-sm mb-4">
						<div className="cm-quick-settings-title ">
							<div className="mb-8 flex lg:flex-row flex-col items-center justify-between gap-7">
								<img className="max-w-[348px]" src={twitter} alt="x-twitter" />
								<div className="cm-content">
									<h3>{__('X Community', 'colormag')}</h3>
									<p className="mb-5">
										{__(
											'Follow us on Twitter and stay in the loop for the latest news and updates on our products!',
											'colormag',
										)}
									</p>
									<a
										className="bg-[#2563EB] text-[#FFFFFF] rounded py-2 px-3 no-underline hover:text-white focus:text-white"
										href="https://twitter.com/themegrill"
										target="_blank"
									>
										<span>{__('Join us on Twitter', 'colormag')}</span>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div className="px-6 pt-6 pb-4 bg-white rounded-lg shadow-sm mb-4">
						<div className="cm-quick-settings-title ">
							<div className="mb-8 flex lg:flex-row flex-col items-center justify-between gap-7">
								<img className="max-w-[348px]" src={youtube} alt="Youtube" />
								<div className="cm-content">
									<h3>{__('Youtube Community', 'colormag')}</h3>
									<p className="mb-5">
										{__(
											'Visit our YouTube channel for videos about tutorials, updates, and news on our products!',
											'colormag',
										)}
									</p>
									<a
										className="bg-[#2563EB] text-[#FFFFFF] rounded py-2 px-3 no-underline hover:text-white focus:text-white"
										href="https://www.youtube.com/@ThemeGrillOfficial"
										target="_blank"
									>
										<span>{__('Visit us on YouTube', 'colormag')}</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div className="lg:basis-3/12 basis-full">
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
									className="text-[#2563EB] hover:text-[#2563EB]"
									href="https://wordpress.org/support/theme/colormag/reviews/?rate=5#new-post"
									target="_blank"
								>
									{__('Submit a Review', 'colormag')}
								</a>
							</div>
						</div>
					</div>
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
									className="text-[#2563EB] hover:text-[#2563EB]"
									href="https://themegrill.com/contact/#tg-query"
									target="_blank"
								>
									{__('Request a Feature', 'colormag')}
								</a>
							</div>
						</div>
					</div>
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
				</div>
			</div>
		</>
	);
};

export default Help;
