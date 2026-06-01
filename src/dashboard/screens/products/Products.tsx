import { __ } from '@wordpress/i18n';
import React from 'react';
import UsefulPlugins from '../../components/UsefulPlugins';
import { THEME_PRODUCTS } from '../../constants';

const Products: React.FC = () => {
	return (
		<>
			<div>
				<h1>{__('Theme', 'colormag')}</h1>
				<div className="grid lg:grid-cols-4 gap-4">
					{THEME_PRODUCTS.map((theme_products) => (
						<div className="rounded border border-solid border-[#F4F4F4] bg-[#FFFFFF]">
							<img
								className="w-full"
								src={theme_products.icon}
								alt={theme_products.title}
							/>
							<div className="my-5 mx-4">
								<h3 className="mb-2">{theme_products.title}</h3>
								<p className="text-[#6B6B6B] text-sm mb-2 leading-7">
									{theme_products.desc}
								</p>
							</div>
							<div className="py-5 px-4 border-t border-x-0 border-b-0 border-solid border-[#F4F4F4]">
								<div className="cta-text flex gap-3">
									<a
										className="text-[#7A7A7A] text-xs cm-learn-more focus:outline-0 focus:shadow-none"
										href={theme_products.learn_more}
										target="_blank"
									>
										{__('Learn more', 'colormag')}
									</a>
									<a
										className="text-[#7A7A7A] text-xs focus:outline-0 focus:shadow-none"
										href={theme_products.live_demo}
										target="_blank"
									>
										{__('View Demo', 'colormag')}
									</a>
								</div>
							</div>
						</div>
					))}
				</div>
			</div>
			<div className="mt-[24px]">
				<h1>{__('Plugins', 'colormag')}</h1>
				<div className="grid lg:grid-cols-4 gap-6">
					<UsefulPlugins />
				</div>
			</div>
		</>
	);
};

export default Products;
