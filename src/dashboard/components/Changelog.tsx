import apiFetch from '@wordpress/api-fetch';
import { __, sprintf } from '@wordpress/i18n';
import React from 'react';
import { useQuery } from 'react-query';
import { ChangelogsMap } from '../types';
import ChangelogSkeleton from './ChangelogSkeleton';
type ChangelogTag =
	| 'Updated'
	| 'Update'
	| 'Fix'
	| 'Added'
	| 'Add'
	| 'Feature'
	| 'Enhancement'
	| 'Tweak';

const Changelog: React.FC = () => {
	const changelogQuery = useQuery(['changelog'], () =>
		apiFetch<ChangelogsMap>({
			path: 'colormag/v1/changelog',
		}),
	);

	const getClassNames = (tag: ChangelogTag) => {
		const baseClass =
			'sticky top-0 font-normal z-10 w-fit px-[8px] py-[4px] rounded-[3px] font-semibold';
		const tagClasses = {
			Updated: 'bg-[#c6f6d5] text-[#22543d]',
			Update: 'bg-[#c6f6d5] text-[#22543d]',
			Fix: 'bg-[#e8eefd] text-[#0b2c75]',
			Added: 'bg-[#fed7e2] text-[#702459]',
			Add: 'bg-[#fed7e2] text-[#702459]',
			Feature: 'bg-[#fed7e2] text-[#702459]',
			Enhancement: 'bg-[#b2f5ea] text-[#234e52]',
			Tweak: 'bg-[#e9d8fd] text-[#44337a]',
		} as const;
		return `${baseClass} ${tagClasses[tag]}`;
	};

	const strokeColor = (tag: ChangelogTag) => {
		const tagClasses = {
			Updated: '#22543d',
			Update: '#22543d',
			Fix: '#0b2c75',
			Added: '#702459',
			Add: '#702459',
			Feature: '#702459',
			Enhancement: '#234e52',
			Tweak: '#44337a',
		} as const;
		return tagClasses[tag];
	};

	if (changelogQuery.isLoading) {
		return <ChangelogSkeleton />;
	}

	return (
		<>
			{changelogQuery.data?.map((changelog) => (
				<div key={changelog.version} className="mb-[7px]">
					<div className="flex justify-between items-center">
						<h4 className="text-sm font-semibold">
							{sprintf(__('Version %s'), changelog.version)}
						</h4>
						<p>{changelog.date}</p>
					</div>
					<div>
						{Object.entries(changelog.changes).map(([tag, changes], i) => (
							<div
								className="relative mb-[10px] mt-[8px] after:absolute after:bg-[#D3D3D3] after:content-[''] after:h-[full] after:left-[12px] after:w-[2px]"
								key={`${changelog.version}${tag}${i}`}
							>
								<span className={getClassNames(tag as ChangelogTag)}>
									{tag}
								</span>
								<div className="p-[10px] mt-[12px]">
									{changes.map((change, j) => (
										<span
											className="relative flex gap-[16px] items-center mb-[16px]"
											key={`${changelog.version}${tag}${i}${j}`}
										>
											<span className="flex items-center">
												<svg
													xmlns="http://www.w3.org/2000/svg"
													viewBox="0 0 48 48"
													width="18px"
													height="18px"
												>
													<path
														fill="none"
														stroke={strokeColor(tag as ChangelogTag)}
														strokeLinecap="round"
														strokeLinejoin="round"
														strokeWidth="3"
														d="M34.3,39.4c-2.9,2-6.5,3.1-10.3,3.1C13.8,42.5,5.5,34.2,5.5,24c0-4.4,1.6-8.5,4.1-11.7"
													/>
													<path
														fill="none"
														stroke={strokeColor(tag as ChangelogTag)}
														strokeLinecap="round"
														strokeLinejoin="round"
														strokeWidth="3"
														d="M20.1,5.9c1.3-0.3,2.6-0.4,3.9-0.4c10.2,0,18.5,8.3,18.5,18.5c0,2.9-0.7,5.6-1.8,8"
													/>
													<polyline
														fill="none"
														stroke={strokeColor(tag as ChangelogTag)}
														strokeLinecap="round"
														strokeLinejoin="round"
														strokeWidth="3"
														points="16.5,24.5 21.5,29.5 31.5,19.5"
													/>
												</svg>
											</span>
											{change}
										</span>
									))}
								</div>
							</div>
						))}
					</div>
				</div>
			))}
		</>
	);
};

export default Changelog;
