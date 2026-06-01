import React from 'react';
import { features } from '../../constants';

const FreeVsPro: React.FC = () => {
	return (
		<>
			<div>
				{Object.entries(features).map(([category, { showFreePro, items }]) => (
					<div key={category}>
						<table className="w-full fvp-table relative">
							<thead>
								<tr className="nfvp-heading text-left bg-[#F4F4F4] text-[#6B6B6B] sticky top-0">
									<th className="p-3 text-sm font-semibold leading-8 w-6/12">
										{category}
									</th>
									<th className="p-3 text-sm font-semibold leading-8">Free</th>
									<th className="p-3 text-sm font-semibold leading-8">Pro</th>
								</tr>
							</thead>
							<tbody>
								{items.map(([feature, free, pro], index) => (
									<tr key={index}>
										<td className="p-3 bg-white text-sm font-normal leading-8 w-6/12">
											{feature}
										</td>
										<td className="p-3 bg-white text-sm font-normal leading-8 ">
											{free}
										</td>
										<td className="p-3 bg-white text-sm font-normal leading-8">
											{pro}
										</td>
									</tr>
								))}
							</tbody>
						</table>
					</div>
				))}
			</div>
		</>
	);
};

export default FreeVsPro;
