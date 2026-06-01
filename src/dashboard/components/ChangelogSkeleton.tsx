import React from 'react';

const ChangelogSkeleton: React.FC = () => {
	return (
		<>
			{Array.from({ length: 5 }).map((_, i) => (
				<div className="mt-4" key={i}>
					<div className="flex items-center justify-center direction-row">
						<div
							className="skeleton"
							style={{ height: '17px', width: '80px' }}
						></div>
						<div
							className="skeleton"
							style={{ height: '10px', width: '57px' }}
						></div>
					</div>
					<div
						className="skeleton"
						style={{ height: '26px', width: '60px', marginTop: '20px' }}
					></div>
					<div className="skeleton-text" style={{ marginTop: '20px' }}>
						{Array.from({ length: 5 }).map((_, j) => (
							<div
								key={j}
								className="skeleton-line"
								style={{ marginBottom: '4px' }}
							></div>
						))}
					</div>
				</div>
			))}
		</>
	);
};

export default ChangelogSkeleton;
